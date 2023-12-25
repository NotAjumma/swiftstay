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
    <title>SwiftStay - View Booking</title>
    <link rel="stylesheet" href="../css/index.css" />
    <link rel="icon" href="../assets/img/logo.png" type="image/x-icon" />


    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
      integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
      crossorigin="anonymous"
    />
    <script
      src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
      integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
      integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
      integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
      crossorigin="anonymous"
    ></script>
  </head>
  <body>
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

        <div>
          <div class="search">
            <div class="search-container">
              <div class="header-view">View Booking</div>
            </div>
          </div>
        </div>
        <!-- navbar -->
      </div>
      <!-- banner -->

    <?php 

    // session_start();
    $user_id = $_GET['userid'];
// echo $user_id;
// var_dump($_SESSION['user_id']);
    $url = "http://localhost/HotelApi/api/view_booking_api.php?userid=" . urlencode($user_id);

    $client = curl_init($url);
    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($client, CURLOPT_COOKIESESSION, true);
    curl_setopt($client, CURLOPT_COOKIEFILE, '');
    $response = curl_exec($client);
    $result = json_decode($response, true);
  //  var_dump($result);
    $bookings = $result;

    // Check if bookings is not null and is an array
    if (!empty($result) && is_array($result) && isset($result['status']) && $result['status'] === false) {
    echo "No booking data available";
} else {
    // Process the booking data and display it in a table
    if (!empty($result) && is_array($result)) {
        ?>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Hotel Name</th>
                    <th scope="col">Date Check in</th>
                    <th scope="col">Date Check out</th>
                    <th scope="col">Total Price</th>
                    <th scope="col">Pax</th>
                    <th scope="col" colspan="2" style="text-align: center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                foreach ($result as $x => $val) {
                    ?>
                    <tr>
                        <th scope="row"><?php echo $x + 1; ?></th>
                        <td><?php echo $result[$x]['hotel_name']; ?></td>
                        <td><?php echo $result[$x]['date_chin']; ?></td>
                        <td><?php echo $result[$x]['date_chout']; ?></td>
                        <td>RM <?php echo $result[$x]['price']; ?></td>
                        <td><?php echo $result[$x]['pax']; ?></td>
                        <td>
                            <a class="a-edit-btn" href="update_booking_client.php?bookId=<?php echo $result[$x]['book_id']; ?>"><div class="edit-btn">Edit</div></a>
                        </td>
                        <td>
                            <a class="a-edit-btn" href="delete_booking_client.php?bookId=<?php echo $result[$x]['book_id']; ?>" onclick="return confirm('Are you sure you want to delete this booking?')">
                              <div class="delete-btn">Delete</div>
                            </a>

                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    <?php
    } else {
        echo "Error retrieving booking data";
    }
}?>

    </div>
  </body>
</html>
