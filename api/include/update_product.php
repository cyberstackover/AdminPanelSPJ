<?php

/*
 * Following code will update a product information
 * A product is identified by product id (uid)
 */
//require_once 'DB_Functions.php';

// array for JSON response
$response = array();

// check for required fields
if (isset($_POST['uid']) && isset($_POST['name']) && isset($_POST['email'])) {
    
    
    //$hash = $this->hashSSHA($encrypted_password);
   //$encrypted_password = $_POST["encrypted_password"]; // encrypted password
   //$salt = $hash["salt"];
   //------------------------------------
    $uid = $_POST['uid'];
    $name = $_POST['name'];
    $email = $_POST['email'];
 //   $encrypted_password = $_POST['encrypted_password'];

    // include db connect class
    require_once __DIR__ . '/db_konek.php';

    // connecting to db
    $db = new DB_CONNECT();

    // mysql update row with matched uid
    $result = mysql_query("UPDATE users SET name = '$name', email = '$email' WHERE uid = $uid");

    // check if row inserted or not
    if ($result) {
        // successfully updated
        $response["success"] = 1;
        $response["message"] = "Product successfully updated.";
        
        // echoing JSON response
        echo json_encode($response);
    } else {
        
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";

    // echoing JSON response
    echo json_encode($response);
}
?>
