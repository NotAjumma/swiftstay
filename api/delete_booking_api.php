<?php

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Allow-Headers: Acess-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods, Authorization");

//$data = json_decode(file_get_contents("php://input"), true);

$bookId = $_GET["bookId"];
echo $bookId;
//$product_name = $_GET["product_name"];
//$product_price = $_GET["product_price"];

require_once "../backend/dbconn.php";

$query = "DELETE FROM booking WHERE book_id = ".$bookId;
echo $query;
$result=mysqli_query($conn, $query) or die("Update Query Failed");
if($result)
{
    if (mysqli_affected_rows($conn) > 0) 
    {
        echo json_encode(array("message" => mysqli_affected_rows($conn)." Booking Deleted Successfully", "status" => true));
    } else 
    {
        echo json_encode(array("message" => "Failed Booking Not Deleted ", "status" => false));
    } 
}
else
{
    echo json_encode(array("message" => "Failed Booking Not Deleted ", "status" => false)); 
}
