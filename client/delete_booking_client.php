<?php
session_start();
$user_id = $_SESSION['user_id'];
include_once '../backend/dbconn.php';
$bookId = $_GET['bookId'];
$sql = "SELECT * FROM booking WHERE book_id = $bookId";
$result = mysqli_query($conn, $sql);
$book = mysqli_fetch_assoc($result);
if (!$book) {
    header('Location: view_booking_client.php');
}
if (isset($_GET['bookId'])) {
    // Delete query
    $url = "http://localhost/HotelApi/api/delete_booking_api.php?bookId=" . urlencode($bookId);
    $client = curl_init($url);
    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($client, CURLOPT_COOKIESESSION, true);
    curl_setopt($client, CURLOPT_COOKIEFILE, '');
    $response = curl_exec($client);
    $result = json_decode($response, true);
    // var_dump($response);
    var_dump($result);

    if ($result == null ) {
    // Successful deletion
    echo "<script>alert('Booking deleted successfully'); window.location.href = 'view_booking_client.php?userid=" . urlencode($user_id) . "';</script>";
    exit();
} else {
    // Failed deletion
    header("Location: error.php"); // Replace "error.php" with the desired URL
    exit();
}

}
?>