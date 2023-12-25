<?php 
session_start();

// Retrieve the value of the 'username' session variable
$user_id = $_SESSION['user_id'];
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
    <link rel="icon" href="assets/img/logo.png" type="image/x-icon" />


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
  <body>
    <div>
      <div class="banner">
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

      <!-- Hot location by state -->
      <div class="hot-location">
        <div class="header-hot">Explore Hot Location in Malaysia</div>
        <div class="state-list">
          <div onclick="redirectToState('kuala lumpur')" class="state-container">
            <div class="bg-state bg-img-kl">
              <div class="state-name">Kuala Lumpur</div>
            </div>
          </div>
          <div onclick="redirectToState('johor')" class="state-container">
            <div class="bg-state bg-img-kk">
              <div class="state-name">Johor</div>
            </div>
          </div>
          <div onclick="redirectToState('melaka')" class="state-container">
            <div class="bg-state bg-img-melaka">
              <div class="state-name">Malacca</div>
            </div>
          </div>
          <div onclick="redirectToState('perak')" class="state-container">
            <div class="bg-state bg-img-penang">
              <div class="state-name">Perak</div>
            </div>
          </div>
          <div onclick="redirectToState('penang')" class="state-container">
            <div class="bg-state bg-img-jb">
              <div class="state-name">Penang</div>
            </div>
          </div>
        </div>
      </div>
      <!-- End Hot location by state -->
    </div>
  </body>
  <script>
 function redirectToState(state) {
  
  window.location.href = 'state.php?state=' + encodeURIComponent(state);
}

 $(document).ready(function() {
    $("#arrival-date-input").datepicker({ dateFormat: "yy-mm-dd" });
    $("#departure-date-input").datepicker({ dateFormat: "yy-mm-dd" });
  });
</script>
</html>
