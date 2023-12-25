<?php

// session_start();
$user_id = $_GET['userid'];
// echo $user_id;
// var_dump($_SESSION['user_id']);

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");


// Retrieve the value of the 'username' session variable

require_once "../backend/dbconn.php";

$query = "SELECT * FROM booking WHERE user_id = '$user_id'";

$result = mysqli_query($conn, $query) or die("Select Query Failed.");

$count = mysqli_num_rows($result);


if($count > 0)
{ 
     $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
     http_response_code(200);
     echo json_encode($row);
}
else
{ 
    http_response_code(400);
    echo json_encode(array("message" => "No Booking Found.", "status" => false));
}
