<?php
include_once 'inc.php';

if(!isset($_SESSION['loggedin'])){
	
	header('location: login.php');
	
}

if(!$_SESSION['loggedin']){
		
	header('location: login.php');
		
}

?>
<center>

<h1>Change Your Password</h1>
<br><br><br>
<form method='POST'>

NEW PASSWORD:&nbsp;&nbsp;&nbsp;<input type='password' name='new_password'>
<br><br>
<button type='submit' name='submit_password'>SAVE CHANGES</button>

</form>

</center>

<?php
if(isset($_POST['submit_password'])){
	
	$newpassword = $_POST['new_password'];
	$password_hash = password_hash($newpassword, PASSWORD_DEFAULT);
	
	$CurrentUserID = $_SESSION['id'];
	
	mysqli_query($con, "UPDATE users SET `password` = '$password_hash' WHERE id = $CurrentUserID;");
	header('location: controlpanel.php');
	
}

?>