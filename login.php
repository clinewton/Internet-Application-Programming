<?php
    include_once 'user.php';

    if(isset($_POST['btn-login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $instance = User::create();
        $instance->openConnection();
        $instance->setPassword($password);
        $instance->setUsername($username);

        if($instance->isPasswordcorrect()){
            $instance->login();
            $instance->createUserSession();
        } else {
            $instance->createLoginErrorSessions();
            header("Refresh:0");
            die();
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

        <form method="post" name="login" id="login" action="<?php echo $_SERVER['PHP_SELF'];?>" >
            <table align="center">
            <tr>
                    <td>
                        <div id="form-errors">
                            <?php
                                session_start();
                                if(!empty($_SESSION['form_errors'])){
                                    echo " " . $_SESSION['form_errors'];
                                    unset($_SESSION['form_errors']);
                                }
                            ?>
                        </div>
                    </td>
                </tr>
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