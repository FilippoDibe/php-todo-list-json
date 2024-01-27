<?php 
header("Access-Control-Allow-Origin: http://localhost:5173");
header("Content-Type: application/json");
header("Access-Control-Allow-Headers: X-Requested-With");


$jsonTodo = file_get_contents("todo.json");
$todo = json_decode($jsonTodo, true);

// Uso $_POST 
$text = isset($_POST['TodoText']) ? $_POST['TodoText'] : null;
if (null === $text) {
    // Gestisci l'errore se il testo non viene passato
    echo json_encode(['error' => 'No text provided']);
    exit;
}

$newTodo = [
    'text' => $text,
    'stato' => 'non completato'
];



$todo[] = $newTodo;

$jsonTodo = json_encode($todo);

file_put_contents("todo.json", $jsonTodo);
echo $jsonTodo;
?>
   

