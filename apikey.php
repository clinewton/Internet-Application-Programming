<?php
include_once 'DBConnector.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST'){
    //We do not allow users to visit this page via a URL
    header('HTTP/1.0 403 Forbidden');
    echo "You are forbidden!";
} else {
    $api_key = null;
    $api_key = generateApiKey(64);//We generate a key 64 characters long
    header('Content-type: application/json');
    //our response is a json one
    echo generateResponse($api_key);
}

//this is how we generate a key

function generateApiKey($str_length){
    //base 62 map
    $chars = 'wuibcuyve8wibueock2398bdocwm389bhsadvu2398h87g';

    // get enough random bits for base 64 encoding (and prevent '=' padding)
    // note: +1 is faster than ceil()
    $bytes = openssl_random_pseudo_bytes(3*$str_length/4+1);

    // convert base 64 to base 62 by mapping + and / to something from the base 62 map
    // use the first 2 random bytes for the new characters
    $repl = unpack('C2', $bytes);

    $first = $chars[$repl[1]%62];
    $second = $chars[$repl[2]%62];
    return strtr(substr(base64_encode($bytes), 0, $str_length), '+/',"$first$second");
}

function saveApiKey($api_key){
    //save API key generated of the user
    //returns true if the key is saved , false otherwise
    $conn = new DBConncetor();
    $link = $conn->__construct();
    $username = $_SESSION['username'];
    $query = "INSERT INTO api_keys(user_id,api_key) VALUES ((SELECT id FROM user WHERE username = '$username'),'$api_key')";
    $res = mysqli_query($link, $query) or die("Error: " .mysqli_error($link));

    if($res){
        return true;
    } else {
        return false;
    }
}

function generateResponse($api_key){
    if (saveApiKey($api_key)){
        $res = ['success' => 1, 'message' => $api_key];
    } else {
        $res = ['success' => 0, 'message' => 'Something went wrong. Please regenerate the API key'];
    }
    return json_encode($res);
}
?>