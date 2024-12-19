<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <link rel="stylesheet" href="css/logout.css">
</head>
<body>

<div class="con_out">
<?php
session_start(); // Start the session

// Check if the user is logged in and has a valid role
if (isset($_SESSION['user_level'])) {
    // Determine the cancel URL based on the user level
    $cancelUrl = ($_SESSION['user_level'] === 1) ? 'admin_page.php' : 'members_page.php';
    
    // Handle form submission for logout
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        session_unset(); // Clear session variables
        session_destroy(); // Destroy the session
        header("Location: index.php");
        exit();
    }
} else {
    // If the user is not logged in, redirect to the index page
    header("Location: index.php");
    exit();
}
?>

<h2>Are you sure you want to logout?</h2>
<form action="logout.php" method="post">
    <input type="submit" value="Logout" class="logout-button">
    <a href="<?php echo $cancelUrl; ?>" class="cancel-button">Cancel</a>
</form>
</div>

    
</body>
</html>
