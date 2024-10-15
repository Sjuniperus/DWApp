<?php



use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);

//find the correspondign note

$currentUserId = 1;


$note = $db->query('SELECT * FROM notes WHERE id = :id', [
    'id' => $_POST['id']
])->findOrFail();

//authorize that the current user edit the note
authorize($note['user_id'] === $currentUserId);


//validate the form
$errors = [];

if (! Validator::string($_POST['body'], 1, 1000)){
    $errors['body'] = 'A body of max 1,000 characters is required';
}

//if no validatoin errors, update record in the notes database table

if (count($errors)) {
    return view('notes/edit.view.php', [
        'heading' => 'Edit note',
        'errors' => $errors,
        'note' => $note
    ]);
} 

$db->query('UPDATE notes SET body = :body WHERE id = :id',[
    'id' => $_POST ['id'],
    'body' => $_POST['body']

]);

//redirect

header('location: /notes');
die();