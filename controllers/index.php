<?php

$_SESSION['name'] = 'Pepa';

$heading = "Home";



view("index.view.php", [
    'heading' => 'Home'
]);
