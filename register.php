<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a Account</title>
    <link rel="stylesheet" href="css/register-page.css">
</head>
<?php include 'nav_index.php'; ?>
<body>

    <div class="register-container">
        <div class="regform">
            <h2 class="hider">Create an Account</h2>
            <?php
            require ('mysqli_connect.php'); 
            if (!$dbcon) {
                die('Database connection failed: ' . mysqli_connect_error());
            }

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $errors = array();
                if (empty($_POST['fname'])) {
                    $errors[] = "Please Enter Your First Name.";
                } else {
                    $fn = trim($_POST['fname']);                    
                }

                if (empty($_POST['lname'])) {
                    $errors[] = "Please Enter Your Last Name.";
                } else {
                    $ln = trim($_POST['lname']); 
                }

                if (empty($_POST['email'])) {
                    $errors[] = "Please Enter Your Email Address."; 
                } else {
                    $email = trim($_POST['email']);
                }

                if (empty($_POST['psword1'])) {
                    $errors[] = "Please Enter Your Password.";
                } elseif ($_POST['psword1'] !== $_POST['psword2']) {
                    $errors[] = "Your Passwords Do Not Match."; 
                } else {
                    $p = trim($_POST["psword1"]);
                }

                if (!empty($errors)) {
                    echo '<h2>Error!</h2>
                        <p class="error">The Following Error(s) Occurred: <br>';
                    foreach ($errors as $msg) {
                        echo " - $msg<br/>";
                    }   
                    echo '</p><h4>Please Try Again</h4><br/>';
                    echo '<a class="button" href = "register.php">Back to Create Account</a>';

                } else {
                    $p = password_hash($p, PASSWORD_DEFAULT); 
                    // Directly execute the query without prepared statements
                    $q = "INSERT INTO users (fname, lname, email, psword, registration_date) VALUES ('$fn', '$ln', '$email', '$p', NOW())"; 
                    $result = mysqli_query($dbcon, $q);
                    
                    if ($result) {
                        header("location: register_success.php"); 
                        exit();    
                    } else {
                        echo '<h2>System Error</h2>
                              <p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>'; 
                        echo '<p>' . mysqli_error($dbcon) . '</p>';
                    }
                }
                mysqli_close($dbcon);
                
                exit();
            }
            ?>

            <form action="register.php" method="post">
                <p class="input-group">
                    <label class="label" for="fname">First Name: </label>
                    <input type="text" id="fname" name="fname" size="30" maxlength="40" value="<?php if(isset($_POST['fname'])) echo $_POST['fname']; ?>">
                </p>
                <p class="input-group">
                    <label class="label" for="lname">Last Name: </label>
                    <input type="text" id="lname" name="lname" size="30" maxlength="40" value="<?php if(isset($_POST['lname'])) echo $_POST['lname']; ?>">
                </p>
                <p class="input-group">
                    <label class="label" for="email">Email Address: </label>
                    <input type="email" id="email" name="email" size="30" maxlength="40" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>">
                </p>
                <p class="input-group">
                    <label class="label" for="psword1">Password: </label>
                    <input type="password" id="psword1" name="psword1" size="20" maxlength="40">
                </p>
                <p class="input-group">
                    <label class="label" for="psword2">Confirm Password: </label>
                    <input type="password" id="psword2" name="psword2" size="20" maxlength="40">
                </p>
                <p class="input-group">
                    <input type="submit" id="submit" name="submit" value="Create">
                </p>
            </form>
        </div>
    </div>
</body>

<?php include 'footer.php';?>
</html>