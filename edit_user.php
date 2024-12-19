<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit a User</title>
    <link rel="stylesheet" href="css/edit-user.css">
</head>
<?php include 'nav_admin.php';?>
<body>
    <br/>

<div class="edit-content">
    <?php
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = $_GET['id'];
    } elseif (isset($_POST['id']) && is_numeric($_POST['id'])) {
        $id = $_POST['id'];
    } else {
        echo '<p>Invalid ID. Cannot proceed with editing.</p>';
        exit();
    }

    require('mysqli_connect.php');

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Handle the form submission
        $fname = mysqli_real_escape_string($dbcon, trim($_POST['fname']));
        $lname = mysqli_real_escape_string($dbcon, trim($_POST['lname']));

        $q = "UPDATE users SET fname='$fname', lname='$lname' WHERE user_id=$id LIMIT 1";
        $result = @mysqli_query($dbcon, $q);

        if (mysqli_affected_rows($dbcon) == 1) {
            echo '<p>The user information has been updated successfully.</p>';
            echo '<a class="buttones" href="view_users.php">Back To Registration Viewer</a>';
        } else {
            echo '<p>User information could not be updated, reason unknown.</p>';
            echo '<a class="buttones" href="view_users.php">Back To Registration Viewer</a>';
        }
    } else {
        // Fetch existing user data for editing
        $q = "SELECT fname, lname FROM users WHERE user_id=$id";
        $result = @mysqli_query($dbcon, $q);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        } else {
            echo '<h3>Invalid ID. Who are you?</h3>';
            exit();
        }
    }
    mysqli_close($dbcon);
    ?>

    <!-- Single Form for Editing User -->
    <div id="text-header">
        <h2>Edit User</h2>
    </div>
    <form action="edit_user.php" method="post">
        <p>First Name: <input type="text" name="fname" value="<?php echo htmlspecialchars($row['fname'] ?? ''); ?>" required></p>
        <p>Last Name: <input type="text" name="lname" value="<?php echo htmlspecialchars($row['lname'] ?? ''); ?>" required></p>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="submit" value="Update">
    </form>
</div>

    
</body>
<?php include 'footer.php';?>
</html>