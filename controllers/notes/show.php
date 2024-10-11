<?php

use Core\Database;


$config = require base_path("config.php");
$db = new Database($config['database']);

// dd($_GET['id']);
$currentUserId = 1;

$note = $db->query('SELECT * FROM notes WHERE id = :id', [
    'id' => $_GET['id']
])->findOrFail();

//not authorized, 
authorize($note['user_id'] ===$currentUserId);

view("notes/show.view.php", [
    'heading' => 'Note',
    'note' => $note
]);