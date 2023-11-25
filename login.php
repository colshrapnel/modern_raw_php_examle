<?php
// Code for the article https://phpdelusions.net/modern_php_example

require 'init.php';

// Initialize all values so we won't have to always check them for existsnce
$error = ['email' => '', 'password' => ''];
$input = ['email' => ''];

// if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // input validation

    $email = $input['email'] = trim(filter_input(INPUT_POST, 'email'));
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error['email'] = 'Please enter a valid email address.';
    }

    $password = filter_input(INPUT_POST, 'password');
    if (strlen($password) < 6 || strlen($password) > 72) {
        $error['password'] = 'Please enter password, it must be from 6 to 72 charaters long.';
    }

    // if no errors
    if (implode("", $error) === '')
    {
        $result = $db->execute_query("SELECT * FROM users WHERE email = ?", [$email]);
        $user = $result->fetch_assoc();
        if ($user && password_verify($password, $user['password']))
        {
            $_SESSION['user_id'] = $user['id'];
            // after each succesful POST request there MUST be a redirect
            header("Location: /index.php");
            // after sending Location header the code MUST be terminated
            die;
        } else {
            $error['password'] = 'Login or password do not match.';
        }        
    }
}

require 'templates/layout/header.php';
require 'templates/login.php';
require 'templates/layout/footer.php';