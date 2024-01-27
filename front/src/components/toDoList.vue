<script>
import axios from 'axios';

export default {
  name: 'TodoList',
  data() {
    return {
      todos: [],
      newTodoText: '',
    
    };
  },
  mounted() {
   const t = this;

   axios.get('http://localhost/index.php').then(res => {
    t.todos = res.data;
   }).catch(err => console.log(err));
  },
  methods: {
    pushTodo() {
        // console.log('testo pushato: ' + this.newTodoText);

        const params = new FormData();
        params.append('TodoText', this.newTodoText);
        


        axios.post('http://localhost/pushTodo.php', params)
        .then(res => {
            this.todos = res.data;
            this.newTodoText = '';
             
        })
        .catch(err => console.log(err));
        },
        changeState(index){
            let todo = this.todos[index];
            let newState = todo.stato === 'completato' ? 'non completato' : 'completato';
            const params = new FormData();
            params.append('index', index);
            params.append('stato', newState);
            axios.post('http://localhost/aggiornaStato.php',params)
            .then(response =>{
                this.todos = response.data;
            }).catch(error => console.log(' errore nell aggironamento dello stato', error));
        },
        deleteTodo(index){

            const params= new FormData();
            params.append('index', index);

            axios.post('http://localhost/deleteTodo.php', params)
            .then(response =>{
                this.todos = response.data;
            }).catch(error => console.log('errore nel cancellare il todo:', error));
        }
    },
    

};
</script>
<template>
   <div>
        <form @submit.prevent="pushTodo">
            <input v-model="newTodoText" type="text" placeholder="Aggiungi un nuovo todo">
            <input type="submit" value="send">
           
        </form>


        <ul>
            <li v-for="(todo, index) in todos" :key="index" :class="{ 'completed': todo.stato === 'completato' }" @click="changeState(index)" >
                {{ todo.text }}
                <button @click="deleteTodo(index)">Elimina</button>
            </li>
        </ul>
  </div>
  </template>
  <style scoped>
.completed {
    text-decoration: line-through;
}

    </style>
  
  
  