<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>
</head>

<body>
    <?php
    // Getting email from global $_POST
    $loginUser = trim($_POST['email']);
    // Sanitize it
    $sanitizedMail = filter_var($loginUser, FILTER_SANITIZE_EMAIL);
    //Connect
    $conn = mysqli_connect('localhost', 'root', '', 'fakify');
    // Defining query
    $query = "SELECT * FROM users WHERE mail = $sanitizedMail";
    // Send query 
    $results = mysqli_query($conn, $query);
    // Records from DB
    $nb_records = mysqli_num_rows($results);
    // Fetch
    $user = mysqli_fetch_assoc($results);
    ?>
    <nav>
        <!-- NavBar module -->
    </nav>
    <section>
        <h1>Welcome to Fakify <?php echo $user['first_name']; ?>!</h1>
        <p> Firstname : <?php echo $user['first_name']; ?></p>
        <p> Lastname : <?php echo $user['last_name'];  ?></p>
        <p> Email :<?php echo $user['mail'];  ?></p>
    </section>

</body>

</html>