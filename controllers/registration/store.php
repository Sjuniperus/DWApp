<?php

use Core\App;
use Core\Database;
use Core\Validator;

$email = $_POST['email'];
$password = $_POST['password'];

//validate from inputs
$errors = [];

if (! Validator::email($email)) {
    $errors['email'] = 'Please enter a valid email adress.';
}

if (! Validator::string($password, 7, 255)) {
    $errors['password'] = 'Please enter a password of at least 7 characters.';
}

if (! empty($errors)) {
    return view('registration/create.view.php', [
        'errors' => $errors
    ]);

}

$db = App::resolve(Database::class);
//check if the account already exists

$user = $db->query('SELECT * FROM users WHERE email = :email', [
    'email' => $email
])->find();

    
    //If yes, redirect for a home page
if ($user) {

    header('location: /');
    exit();
    
} else {
    //If not, save one to the db, and then log the user in, and redirect.
    $db->query('INSERT INTO users(email, password) VALUES(:email, :password)',[
        'email' =>$email,
        'password'=> $password
    ]);

    //mark that the user has logged in.
    $_SESSION['user'] = [
        'email' => $email
    ];

    header('location: /');
    exit();
}
