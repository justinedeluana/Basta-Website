<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include 'nav_index.php';?>
    <div class="container">
    <!-- PHP login functions -->
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require('mysqli_connect.php');
    
    // Initialize variables
    $email = $psword = '';

    // Validate email (assuming the user logs in with email)
    if (empty($_POST['username'])) {
        echo '<p class="error">Please input an email address.</p>';
    } else {
        $email = mysqli_real_escape_string($dbcon, trim($_POST['username']));
    }

    // Validate password
    if (empty($_POST['password'])) {
        echo '<p class="error">Please input a password.</p>';
    } else {
        $password = mysqli_real_escape_string($dbcon, trim($_POST['password']));
    }

    // Proceed if both email and password are provided
    if ($email && $password) {
        // Query to retrieve user data
        $q = "SELECT user_id, fname, user_level, psword FROM users WHERE email = '$email'";
        $result = mysqli_query($dbcon, $q);

        if ($result && mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            // Verify password
            if (password_verify($password, $row['psword'])) {
                session_start();
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['fname'] = $row['fname'];
                $_SESSION['user_level'] = (int) $row['user_level'];

                // Redirect based on user level
                if ($_SESSION['user_level'] === 1) {
                    header('Location: admin_page.php');
                } else {
                    header('Location: members_page.php');
                }
                exit();
            } else {
                echo '<p class="error">Incorrect password.</p>';
            }
        } else {
            echo '<p class="error">Email not found. Please register first.</p>';
        }

        // Free the result set
        if ($result) {
            mysqli_free_result($result);
        }
    } else {
        echo '<p class="error">Please try again. Both fields are required.</p>';
    }

    // Close the database connection
    mysqli_close($dbcon);
}
?>
<!-- HTML Form for Login -->
<div class="login-form">
    <h2>Login</h2>
    <form action="login.php" method="post">
        <label for="username">Email:</label><br>
        <input type="text" id="username" name="username" required><br>
        
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>

        <input type="submit" value="Login">
    </form>
    <a href="register.php">Create an Account</a>
</div>
    </div>


    <?php include 'footer.php';?>
</body>
</html>