<?php 
    session_start();
    if(!isset($_SESSION['username'])){
        header("Location:login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Page</title>
    <link rel="stylesheet" href="css/styles.css">
    <script type="text/javascript" src="js/validate.js"></script>
</head>

<body>
    <p>Welcome <?php echo $_SESSION['username'];?>!</p>
    <p>This is a private page</p>
    <p>We want to protect it</p>
    <p><a href="logout.php">Logout</a></p>
</body>

</html>