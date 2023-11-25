<?php
// Code for the article https://phpdelusions.net/modern_php_example

require 'init.php';

// Initialize all values so we won't have to always check them for existsnce
$error = ['name' => '', 'email' => '', 'password' => ''];
$input = ['name' => '', 'email' => ''];

// if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // input validation

    $name = $input['name'] = trim(filter_input(INPUT_POST, 'name'));
    if (strlen($name) < 3 || strlen($name) > 30) {
        $error['name'] = 'Please enter your name, it must be from 3 to 30 charaters long.';
    }

    $email = $input['email'] = trim(filter_input(INPUT_POST, 'email'));
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error['email'] = 'Please enter a valid email address.';
    } else {
        $result = $db->execute_query("SELECT 1 FROM users WHERE email = ?", [$email]);
        if ($result->fetch_row()) {
            $error['email'] = 'Email address already taken.';
        }
    }

    $password = filter_input(INPUT_POST, 'password');
    if (strlen($password) < 8 || strlen($password) > 72) {
        $error['password'] = 'Please enter password, it must be from 8 to 72 charaters long.';
    }

    // if no errors
    if (implode($error) === '')
    {
        // passwords MUST be hashed using the dedicated function
        $password = password_hash($password, PASSWORD_DEFAULT);
        
        // a parameterized query MUST be used to avoid errors and injections
        $sql = "INSERT INTO users (name, email, password) VALUES (?,?,?)";
        $db->execute_query($sql, [$name, $email, $password]);

        // after each succesful POST request there MUST be a redirect
        header("Location: /index.php");
        // after sending Location header the code MUST be terminated
        die;
    }
}

require 'templates/layout/header.php';
require 'templates/registration.php';
require 'templates/layout/footer.php';