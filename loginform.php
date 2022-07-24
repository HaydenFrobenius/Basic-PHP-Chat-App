<?php
include_once 'inc.php';
?>
<center>
<form method='POST'>
USERNAME:&nbsp;&nbsp;&nbsp;<input type='text' maxlength='50' name='username'>
<br><br>
PASSWORD:&nbsp;&nbsp;&nbsp;<input type='password' maxlength='50' name='password'>
<br><br>
<button type='submit' name='login_submit'>LOGIN</button>
</form>
<br><br>
<a href='signup.php'>Don't Have An Account? Create One!</a>
<br><br><br>
<a href='index.php'><button>Home</button></a>
</center>

<?php

if(isset($_POST['login_submit'])){
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	$GetUsers = mysqli_query($con, "SELECT * FROM users WHERE username = '$username';");
	
	$isright = false;
			while($row = mysqli_fetch_assoc($GetUsers)){
				
				if($username == $row['username'] && password_verify($password, $row['password'])){
					
					$_SESSION['loggedin'] = true;
					$_SESSION['username'] = $username;
					$_SESSION['email'] = $row['email'];
					$_SESSION['id'] = $row['id'];
	
					header('location: index.php');
					
				} else {
					
					$isright = false;
					
				}
				
			}
			if($isright === false){
				echo '<script>alert("Incorrect Username or Password");</script>';
			}
}
?>