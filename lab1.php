<?php
include_once 'DBConnector.php';
include_once 'user.php';

if(isset($_POST['btn-save'])){
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $city = $_POST['city_name'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = new User($first_name,$last_name,$city,$username,$password);
    if(!$user->validateForm()){
        $user->createFormErrorSessions();
        header("Refresh:0");
        die();
    }

    if($user->isUserExist()){
        $user->createUserErrorSessions();
        header("Refresh:0");
        die();
    }

    $res = $user->save();

    if($res){
        echo "Save operation successful";
    } else {
        echo "An error occured!";
    }
}

function display(){
    $user = User::create();
    return $user->readAll();
}
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Lab 1</title>
        <link rel="stylesheet" href="css/styles.css">
        <script type="text/javascript" src="js/validate.js"></script>
    </head>

    <body>
        <form method="post" name="user_details" id="user_details" onsubmit="return validateForm()" action="<?php echo $_SERVER['PHP_SELF'];?>">
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
                    <td><input type="text" name="first_name" placeholder="First Name" required></td>
                </tr>
                <tr>
                    <td><input type="text" name="last_name" placeholder="Last Name"></td>
                </tr>
                <tr>
                    <td><input type="text" name="city_name" placeholder="City"></td>
                </tr>
                <tr>
                    <td><input type="text" name="username" placeholder="Username"></td>
                </tr>
                <tr>
                    <td><input type="password" name="password" placeholder="Password"></td>
                </tr>
                <tr>
                    <td><button type="submit" name="btn-save"><strong>SAVE</strong></button></td>
                </tr>
                <tr>
                    <td><a href="login.php">Login</a></td>
                </tr>
            </table>
        </form>

        <h2><strong>Users</strong>
        </h2>
        <table>
            <thead>
                <td>User Id</td>
                <td>First Name</td>
                <td>Last Name</td>
                <td>User City</td>
            </thead>
            <tbody>
                <?php 
                    $result = display();
                    if($result):
                        if(mysqli_num_rows($result)>0):
                            while($users = mysqli_fetch_assoc($result)): 
                ?>
                    <tr>
                        <td>
                            <?php echo $users['id']; ?>
                        </td>
                        <td>
                            <?php echo $users['first_name']; ?>
                        </td>
                        <td>
                            <?php echo $users['last_name']; ?>
                        </td>
                        <td>
                            <?php echo $users['user_city']; ?>
                        </td>
                    </tr>
                    <?php
                            endwhile;
                        endif;
                    endif;
                ?>
            </tbody>
        </table>
    </body>

    </html>