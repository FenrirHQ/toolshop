<?php
// Sjá bls. 466,  PHP Solution 17-1: Creating a User Registration Form

$errors = [];

if (isset($_POST['registerUser'])) {
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $email = trim($_POST['email']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);


    require_once 'connection.php';
    require_once 'Users.php';

    $dbUsers = new Users($conn);
    $status = $dbUsers->newUser($firstname,$lastname,$email,$username,$password);

    if ($status) {
        $success = "$username has been registered. You may now log in.";
    }
    else{
        $errors[] = "$username is already in use. Please choose another username.";
    } 
}
else if (isset($_POST['updateUser'])) {
    $userId = trim($_POST['userId']);
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $email = trim($_POST['email']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);


    require_once 'connection.php';
    require_once 'Users.php';

    $dbUsers = new Users($conn);
    $status = $dbUsers->updateUser($userId,$firstname,$lastname,$email,$username,$password);

    if ($status) {
        $success = "$username has been updated.";
    }
    else{
        $errors[] = "Error occured.";
    } 
}
else if (isset($_POST['registerCat'])) {
    $newCatName = trim($_POST['newCatName']);

    require_once 'connection.php';
    require_once 'Image.php';

    $db_object = new Images($conn);
    $status = $db_object->newCategory($newCatName);

    if ($status) {
        $success = "$newCatName has been created.";
    }
    else{
        $errors[] = "$newCatName is already in use. Please choose another Category name.";
    } 
}

else if (isset($_POST['registerImg'])) {
    $newImgName = trim($_POST['newImgName']);
    $newImgPath = trim($_POST['newImgPath']);
    $newImgDesc = trim($_POST['newImgDesc']);
    $newImgCatNum = trim($_POST['newImgCatNum']);


    require_once 'connection.php';
    require_once 'Image.php';

    $db_object = new Images($conn);
    $status = $db_object->newImageInfo($newImgName,$newImgPath,$newImgDesc,$newImgCatNum);

    if ($status) {
        $success = "$newImgName has been created.";
    }
    else{
        $errors[] = "$newImgName is already in use. Please choose another image name.";
    } 
}

/* Annað dæmi um notkun:
    // Sækjum user (skilar fylki)
    $user = $dbUsers->getUser(1);
    
    // kíkjum í user array
    print_r($user);

    echo "<br>";

    // birtum bara nafnið Konráð (sæti nr. 2 í array)
    echo "$user[1]";
 */

?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Register user</title>
    <style>
        label {
            display:inline-block;
            width:125px;
            text-align:right;
            padding-right:2px;
        }
        input[type="submit"] {
            margin-left:132px;
        }
    </style>
</head>

<body>
<h1>Register user</h1>
<?php
if (isset($success)) {
    echo "<p>$success</p>";
} elseif (isset($errors) && !empty($errors)) {
    echo '<ul>';
    foreach ($errors as $error) {
        echo "<li>$error</li>";
    }
    echo '</ul>';
}else{
?>
<form method="post" action="">
    <p>
        <label for="username">firstname:</label>
        <input type="text" name="firstname" id="firstname" required>
    </p>
      <p>
        <label for="username">lastname:</label>
        <input type="text" name="lastname" id="lastname" required>
    </p>
    <p>
        <label for="username">email:</label>
        <input type="text" name="email" id="email" required>
    </p>
     <p>
        <label for="username">username:</label>
        <input type="text" name="username" id="username" required>
    </p>
    <p>
        <label for="pwd">Password:</label>
        <input type="password" name="password" id="password" required>
    </p>
 
    <p>
        <input name="registerUser" type="submit" id="registerUser" value="Register">
    </p>
</form>
<form method="post" action="">
    <p>
        <label for="userId">UserID to update:</label>
        <input type="text" name="userId" id="userId" required>
    </p>
    <p>
        <label for="firstname">Firstname:</label>
        <input type="text" name="firstname" id="firstname" required>
    </p>
      <p>
        <label for="lastname">Lastname:</label>
        <input type="text" name="lastname" id="lastname" required>
    </p>
    <p>
        <label for="email">email:</label>
        <input type="text" name="email" id="email" required>
    </p>
     <p>
        <label for="username">username:</label>
        <input type="text" name="username" id="username" required>
    </p>
    <p>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>
    </p>
 
    <p>
        <input name="registerUser" type="submit" id="registerUser" value="Register">
    </p>
</form>
<form method="post" action="">
    <p>
        <label for="newCatName">New category name:</label>
        <input type="text" name="newCatName" id="newCatName" required>
    </p>
    <p>
        <input name="registerCat" type="submit" id="registerCat" value="Register">
    </p>
</form>
<form method="post" action="">
    <p>
        <label for="newImgName">New image name:</label>
        <input type="text" name="newImgName" id="newImgName" required>
    </p>
      <p>
        <label for="newImgPath">Image path ex. "Images/Lambo1.jpg":</label>
        <input type="text" name="newImgPath" id="newImgPath" required>
    </p>
    <p>
        <label for="newImgDesc">Description:</label>
        <input type="text" name="newImgDesc" id="newImgDesc" required>
    </p>
     <p>
        <label for="newImgCatNum">Category number (int):</label>
        <input type="text" name="newImgCatNum" id="newImgCatNum" required>
    </p>
    <p>
        <input name="registerImg" type="submit" id="registerImg" value="Register">
    </p>
</form>
<?php } ?>
</body>
</html>