<?php 
	include('../backend/dbconn.php');
$i=0;

foreach ( $_POST as $sForm => $value )
{
	$postedValue = htmlspecialchars( stripslashes( $value ), ENT_QUOTES ) ;
    $valuearr[$i] = $postedValue; 
$i++;
}

echo $valuearr[0].'<br>'.'<br>'.$valuearr[1].'<br>'.$valuearr[2].'<br>'.$valuearr[3].'<br>';

	$sql0 = "SELECT username FROM user WHERE username = '$valuearr[0]'";
	$query0 = mysqli_query($conn, $sql0) or die ("Error: " . mysqli_error($conn));
	$row0 = mysqli_num_rows($query0);
	
	
	if($row0 != 0){
		echo "<script> alert('Record is existed ')</script>";
    echo"<script>location.href=' ../signup/signup.html'</script>";
	//header('Location: ../signup/signup_record.html');
	//echo "<b>Record is existed</b>";
	}
	else{
	/* execute SQL INSERT command */
	$sql2 = "INSERT INTO user (username,full_name,email,password,address)
	VALUES ('$valuearr[0]', '$valuearr[1]', '$valuearr[2]', '$valuearr[3]', '$valuearr[4]')";
		mysqli_query($conn, $sql2) or die ("Error: " . mysqli_error($conn));
	/* rediredt to respective page */
	echo "<script> alert('Successfully ')</script>";
    echo"<script>location.href=' ../'</script>";
	//header('Location: ../login/login.html');
	//echo "Data has been saved";
	}

	/* close db connnection */
	mysqli_close($conn);
	?>