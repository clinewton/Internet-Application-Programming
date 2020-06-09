<?php
include_once 'DBConnector.php';
include_once 'user.php';
include_once 'fileUploader.php';

if(isset($_POST['btn-save']) && isset($_FILES['fileToUpload'])){
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $city = $_POST['city_name'];

    $username = $_POST['username'];
    $password = $_POST['password'];

    $utc_timestamp = $_POST['utc_timestamp'];
    $offset = $_POST['time_zone_offset'];

    $file_name = $_FILES['fileToUpload']['name'];
    $file_size = $_FILES['fileToUpload']['size'];
    $tmp_name = $_FILES['fileToUpload']['tmp_name'];
    $file_type = pathinfo(basename($file_name),PATHINFO_EXTENSION);

    $user = new User($first_name,$last_name,$city,$username,$password,$utc_timestamp,$offset,$file_name);
    
    $uploader = new FileUploader;
    $uploader->setOriginalName($file_name);
    $uploader->setFileType($file_type);
    $uploader->setFileSize($file_size);
    $uploader->setFinalFileName($tmp_name);
    
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

    if($uploader->uploadFile()){
        echo "File uploaded successfully!<br>";
        $res = $user->save();
        if($res){
            echo "Save operation successful<br>";
        } else {
            echo "An error occurred!\n";
        }
    } else {
        echo "File could not be uploaded!<br>User could not be created";
    }
    
}

function display(){
    $user = User::create();
    return $user->readAll();
}
?>
</html>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Lab 1</title>
        <link rel="stylesheet" href="css/styles.css">
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jstimezonedetect/1.0.4/jstz.min.js">
</script>
    </head>

    <body>
        <form method="post" name="user_details" id="user_details" onsubmit="return validateForm()" action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
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
                    <td><input type="text" name="first_name" placeholder="First Name"></td>
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
                    <td>Profile Image: <input type="file" name="fileToUpload" id="fileToUpload"></td>
                </tr>
                <tr>
                    <td><button type="submit" name="btn-save"><strong>SAVE</strong></button></td>
                </tr>

                <input type="hidden" name="utc_timestamp" id="utc_timestamp" value="">
                <input type="hidden" name="time_zone_offset" id="time_zone_offset" value="">
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
                <td>UTC Time (milliseconds)</td>
                <td>Offset (milliseconds)</td>
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
                    <td>
                        <?php echo $users['time']; ?>
                    </td>
                    <td>
                        <?php echo $users['offset']; ?>
                    </td>
                </tr>
                <?php
                            endwhile;
                        endif;
                    endif;
                ?>
            </tbody>
        </table>

        
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script type="text/javascript" src="js/validate.js"></script>
        <script type="text/javascript" src="js/timezone.js"></script>
    </body>

    </html>
    