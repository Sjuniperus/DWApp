<?php

use Core\Database;
use Core\Validator;

$config = require base_path("config.php");

$db = new Database($config['database']);

$errors = [];

if (! Validator::string($_POST['body'], 1, 1000)){
    $errors['body'] = 'A body of max 1,000 characters is required';
}

if (! empty($errors)) {
    view("notes/create.view.php", [
        'heading' => 'Create note',
        'errors' => $errors
    ]);
}

$db->query('INSERT INTO notes(body, user_id) VALUES(:body, :user_id)', [
    'body' => $_POST['body'],
    'user_id' => 1
]);

header('location: /notes');
die();

