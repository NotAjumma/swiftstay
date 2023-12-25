<?php

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

$data = json_decode(file_get_contents("php://input"), true);
echo '<p>Receiving data from product client to product create API: ';
var_dump($data);
echo '</p>';
var_dump($_POST);

if (isset($data)) {
   $roomId = $data["roomId"];
   $room_name = $data["room_name"];
   $quantity = $data["quantity"];
   $hotel_name = $data["hotelName"];
   $hotelId = $data["hotelId"];
   $stateId = $data["stateId"];
   $departure_date = $data["departure_date"];
   $arrival_date = $data["arrival_date"];
   $price = $data["price"];
   $userId = $data["userId"];
   $dateBook = $data["dateBook"];
   $rec_guest_qty = $data["rec_guest_qty"];

    require_once "dbconn.php";

  $query = "INSERT INTO booking (user_id, date_chin, date_chout, date_book, price, pax, hotel_name, state_id) 
            VALUES ('".$userId."', '".$arrival_date."', '".$departure_date."', '".$dateBook."', 
            '".$price."', '".$rec_guest_qty."', '".$hotel_name."', '".$stateId."')";

$result = mysqli_query($conn, $query) or die("Update Query Failed");
$book_id = mysqli_insert_id($conn);

$query2 = "INSERT INTO booking_detail (book_id, room_id, room_name, quantity) 
            VALUES ('".$book_id."', '".$roomId."', '".$room_name."', '".$quantity."')";

$result2 = mysqli_query($conn, $query2) or die("Update Query Failed 2");

    if ($result)
    {
        if (mysqli_affected_rows($conn) > 0) 
        {
            http_response_code(200);
            echo json_encode(array("message" => mysqli_affected_rows($conn)." Booking Successfully", "status" => true));
        } else 
        {
            http_response_code(400);
            echo json_encode(array("message" => "Booking Failed ", "status" => false));
        } 
    } else {
        echo "bad return";
    }
}
