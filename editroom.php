<?php
include_once 'inc.php';

if(!isset($_SESSION['loggedin'])){
	
	header('location: login.php');
	
}

if(!$_SESSION['loggedin']){
		
	header('location: login.php');
		
}
$CurrentRoomID = $_POST['roomid'];
$CurrentRoomName = $_POST['roomname'];
?>

<center>
<h1>Currently Editing <?php echo $_POST['roomname']; ?>.</h1>
<br><br><br>
<form method='POST'>
CHANGE NAME:&nbsp;&nbsp;&nbsp;<input type='text' name='change_name'>
<br><br><br>
<button type='submit' name='submit_edit'>SAVE CHANGES</button>
<input type='hidden' name='roomid' value='<?php echo $CurrentRoomID; ?>'>
<input type='hidden' name='roomname' value='<?php echo $CurrentRoomName; ?>'>
</form>
</center>

<?php

if(isset($_POST['submit_edit'])){
	$CurrentRoomID = $_POST['roomid'];
	$new_name = mysqli_real_escape_string($con, $_POST['change_name']);
	echo $_POST['change_name'];
	
	mysqli_query($con, "UPDATE rooms SET name = '$new_name' WHERE id = $CurrentRoomID;");
	
	header("location: managerooms.php");
	
}

?>