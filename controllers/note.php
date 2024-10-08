<?php


$config = require "config.php";
$db = new Database($config['database']);

$heading = "Note";
// dd($_GET['id']);

$note = $db->query('SELECT * FROM notes WHERE id = :id', [
    'id' => $_GET['id']
])->findOrFail();


//not authorized, 
$currentUserId = 1;

if ($note['user_id'] != $currentUserId){
    abort(Response::FORBIDDEN);
}




require "views/note.view.php";