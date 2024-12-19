<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_level'] !== 1) {
    header("Location: login.php");
    exit();
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <?php include 'nav_admin.php';?>
<br/><br/><br/><br/>
<h1>Admin Page</h1>
    <img src="assets/chart1.jpeg">
    <img src="assets/chart2.png">
    <img src="assets/chart3.png">
    <?php include 'footer.php';?>
</body>
</html>