<?php
    include_once '../../../DBConnector.php';

    class ApiHandler{
        private $meal_name;
        private $meal_units;
        private $unit_price;
        private $status;
        private $user_api_key;

        //getters and setters
        public function setMealName($meal_name){
            $this->meal_name = $meal_name;
        }

        public function getMealName(){
            return $this->meal_name;
        }

        public function setMealUnits($meal_units){
            $this->meal_units = $meal_units;
        }

        public function getMealUnits(){
            return $this->meal_units;
        }

        public function setUnitPrice($unit_price){
            $this->unit_price = $unit_price;
        }

        public function getUnitPrice(){
            return $this->unit_price;
        }

        public function setStatus($status){
            $this->status = $status;
        }

        public function getStatus(){
            return $this->status;
        }

        public function setUserApiKey($key){
            $this->user_api_key = $key;
        }

        public function getUserApiKey(){
            return $this->user_api_key;
        }

        public function createOrder(){
            //saving the incoming order
            $con = new DBConncetor();
            $link = $con->__construct();
            $name = $this->meal_name;
            $units = $this->meal_units;
            $unit_price = $this->unit_price;
            $order_status = $this->status;
            $query = "INSERT INTO orders (order_name,units,unit_price,order_status) VALUES('$name','$units','$unit_price','$order_status')";
            $res = mysqli_query($link,$query) or die("Error: " .mysqli_error($link));
            return $res;
        }

        public function checkOrderStatus($order_id){
            $con = new DBConncetor();
            $link = $con->__construct();
            $query = "SELECT * FROM orders WHERE order_id = '$order_id'";
            $res = mysqli_query($link, $query) or die("Error: " .mysqli_error($link));
            $con->closeDatabase();
            return $res;
        }

        public function fetchAllOrders(){}

        public function checkApiKey(){
            $conn = new DBConncetor();
            $link = $conn->__construct();
            $api_key = $this->user_api_key;
            $key_exists = false;
            $result = mysqli_query($link,"SELECT * FROM api_keys") or die("Error: " .mysqli_error($link));

            while ($row = mysqli_fetch_array($result)){
                if($api_key == $row['api_key']){
                    $key_exists = true;
                }
            }

            $conn->closeDatabase();
            return $key_exists;
        }

        public function checkContentType(){}
    }
?>