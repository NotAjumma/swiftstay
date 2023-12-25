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

    <title>SwiftStay - State </title>
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
              <form action="client/search.php" method="post">
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

if (isset($_GET['state'])){
$state = $_GET['state'];
$stateId = 0;
  if ($state === "johor") {
    $stateId = -2405456;
  } else if ($state === "kuala lumpur") {
    $stateId = -2403010;
  } else if ($state === "penang") {
    $stateId = -2403092;
  } else if ($state === "melaka") {
    $stateId = -2403412;
  } else if ($state === "perak") {
    $stateId = -2403538;
  }
}


// }else {
// 	$response['code'] = 400;
// 	$response['description'] = 'Invalid request';
// }
// echo $state;

$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://apidojo-booking-v1.p.rapidapi.com/properties/list?offset=0&arrival_date=2024-05-17&departure_date=2024-05-22&guest_qty=1&dest_ids=".$stateId."&room_qty=1&search_type=city&children_qty=2&children_age=5%2C7&search_id=none&price_filter_currencycode=USD&order_by=popularity&languagecode=en-us&travel_purpose=leisure",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"X-RapidAPI-Host: apidojo-booking-v1.p.rapidapi.com",
		"X-RapidAPI-Key: a69ebabdaamsh220fb1e09fcbf67p10dca3jsn9a8942ef4144"
	],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
	$results = json_decode($response,TRUE);
  
echo '<link rel="stylesheet" href="../css/state.css" />';
echo '<div class="hotel-body">';

      echo '<div class="hotel-list">';
	// print_r($result ) ;
	foreach ($results["result"] as $hotel) {
		// echo "<br>Hotel Id: " . $hotel['hotel_id'];
		// echo "<br>Hotel Name: " . $hotel['hotel_name'];
		// echo "<br>Room Price: " . $hotel['min_total_price'];
		// echo "<br><img src='{$hotel['main_photo_url']}' />";
      $hotelId = $hotel['hotel_id'];
      $hotelName = $hotel['hotel_name'];
      $roomPrice = $hotel['min_total_price'];
      $mainPhotoUrl = $hotel['main_photo_url'];
      $address = $hotel['address'];
      $district = $hotel['district'];
      $review_score = $hotel['review_score'];
      $distance_to_cc = $hotel['distance_to_cc'];
      $review_score_word = $hotel['review_score_word'];
      
          
      echo '<div onclick="hotelDetails('.$stateId.','.$hotelId.',\''.$hotelName.'\')" class="hotel-container">';

      echo '<div class="img-hotel">';
      echo '<img src="' . $mainPhotoUrl . '">';
      echo '</div>';
      echo '<div class="middle-info">';
      // Display the hotel name if not empty
        if (!empty($hotelName)) {
            echo '<div class="hotel-name">' . $hotelName . '</div>';
        }
        
        // Display the address if not empty
        if (!empty($address)) {
            echo '<div class="hotel-address">' . $address . '</div>';
        }
        
        // Display the district if not empty
        if (!empty($district)) {
            echo '<div class="hotel-district">' . $district . '</div>';
        }
        
        // Display the distance if not empty
        if (!empty($distance_to_cc)) {
            echo '<div class="hotel-distance">' . $distance_to_cc . ' km from center</div>';
        }
        
        echo '</div>'; // Closing div for middle-info
        
        echo '<div class="right-info">';
        
        // Display the review score word if not empty
        if (!empty($review_score_word)) {
            echo '<div class="review-word">' . $review_score_word . '</div>';
        }
      if (!empty($review_score)) {
            echo '<div class="review-score">' . $review_score . '</div>';
        }
      echo '</div>';
      echo '</div>';
     

      
	}
   echo '</div>';
      echo '</div>';
} ?>

<script>
 function hotelDetails(stateId, hotelId, hotelName) {
    console.log(hotelId);
    
    // Redirect the user to another page
    window.location.href = 'hotelDetails.php?stateId=' + encodeURIComponent(stateId) + '&hotelId=' 
	+encodeURIComponent(hotelId)+ '&hotelName=' 
	+encodeURIComponent(hotelName);
}

$(document).ready(function() {
    $("#arrival-date-input").datepicker({ dateFormat: "yy-mm-dd" });
    $("#departure-date-input").datepicker({ dateFormat: "yy-mm-dd" });
  });

</script>
</body>
</html>