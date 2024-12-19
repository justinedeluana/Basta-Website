<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Users</title>
    <link rel="stylesheet" href="css/view-users.css">
</head>
<?php include 'nav_admin.php'; ?>
<body>
    <br />
    
<div class="table">
    <?php
    // Include the database connection
    require("mysqli_connect.php");

    if (!$dbcon) {
        echo "<p class='error'>Unable to connect to the database. Please try again later.</p>";
        exit();
    }

    // Define and execute the query
    $q = "SELECT user_id, fname, lname, email, DATE_FORMAT(registration_date, '%M %D, %Y') AS regdat 
          FROM users 
          ORDER BY user_id ASC";

    $result = mysqli_query($dbcon, $q);

    if ($result && mysqli_num_rows($result) > 0) {
        echo "<table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Registration Date</th>
                    <th>Email Address</th>
                    <th colspan='2'>Action</th>
                </tr>
            </thead>
            <tbody>";

        // Fetch and display rows
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            echo "<tr>
                <td>{$row['fname']} {$row['lname']}</td>
                <td>{$row['regdat']}</td>
                <td>{$row['email']}</td>
                <td><a href='edit_user.php?id={$row['user_id']}'>Edit</a></td>
                <td><a href='delete_user.php?id={$row['user_id']}'>Delete</a></td>
            </tr>";
        }

        echo "</tbody>
        </table>";
    } else {
        echo "<p class='error'>The current registered users cannot be retrieved or there are no users available.</p>";
    }

    // Close the database connection
    mysqli_close($dbcon);
    ?>
    </div>
</body>
</html>
