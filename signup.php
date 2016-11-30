<?php 
if (isset($_POST['registerUser'])) {
    $firstname = trim($_POST['reg_firstname']);
    $lastname = trim($_POST['reg_lastname']);
    $email = trim($_POST['reg_email']);
    $username = trim($_POST['reg_username']);
    $password = trim($_POST['reg_password']);

    require_once 'procedures.php';

    $dbUsers = new Users($conn);
    $status = $dbUsers->newUser($firstname,$lastname,$email,$username,$password);

    if ($status) {
        $success = "$username has been registered. You may now log in.";
    }
    else{
        $errors[] = "$username is already in use. Please choose another username.";
    } 
}
?>