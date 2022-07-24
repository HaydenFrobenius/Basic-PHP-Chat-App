<?php

include_once 'inc.php';

if(!isset($_SESSION['loggedin'])){
	
	header('location: login.php');
	
}

if(!$_SESSION['loggedin']){
		
	header('location: login.php');
		
}

if(!isset($_GET['id'])){
	
	header('location: index.php');
	
}

$CurrentRoomID = $_GET['id'];
$InfoForCurrentRoom = mysqli_query($con, "SELECT * FROM rooms WHERE id = $CurrentRoomID;");

while($row = mysqli_fetch_assoc($InfoForCurrentRoom)){
	
	$CRname = $row['name'];
	$CRowner = $row['owner'];
	$CRvisits = $row['visits'];
	
}

mysqli_query($con, "UPDATE rooms SET visits=$CRvisits+1 WHERE id = $CurrentRoomID;");
?>

<center>

<h1>Welcome To <?php echo $CRname; ?>!!</h1>
<br><br><br>
<iframe src='chatrefresh.php?id=<?php echo $CurrentRoomID; ?>' width='40%' height='75%'></iframe>
<br><br><br>
<form method='POST'>
<textarea name='message' placeholder='Your Message Goes Here!'></textarea>
<br><br>
<button type='submit' name='message_submit'>SEND MESSAGE</button>
</form>
<br><br><br>
<a href='index.php'><button>Home</button></a>
</center>

<?php

if(isset($_POST['message_submit'])){
	
	$message = mysqli_real_escape_string($con, $_POST['message']);
	$sender = mysqli_real_escape_string($con, $_SESSION['username']);
	if($message != "" && $message != " "){
		if(!mysqli_query($con, "INSERT INTO roommessages (roomid,sender,message) VALUES($CurrentRoomID, '$sender', '$message');")){
		
			echo mysqli_error($con);
		
		}
	} else {
		
		echo "<script>alert('Didn\'t Your Mother Tell You, If You Don\'t Have Anything To Say, Don\'t Say It??');</script>";
		
	}
	
}

?>