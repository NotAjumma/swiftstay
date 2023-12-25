<?php 
session_start();

// Retrieve the value of the 'username' session variable
$user_id = $_SESSION['user_id'];
// $user_id = $_GET['user_id'];
// $username = $_SESSION['username'];
// echo $user_id;
// echo $username;
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SwiftStay </title>
    <link rel="icon" href="../assets/img/logo.png" type="image/x-icon" />
    <link rel="stylesheet" href="../css/signup.css" />

    <link
      rel="stylesheet"
      href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
      integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
    />

    <link rel="stylesheet" href="../css/index.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Karla:wght@300;400;500;600;700&family=Roboto:wght@300;400;500;700;900&display=swap"
      rel="stylesheet"
    />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/smoothness/jquery-ui.css" />
  </head>
  <body >
    <div>
     <div class="banner-view">
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
          <div class="search">
            <div class="search-container">
              <div class="header-view">Update Booking</div>
              
            </div>
          </div>
        </div>
      </div>
      <!-- banner -->
<?php 
if (isset($_GET['bookId'])) {
    $bookId = $_GET['bookId'];
    $url = "http://localhost/HotelApi/api/booking_api.php?bookId=" . $bookId;
    $client = curl_init($url);
    //curl_setopt($client, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($client);

    $result = json_decode($response, true);
    // var_dump($result);
    // var_dump($response);
    $booking = $result;
    $book_id = $booking['book_id'];
    $hotel_name = $booking['hotel_name'];
    $date_chin = $booking['date_chin'];
    $date_chout = $booking['date_chout'];
    $price = $booking['price'];
    $pax = $booking['pax'];
    $room_name = $booking['room_name'];
    $qty = $booking['quantity'];
    // echo "ID : " . $result['id']; // Use 'product_id' instead of 'id'
    // //echo "<br>Product Name : " . $result[0]->product_name;
    // echo "<br>Product Name : " . $result['product_name'];
    // echo "<br>Price : " . $result['product_price'];

?>
<div class="container1">
      <div class="content">
        <form  method="POST">
          <div class="user-details">
            <div class="input-box">
              <span class="details">Hotel</span>
              <input type="text" name="hotel_name" value="<?php echo $hotel_name ?>"  readonly/>
              <input type="hidden" name="book_id" value="<?php echo $book_id ?>" />
            </div>

            <div class="input-box">
              <span class="details">Date Check in</span>
              <input type="date" name="date_chin" value="<?php echo $date_chin ?>" />
            </div>

            <div class="input-box">
              <span class="details">Date Check out</span>
              <input type="date" name="date_chout" value="<?php echo $date_chout ?>" />
            </div>

            <div class="input-box">
              <span class="details">Room Name</span>
              <input type="text" name="price" value="<?php echo $room_name ?>" readonly />
            </div>

            <div class="input-box">
              <span class="details">Room Quantity</span>
              <input type="text" name="price" value="<?php echo $qty ?>" readonly />
            </div>

            <div class="input-box">
              <span class="details">Price in Rm</span>
              <input type="text" name="price" value="<?php echo $price ?>" readonly />
            </div>

            <div class="input-box">
              <span class="details">Pax (adults)</span>
              <input type="text" name="pax" value="<?php echo $pax ?>" readonly />
            </div>
            <!-- <a href="map_view.php?hotel_name=<?php echo  $hotel_name ?>"><div class="map-btn">Check on Map</div></a> -->
          </div>
          <div class="button">
            <input type="submit" name="submit" value="Update" />
          </div>
        </form>
      </div>
    </div>
    </div>
    <?php
    if (isset($_POST['submit'])) {
        $url = "http://localhost/HotelApi/api/update_booking_api.php";

        // Create a new cURL resource
        $ch = curl_init($url);

        // Setup request to send json via POST
        $data = array(
            'book_id' => $_POST['book_id'],
            'date_chin' => $_POST['date_chin'],
            'date_chout' => $_POST['date_chout']
        );
        $payload = json_encode($data);

        // Attach encoded JSON string to the POST fields
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

        // Set the content type to application/json
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        // Return response instead of outputting
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Execute the POST request
        $result = curl_exec($ch);

        // Close cURL resource
        curl_close($ch);
        // echo '<p>Receiving data from Booking client to Booking create API: ';
        // var_dump($result);
        // echo '</p>';
        // echo '<a href="http://localhost/ict651/lab4a/product_list_client.php">Back</a>';
        if ($result !== null ) {
            echo "<script>alert('Booking updated successfully'); window.location.href = 'view_booking_client.php?userid=" . urlencode($user_id) . "';</script>";
            exit();
        } else {
            header("Location: error.php"); // Replace "error.php" with the desired URL
            exit();
        }
    }
} else {
    echo 'invalid request';
}
?>
    </body>
    </html>