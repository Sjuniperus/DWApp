<?php


$config = require base_path("config.php");
$db = new Database($config['database']);

// dd($_GET['id']);

$note = $db->query('SELECT * FROM notes WHERE id = :id', [
    'id' => $_GET['id']
])->findOrFail();

//not authorized, 
$currentUserId = 1;

if ($note['user_id'] != $currentUserId){
    abort(Response::FORBIDDEN);
}


view("notes/show.view.php", [
    'heading' => 'Note',
    'note' => $note
]);