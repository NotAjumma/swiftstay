<?php
header("Content-Type:application/json");
header("Access-Control-Allow-Origin: *");

require_once "../backend/dbconn.php";

if (isset($_GET['bookId']) && $_GET['bookId'] != '') {
    $book_id = $_GET['bookId'];

    $query = "SELECT b.*, bd.room_id, bd.room_name, bd.quantity 
              FROM booking AS b
              INNER JOIN booking_detail AS bd ON b.book_id = bd.book_id
              WHERE b.book_id = " . $book_id;

    $result = mysqli_query($conn, $query) or die("Select Query Failed.");

    $count = mysqli_num_rows($result);
    if ($count) {
        while ($row = mysqli_fetch_assoc($result)) {
            $response['book_id'] = $row['book_id'];
            $response['user_id'] = $row['user_id'];
            $response['state_id'] = $row['state_id'];
            $response['hotel_name'] = $row['hotel_name'];
            $response['state_id'] = $row['state_id'];
            $response['date_chin'] = $row['date_chin'];
            $response['date_chout'] = $row['date_chout'];
            $response['room_id'] = $row['room_id'];
            $response['room_name'] = $row['room_name'];
            $response['price'] = $row['price'];
            $response['pax'] = $row['pax'];
            $response['quantity'] = $row['quantity'];
            $response['code'] = 200;
        }
    } else {
        $response['code'] = 404;
        $response['message'] = "Booking not found.";
    }
} else {
    $response['code'] = 400;
    $response['message'] = "Invalid request.";
}

$json_response = json_encode($response);
echo $json_response;


