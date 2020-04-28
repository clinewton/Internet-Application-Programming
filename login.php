<?php
    include_once 'DBConnector.php';
    include_once 'user.php';

    if(isset($_POST['btn_login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $instance = User::create();
        $instance->openConnection();
        $instance->setPassword();
        $instance->setUsername();

        if($instance->isPasswordcorrect()){
            $instance->login();
            $instance->closeConnection();
            $instance->createUserSession();
        } else {
            header("Location:login.php");
        }
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Login</title>
        <link rel="stylesheet" href="css/styles.css">
        <script type="text/javascript" src="js/validate.js"></script>
    </head>

    <body>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="login" id="login">
            <table align="center">
                <tr>
                    <td><input type="text" name="username" placeholder="Username" required></td>
                </tr>
                <tr>
                    <td><input type="password" name="password" placeholder="Password" required></td>
                </tr>
                <tr>
                    <td><button type="submit" name="btn-login"><strong>LOGIN</strong></button></td>
                </tr>
            </table>
        </form>

    </body>

    </html>