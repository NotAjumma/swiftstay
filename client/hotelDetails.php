<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page or display an error message
    header("Location: ../login.html");
    exit();
}

$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/index.css" />

    <title>SwiftStay - Details </title>
    <link rel="icon" href="../assets/img/logo.png" type="image/x-icon" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/smoothness/jquery-ui.css" />
  </head>
  <body>
    <div>
      <div class="banner-state">
        <!-- navbar -->
        <nav>
          <div class="navbar">
            <div>SwiftStay</div>
            <div class="right-nav">
                
                
                
                <?php if (!isset($_SESSION['user_id'])){?>
                    <a href="../index.html">
                        <div class="nav-li" href="../login/login.html">Login</div>
                    </a>
                    <a href="./signup.html"> 
                        <div class="nav-li">Register</div>
                    </a>
                <?php }else{ ?>
                <a href="homepage.php">
                    <div class="nav-li" >Home</div>
                </a>
                <a href="view_booking_client.php?userid=<?php echo $user_id ?>">
                    <div class="nav-li" >View Booking</div>
                </a>
                
                <!-- <div class="nav-li" href="">About us</div> -->
                <a href="../backend/logout.php"> 
                    <div class="nav-li" >Logout</div>
                </a>
                <?php } ?>
                
            </div>
          </div>
        </nav>
        <!-- navbar -->

        <!-- banner -->
        <div>
          <div class="search-state">
            <div class="search-container">
              <div class="header-search">Explore Malaysia</div>
              <form action="search.php" method="post">
                <div class="row-search">
                  <input class="location-input" placeholder="Where are you going?" type="text" name="location" />
                  <input id="arrival-date-input" class="date-input" type="text" placeholder="Select arrival date" name="arrival_date" />
                  <input id="departure-date-input" class="date-input" type="text" placeholder="Select departure date" name="departure_date" />
                  <input class="qty-input" type="number" placeholder="2 adults" name="rec_guest_qty" />
                  <input class="submit-btn" type="submit" value="Search" />
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- banner -->
<?php 
$hotelId = $_GET['hotelId'];
$hotelName = $_GET['hotelName'];
$stateId = $_GET['stateId'];
$departure_date = isset($_GET['depart']) && !empty($_GET['depart']) ? $_GET['depart'] : '2024-04-22';
$arrival_date = isset($_GET['arrive']) && !empty($_GET['arrive']) ? $_GET['arrive'] : '2024-04-17';
$rec_guest_qty = isset($_GET['qty']) && !empty($_GET['qty']) ? $_GET['qty'] : '2';


// session_start();

// // Retrieve the value of the 'username' session variable
// $user_id = $_SESSION['user_id'];
// $username = $_SESSION['username'];
// echo $user_id;


