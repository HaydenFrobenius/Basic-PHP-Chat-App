<?php

include_once 'inc.php';

if(isset($_POST['roomsubmit'])){
	
	$roomname = mysqli_real_escape_string($con, $_POST['roomname']);
	$roomowner = mysqli_real_escape_string($con, $_SESSION['username']);
	
	mysqli_query($con, "INSERT INTO rooms (name,owner,visits) VALUES('$roomname', '$roomowner', 0);");
	
	$GetRoomID = mysqli_query($con, "SELECT id FROM rooms WHERE name = '$roomname' AND owner = '$roomowner';");
	
	while($row = mysqli_fetch_assoc($GetRoomID)){
		
		$CurrentRoomID = $row['id'];
		
	}
	
	header("location: joinroom.php?id=$CurrentRoomID");
	
}

if(!isset($_SESSION['loggedin'])){
	
	header('location: login.php');
	
}

if(!$_SESSION['loggedin']){
		
	header('location: login.php');
		
}

?>

<center>

<h1>Create a Room!</h1>
<br><br><br>
<form method='POST'>
CREATE ROOM NAME:&nbsp;&nbsp;&nbsp;<input type='text' name='roomname' maxlength='50'>
<br><br><br>
<button type='submit' name='roomsubmit'>CREATE</button>
</form>
<br><br><br><a href='index.php'><button>Home</button></a>

</center>