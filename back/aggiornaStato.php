<?php 
header("Access-Control-Allow-Origin: http://localhost:5173");
header("Content-Type: application/json");
header("Access-Control-Allow-Headers: X-Requested-With");


$jsonTodo = file_get_contents("todo.json");
$todoList = json_decode($jsonTodo, true);

$index = isset($_POST['index']) ? $_POST['index'] : null;
$newState = isset($_POST['stato']) ? $_POST['stato'] : null;

if ($index !== null && $newState !== null && isset($todoList[$index])) {
    $todoList[$index]['stato'] = $newState;

    file_put_contents("todo.json", json_encode($todoList));

    echo json_encode($todoList);
} else {
    
    echo json_encode(['error' => 'Invalid index or state']);
}
?>
