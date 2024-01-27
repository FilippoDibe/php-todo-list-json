<script>
import axios from 'axios';

export default {
  name: 'TodoList',
  data() {
    return {
      todos: [],
      newTodoText: ''
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
            <li v-for="(todo, index) in todos" :key="index">
                {{ todo.text }}
            </li>
        </ul>
  </div>
  </template>
  
  
  