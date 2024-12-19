<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete User</title>
    <link rel="stylesheet" href="css/delete.css">
</head>
<body>
    
    <div class="delete-container">
    <?php
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
} elseif (isset($_POST['id']) && is_numeric($_POST['id'])) {
    $id = $_POST['id'];
} else {
    echo '<p>Invalid ID. Cannot proceed with deletion.</p>';
    exit();
}
require('mysqli_connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['sure'] == 'Yes') {
        $q = "DELETE FROM users WHERE user_id=$id LIMIT 1";
        $result = @mysqli_query($dbcon, $q);

        if (mysqli_affected_rows($dbcon) == 1) {
            echo '<p>The user has been deleted successfully.</p>';
            echo '<a class="buttones" href="view_users.php">Back to Registration Viewer</a>';
        } else {
            echo '<p>User could not be deleted, reason unknown.</p>';
        }
    } else {
        echo '<p>Deletion canceled.</p>';
        echo '<p><a href="view_users.php">Go back to the user list</a></p>';
    }
} else {
    $q = "SELECT CONCAT(lname, ', ', fname) FROM users WHERE user_id=$id";
    $result = @mysqli_query($dbcon, $q);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result, MYSQLI_NUM);
        echo "<h3>Are you sure you want to delete $row[0]?</h3>";
        echo '<form action="delete_user.php" method="post">
                <input type="hidden" name="id" value="' . $id . '">
                <button type="submit" name="sure" value="Yes" class="button yes-button">Yes</button>
                <button type="submit" name="sure" value="No" class="button no-button">No</button>
              </form>';
    } else {
        echo '<h3>Invalid ID. Who are you?</h3>';
    }
}
mysqli_close($dbcon);
?>
    </div>
</body>
</html>