<?php 
    include_once 'user.php';
    session_start();
    if(!isset($_SESSION['username'])){
        header("Location:login.php");
    }

    function fetchUserApiKey(){
        echo "API Key";
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0-11/css/all.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="js/validate.js"></script>
    <script src="js/apikey.js"></script>
</head>

<body>
    <p>Welcome
        <?php echo $_SESSION['username'];?>!</p>
    <p>This is a private page</p>
    <p>We want to protect it</p>
    <p align="right"><a href="logout.php">Log Out</a></p>
    <hr>
    <!--Display user details form the database-->
    <h4>User Details</h4>
    <table>
        <thead>
            <td>First Name</td>
            <td>Last Name</td>
            <td>City</td>
            <td>Registration Date</td>
        </thead>
        <tbody>
            <?php
                $user = User::create();
                $result = $user->readUser($_SESSION['username']);
                if ($result):
                    if (mysqli_num_rows($result)>0):
                        while ($user = mysqli_fetch_assoc($result)):
            ?>
            <tr>
                <td><?php echo $user['first_name']; ?></td>
                <td><?php echo $user['last_name']; ?></td>
                <td><?php echo $user['user_city']; ?></td>
                <td><?php echo date("M jS, Y h:i:s a",($user['time']+$user['offset'])/1000); ?></td>
            </tr>
            <?php
                        endwhile;
                    endif;
                endif;
            ?>
        </tbody>
    </table>
    <hr>
    <h3>Here, we will create an API that will allow Users/Developers to order items from external systems</h3>
    <hr>
    <h4>We now put this feature of allowing users to generate an API key. Click the button below to generate the API key</h4>
    <button class="btn btn-primary" id="api-key-btn">Generate API Key</button><br><br>

    <strong>Your API Key:</strong>(Note that if your API key is already in use by already running applications, generating a new key will stop the application from functioning)<br>
    <textarea name="api_key" id="api_key" cols="100" rows="2"><?php echo fetchUserApiKey(); ?></textarea>

    <h3>Service Description:</h3>
    <p>We have a service/API that allows external applications to order food and also pull all order status by using order id. Let's do it.</p>
    <hr>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.15.0/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>