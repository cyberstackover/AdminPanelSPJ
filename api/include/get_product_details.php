<?php
$response = array();


// include db connect class
require_once __DIR__ . '/db_konek.php';

// connecting to db
$db = new DB_CONNECT();

// check for post data
if (isset($_GET["uid"])) {
    $uid = $_GET['uid'];

    // get a product from users table
    $result = mysql_query("SELECT *FROM users WHERE uid = $uid");

    if (!empty($result)) {
        // check for empty result
        if (mysql_num_rows($result) > 0) {

            $result = mysql_fetch_array($result);

             $product = array();
        $product["uid"] = $row["uid"];
        $product["unique_id"] = $row["unique_id"];
        $product["name"] = $row["name"];
        $product["email"] = $row["email"];
        $product["encrypted_password"] = $row["encrypted_password"];
        $product["salt"] = $row["salt"];
        $product["created_at"] = $row["created_at"];
        $product["updated_at"] = $row["updated_at"];
            // success
            $response["success"] = 1;

            // user node
            $response["product"] = array();

            array_push($response["product"], $product);

            // echoing JSON response
            echo json_encode($response);
        } else {
            // no product found
            $response["success"] = 0;
            $response["message"] = "No product found";

            // echo no users JSON
            echo json_encode($response);
        }
    } else {
        // no product found
        $response["success"] = 0;
        $response["message"] = "No product found";

        // echo no users JSON
        echo json_encode($response);
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";

    // echoing JSON response
    echo json_encode($response);
}
?>