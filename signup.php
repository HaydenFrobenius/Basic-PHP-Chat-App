<?php
include_once 'inc.php';
?>
<?php
if(isset($_POST['signup_submit'])){
	
	$username = mysqli_real_escape_string($con, $_POST['username']);
	$email = mysqli_real_escape_string($con, $_POST['email']);
	$password = $_POST['password'];
	$retyped_password = $_POST['retyped_password'];
	
	$usernameok = true;
	
	$CheckUsername = mysqli_query($con, "SELECT * FROM users;");
	
	$hashed_password = password_hash($password, PASSWORD_DEFAULT);
	
	if($password == $retyped_password){
		
		while($row = mysqli_fetch_assoc($CheckUsername)){
			if($username == $row['username']){
				
				$usernameok = false;
				
			}
		}
		
		if($usernameok){
		
			if(!mysqli_query($con, "INSERT INTO users (username,password,email) VALUES('$username', '$hashed_password', '$email');")){
			
				echo mysqli_error($con);
			
			} else {
			
				$_SESSION['loggedin'] = true;
				$_SESSION['username'] = $username;
				$_SESSION['email'] = $email;
				
				ob_start();
                header('Location: index.php');
                ob_end_flush();
			
			}
		} else if(!$usernameok){
			
			echo "<script>alert('Username Taken');</script>";
			
		}
		
	} else {
		
		echo "<script>alert('Passwords Don\'t Match');</script>";
		
	}
	
}

?>
<html>
    <body>
<center>
<h1>Sign Up For a New Account!</h1>
<br><br><br>
<form method='POST'>
CREATE USERNAME:&nbsp;&nbsp;&nbsp;<input type='text' name='username' maxlength='25'>
<br><br>
EMAIL:&nbsp;&nbsp;&nbsp;<input type='text' name='email'>
<br><br>
CREATE PASSWORD:&nbsp;&nbsp;&nbsp;<input type='password' name='password' maxlength='25'>
<br><br>
RETYPE PASSWORD:&nbsp;&nbsp;&nbsp;<input type='password' name='retyped_password' maxlength='25'>
<br><br><br>
<button  type='submit' name='signup_submit'>SIGNUP</button>
</form>
<br><br>
<a href='login.php'>Already Have An Account? Login Here!</a>
<br><br><br>
<a href='index.php'><button>Home</button></a>
</center>
</body>
</html>