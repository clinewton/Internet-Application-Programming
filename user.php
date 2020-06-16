<?php
    include 'DBConnector.php';
    include "Crud.php";
    include "Authenticator.php";

    class User implements Crud, Authenticator{
        private $user_id;
        private $first_name;
        private $last_name;
        private $city_name;

        private $username;
        private $password;

        private $timestamp;
        private $offset;
        private $image;
        
        function __construct($first_name, $last_name, $city_name, $username, $password, $timestamp, $offset,$image){
            $this->first_name = $first_name;
            $this->last_name = $last_name;
            $this->city_name = $city_name;
            $this->username = $username;
            $this->password = $password;
            $this->timestamp = $timestamp;
            $this->offset = $offset;
            $this->image = $image;
        }

        public static function create(){
            $instance = new ReflectionClass(__CLASS__);
            return $instance->newInstanceWithoutConstructor();
        }
        //user_id setter
        public function setUserId($user_id){
            $this->user_id = $user_id;
        }

        //user_id getter
        public function getUserId(){
            return $this->user_id;
        }
        //username setter
        public function setUsername($username){
            $this->username = $username;
        }

        //username getter
        public function getUsername(){
            return $this->username;
        }
        //password setter
        public function setPassword($password){
            $this->password = $password;
        }

        //password getter
        public function getPassword(){
            return $this->password;
        }

        //time getter
        public function getTimestamp(){
            return $this->timestamp;
        }
        //time setter
        public function setTimestamp($timestamp){
            $this->timestamp = $timestamp;
        }

        //offset getter
        public function getOffset(){
            return $this->offset;
        }
        //offset setter
        public function setOffset($offset){
            $this->offset = $offset;
        }

        //open DB connection
        public function openConnection(){
            $conn = new DBConncetor;
            return $conn->__construct();
        }

        //close DB connection
        public function closeConnection(){
            $conn = new DBConncetor;
            return $conn->closeDatabase();
        }
        public function save(){
            $fn = $this->first_name;
            $ln = $this->last_name;
            $city = $this->city_name;
            $uname = $this->username;
            $this->hashPassword();
            $pass = $this->password;
            $time = $this->timestamp;
            $offset = $this->offset;
            $image = $this->image;
            $link = $this->openConnection();
            $res = mysqli_query($link,"INSERT INTO user(first_name,last_name,user_city,username,password,time,offset,image) VALUES ('$fn','$ln','$city','$uname','$pass','$time','$offset','$image')") or die ("Error: " .mysqli_error($link));
            $this->closeConnection();
            return $res;
        }

        public function readAll(){
            $sql = "SELECT * FROM user";
            $link = $this->openConnection();
            $res = mysqli_query($link,$sql) or die ("Error: " .mysqli_error($link));
            $this->closeConnection();
            return $res;
        }

        public function readUser($username){
            $sql = "SELECT * FROM user WHERE username = '$username'";
            $link = $this->openConnection();
            $res = mysqli_query($link, $sql) or die ("Error: " .mysqli_error($link));
            $this->closeConnection();
            return $res;
        }

        public function readUnique(){
            return null;
        }

        public function search(){
            return null;
        }

        public function update(){
            return null;
        }

        public function removeOne(){
            return null;
        }

        public function removeAll(){
            return null;
        }

        public function validateForm(){
            $fn = $this->first_name;
            $ln = $this->last_name;
            $city = $this->city_name;

            if($fn == "" || $ln == "" || $city == ""){
                return false;
            }
            return true;
        }

        public function createFormErrorSessions(){
            session_start();
            $_SESSION['form_errors'] = "All fields are required";
        }

        public function createUserErrorSessions(){
            session_start();
            $_SESSION['form_errors'] = "Username already exists";
        }

        public function createLoginErrorSessions(){
            session_start();
            $_SESSION['form_errors'] = "Invalid username/password combination";
        }

        public function hashPassword(){
            $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        }

        public function isPasswordCorrect(){
            $con = $this->openConnection();
            $found = false;
            $res = mysqli_query($con,"SELECT * FROM user") or die("Error: " . mysqli_error($con));

            while($row=mysqli_fetch_array($res)){
                if(password_verify($this->getPassword(),$row['password']) && $this->getUsername() == $row['username']){
                    $found = true;
                }
            }

            $this->closeConnection();
            return $found;
        }

        public function login(){
            if($this->isPasswordCorrect()){
                header("Location:private_page.php");
            }
        }

        public function createUserSession(){
            session_start();
            $_SESSION['username'] = $this->getUsername();
        }

        public function logout(){
            session_start();
            unset($_SESSION['username']);
            session_destroy();
            header("Location:lab1.php");
        }

        public function isUserExist(){
            $con = $this->openConnection();
            $found = false;
            $res = mysqli_query($con, "SELECT * FROM user") or die("Error: " . mysqli_error($con));

            while($row=mysqli_fetch_array($res)){
                if($this->getUsername() == $row['username']){
                    $found = true;
                }
            }

            $this->closeConnection();
            return $found;
        }
    }
?>