<?php
// Inialize session
session_start();

// Include database connection settings
include('../backend/dbconn.php');

if(isset($_POST['login'])){
	
	/* capture values from HTML form */
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	$sql= "SELECT * FROM user WHERE username= '$username' AND password= '$password'";
	$query = mysqli_query($conn, $sql) or die("Update Query Failed");
	$row = mysqli_num_rows($query);
	if($row == 0){
	 // Jump to indexwrong page
	 echo "<script> alert(' Wrong username or password! ')</script>";
    echo"<script>location.href='login.html'</script>";
	//header('Location: ../login/wrong_login.html'); 
	}
	else{
	 $r = mysqli_fetch_assoc($query);
	 $username= $r['username'];
	//  $user_id= $r['user_id'];
	
			$_SESSION['username'] = $r['username'];
			$_SESSION['user_id'] = $r['user_id'];
            echo "<script> alert(' Success Login')</script>";
            echo"<script>location.href='/HotelApi/client/homepage.php'</script>";
			
        
	
		
	}	
}
mysqli_close($conn);
?>