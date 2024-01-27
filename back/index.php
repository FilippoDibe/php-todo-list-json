<?php
header("Access-Control-Allow-Origin: http://localhost:5173");
header("Content-Type: application/json");
header("Access-Control-Allow-Headers: X-Requested-With");





 $jsonTodo = file_get_contents("todo.json");
 echo $jsonTodo;

 
?>

