<?php

require_once __DIR__ . '/config_lola.php';


$markers = array();
$sql = "select lat,lng from markers";
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if($res = $mysqli->query($sql)){
	while($row=$res->fetch_assoc()){
                $lat = $row['lat'];
	        $lng = $row['lng'];
                $data= array("lat"=>$lat,"lng"=>$lng);
                $marker[] = $data;
	}

        $markers = array("markers"=>$marker);

        echo json_encode($markers);
}


?>