<?php 
header("Access-Control-Allow-Origin: http://localhost:5173");
header("Content-Type: application/json");
header("Access-Control-Allow-Headers: X-Requested-With");

$jsonTodo = file_get_contents("todo.json");
$todoList = json_decode($jsonTodo, true);

$index = isset($_POST['index']) ? $_POST['index'] : null;

if ($index !== null && isset($todoList[$index])) {
    array_splice($todoList, $index, 1);

    file_put_contents("todo.json", json_encode($todoList));

    echo json_encode($todoList);
} else {

    echo json_encode(['error' => 'Invalid or missing index']);
}
?>
