<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connection</title>
</head>

<body>
    <nav>
        <!-- NavBar module -->
    </nav>
    <main>
        <form action="home.php" method="post">
            <input type="email" name="email" placeholder="Enter your email address here">
            <input type="password" name="userPassword" placeholder="Enter your password here">
            <input type="loginButton" value="Login">
        </form>
        <?php
        if (isset($_POST['loginButton'])) {
            //Variables
            $loginUser = trim($_POST['email']);
            $loginPw = trim($_POST['userPassword']);
            $hashedPw = password_hash($loginPw, PASSWORD_DEFAULT);
            //Connect
            $conn = mysqli_connect('localhost', 'root', '', 'fakify');
            //Query
            $query = "SELECT * FROM users WHERE email = $loginUser";
            //Send query
            $results = mysqli_query($conn, $query);
            //Records from DB
            $nb_records = mysqli_num_rows($results);
            //Fetch
            $user = mysqli_fetch_assoc($results);
            //Check password match
            if (password_verify($hashedPw, $user['password'])) {
                session_start();
                //Save mail from form to session
                $_SESSION['mail'] = $_POST['email'];
            }
        }
        ?>
    </main>
</body>

</html>