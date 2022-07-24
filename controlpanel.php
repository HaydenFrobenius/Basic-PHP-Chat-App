<?php

if(isset($_POST['save_submit'])){
	
	$newuser = mysqli_real_escape_string($con, $_POST['newuser']);
	$newemail = mysqli_real_escape_string($con, $_POST['newemail']);
	$CurrentUserID = $_SESSION['id'];
	
	mysqli_query($con, "UPDATE users SET username = '$newuser' WHERE id = $CurrentUserID;");
	mysqli_query($con, "UPDATE users SET email = '$newemail' WHERE id = $CurrentUserID;");
	
	$_SESSION['username'] = $newuser;
	$_SESSION['email'] = $newemail;
	
	header('location: controlpanel.php');
	
}

include 'inc.php';

if(!isset($_SESSION['loggedin'])){
	
	header('location: login.php');
	
}

if(!$_SESSION['loggedin']){
		
	header('location: login.php');
		
}

?>
<center>

<h1>Control Panel</h1>
<p>This is where you, <?php echo '<b>'.$_SESSION['username'].'</b>'; ?>, can edit your account details.
<br><br><br>
<form method='POST'>
YOUR USERNAME:&nbsp;&nbsp;&nbsp;<input type='text' name='newuser' value='<?php echo $_SESSION['username']; ?>'>
<br><br>
YOUR EMAIL:&nbsp;&nbsp;&nbsp;<input type='text' name='newemail' value='<?php echo $_SESSION['email']; ?>'>
<br><br><br>
<button type='submit' name='save_submit'>Save Changes</button>
</form>
<br><br><br>
<a href='changepassword.php'><button>Change Your Password</button></a>&nbsp;&nbsp;&nbsp;<a href='managerooms.php'><button>Manage Your Rooms</button></a>
<br><br><br>
<a href='index.php'><button>Home</button></a>
</center>