$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://apidojo-booking-v1.p.rapidapi.com/properties/v2/get-rooms?hotel_id=".$hotelId."&departure_date=".$departure_date."&arrival_date=".$arrival_date."&rec_guest_qty=".$rec_guest_qty."&rec_room_qty=1&currency_code=MYR&languagecode=en-us&units=imperial",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
        "X-RapidAPI-Host: apidojo-booking-v1.p.rapidapi.com",
		"X-RapidAPI-Key: 2a23a9a05emshe2d83e529456079p1f1076jsn0e6513f027f0"
	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
	$results = json_decode($response,TRUE);
  

    if (!empty($results[0]['rooms'])) {
	  $rooms = $results[0]["rooms"];
	  $prices = $results[0]["block"][0]['product_price_breakdown']['gross_amount_per_night']['value'];
      $price = number_format($prices, 2);

echo '<link rel="stylesheet" href="../css/hotelDetails.css" />';
// echo "<div class='hotel-details-container'>
//     <div class='list-room'>";   
echo "<table style='width: 50%; margin: 0 auto;'><tr>";

// Filter to get bed type
if (!empty($rooms)) {
    $firstRoom = reset($rooms);
    $firstRoomName = key($rooms);

    echo "<td style='width: 30rem; vertical-align: top;'>";
    foreach ($firstRoom as $subArrayName => $subArray) {
        if ($subArrayName === 'photos' && is_array($subArray)) {
            $counter = 0;
            foreach ($subArray as $photo) {
                $urlSquare60 = $photo['url_original'];
                echo "<img class='room-img' src='".$urlSquare60."' />";
                $counter++;
                if ($counter === 4) {
                    break;
                }
            }
        }
    }
    echo "</td>";

    echo "<td style='vertical-align: top;'>";
    foreach ($firstRoom as $subArrayName => $subArray) {
        if ($subArrayName === 'bed_configurations' && is_array($subArray)) {
            $roomName = $subArray[0]['bed_types'][0]['name'];

            if (!empty($prices)) {
                echo "<p>Price: RM ". $price ."</p>";
            }
            if (!empty($roomName)) {
                echo "<p>Room Name: ".$roomName."</p>";
            }
            if (!empty($desc)) {
                echo "<p>Description: ".$desc."</p>";
            }
            if (!empty($service)) {
                echo "<p>Highlight: ".$service."</p>";
            }
            if (!empty($hightlight)) {
                echo "<p>Extra service: ".$hightlight."</p>";
            }
        }
    }
    echo "";
}
$dateBook = date("Y-m-d");
echo "<form method='post'>";
echo "<input type='hidden' value='".$firstRoomName."' name='roomId' />";
echo "<input type='hidden' value='".$hotelName."' name='hotelName' />";
echo "<input type='hidden' value='".$hotelId."' name='hotelId' />";
echo "<input type='hidden' value='".$stateId."' name='stateId' />";
echo "<input type='hidden' value='".$departure_date."' name='departure_date' />";
echo "<input type='hidden' value='".$arrival_date."' name='arrival_date' />";
echo "<input type='hidden' value='".$rec_guest_qty."' name='rec_guest_qty' />";
echo "<input type='hidden' value='".$price."' name='price' />";
echo "<input type='hidden' value='".$user_id."' name='userId' />";
echo "<input type='hidden' value='".$dateBook."' name='dateBook' />";
// echo "<input type='text' value='".$firstRoomName."' name='roomId' />";
echo "<input type='hidden' value='".$roomName."' name='room_name' />";
echo "Enter quantity room: <br>";
echo "<input type='number' name='quantity' required /></td>";
echo "<tr><td><input class='buy-btn' type='submit' name='submit' value='Buy' /></td></tr></tr>";

echo "</form>";
echo "</table>";



// end Filter to get bed type

if (isset($_POST['submit'])) {
    //Specify the URL ($url) where the JSON data to be sent
    $url = "http://localhost/HotelApi/backend/booking_insert_api.php";

    // initiate new cURL resource using curl_init().
    $ch = curl_init($url);

    // Setup request to send json via POST
    $data = array(
        'roomId' => $_POST['roomId'],
        'hotelName' => $_POST['hotelName'],
        'room_name' => $_POST['room_name'],
        'quantity' => $_POST['quantity'],
        'hotelId' => $_POST['hotelId'],
        'stateId' => $_POST['stateId'],
        'roomId' => $_POST['roomId'],
        'departure_date' => $_POST['departure_date'],
        'arrival_date' => $_POST['arrival_date'],
        'price' => $_POST['price'],
        'userId' => $_POST['userId'],
        'dateBook' => $_POST['dateBook'],
        'rec_guest_qty' => $_POST['rec_guest_qty']
    );
    //setup data in PHP array and encode into a JSON string using json_encode()
    $payload = json_encode($data);

    // Attach encoded JSON string to the POST fields
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

    // Set the content type to application/json
    // curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));


    // Return response instead of outputting
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute the POST request
    $result = curl_exec($ch);

    // Close cURL resource
    curl_close($ch);
    // var_dump($result);

    if ($result !== null ) {
    // Successful deletion
    echo "<script>alert('Booking successfully add'); window.location.href = 'view_booking_client.php?userid=" . urlencode($user_id) . "';</script>";
    exit();
} else {
    // Failed deletion
    header("Location: hotelDetails.php"); // Replace "error.php" with the desired URL
    exit();
}
    // echo '<p>Receiving data from product client to product create API: ';
    // var_dump($data);
    // echo '</p>';
    
    // echo '<a href="http://localhost/ict651/lab4a/product_list_client.php">Back</a>';
}


}else {
    echo "No rooms available.";
}

} 





?>
<script>
  

$(document).ready(function() {
    $("#arrival-date-input").datepicker({ dateFormat: "yy-mm-dd" });
    $("#departure-date-input").datepicker({ dateFormat: "yy-mm-dd" });
  });

</script>
</body>
</html>