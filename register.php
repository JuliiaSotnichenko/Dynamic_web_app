<?php

$errors = array();

if (isset($_POST['btnReg'])) {
    $firstName = trim($_POST['first_name']);
    $lastName = trim($_POST['last_name']);
    $mail = trim($_POST['email']);
    $password = trim($_POST['password']);
    $sanitizeEmail = filter_var($mail, FILTER_SANITIZE_EMAIL);

    if (empty($firstName)) {
    $errors['first_name'] = 'First name is mandatory.<br>';
    }

    if (empty($lastName)) {
    $errors['last_name'] = 'Last name is mandatory.<br>';
    }

    if (!filter_var($sanitizeEmail, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'Email has to be a valid one.<br>';
    }

    if (empty($password)) {
    $errors['password'] = 'Password is mandatory.<br>';
    }

        if (count($errors) == 0) {
        include_once 'database.php';
        $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);

    // check if email is already taken
         $query = "SELECT * FROM users WHERE mail = '$sanitizeEmail'";

         $resultMail = mysqli_query($conn, $query);

        if (mysqli_num_rows($resultMail) > 0) {
        $errors['email'] = 'Email already taken';

        } else {
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);
        // Insert to DB
        $query = "INSERT INTO users(first_name, last_name, mail, password)
        VALUES('$firstName', '$lastName ','$sanitizeEmail', '$hashPassword')";

        $result = mysqli_query($conn, $query);

        if ($result)
        echo 'Insert successfull.';
        else
        echo 'Something went wrong inserting.';
    }
}
}




?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    


<form action="account.php" method="POST">
        <input type="email" name="email" placeholder="Enter your email"><br>
        <?php if (isset($errors['email'])) echo $errors['email'] ?>

        <input type="password" name="password" placeholder="Enter your password"><br>
        <?php if (isset($errors['password'])) echo $errors['password'] ?>

        <input type="text" name="first_name" placeholder="Enter your First name"><br>
        <?php if (isset($errors['first_name'])) echo $errors['first_name'] ?>

        <input type="text" name="last_name" placeholder="Enter your Last name"><br>
        <?php if (isset($errors['last_name'])) echo $errors['last_name'] ?>

        <input type="submit" name="btnReg" value="Register">
    </form>










</body>
</html>