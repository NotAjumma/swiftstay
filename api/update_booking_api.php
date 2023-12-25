<?php

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Allow-Headers: Acess-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods, Authorization");


$data = json_decode(file_get_contents("php://input"), true);
echo '<p>Receiving data from product client to product create API: ';
echo '</p>';
$book_id = $data["book_id"];
$date_chin = $data["date_chin"];
$date_chout = $data["date_chout"];

require_once "../backend/dbconn.php";

$query = "UPDATE booking SET date_chin = '" . $date_chin . "' , date_chout = '" . $date_chout . "'" . " WHERE book_id = " . $book_id;
echo $query;
$result = mysqli_query($conn, $query) or die("Update Query Failed");
if ($result) {
    if (mysqli_affected_rows($conn) > 0) {
        echo '<br>';
        echo json_encode(array("message" => mysqli_affected_rows($conn) . " Booking Updated Successfully", "status" => true));
    } else {
        echo json_encode(array("message" => "Failed Booking Not Updated ", "status" => false));
    }
} else {
    echo json_encode(array("message" => "Failed Booking Not Updated ", "status" => false));
}
