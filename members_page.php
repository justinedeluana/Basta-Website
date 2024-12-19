<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Members Page</title>
    <link rel="stylesheet" href="css/members-page.css">
    <link rel="stylesheet" href="css/chatbot.css">
    <script type="importmap">
      {
        "imports": {
          "@google/generative-ai": "https://esm.run/@google/generative-ai"
        }
      }
    </script>
</head>
<?php include 'nav_members.php'; ?>
<body class="memberspage">
    <br/><br/><br/>
    <h1>Welcome, <?php echo $_SESSION['fname']; ?>!</h1>
    <p>Content for regular users can go here.</p>
    
    <?php include 'chatbot.php'; ?>
    <br/><br/><br/>
    
</body>
<?php include 'footer.php'; ?>
</html>
