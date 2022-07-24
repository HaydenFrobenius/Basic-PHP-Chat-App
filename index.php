<?php include_once 'inc.php'; ?>

<html>
<head>
</head>
<body>

<center>

<h1>Welcome to ChatApp!</h1>
<p>

<?php

if(isset($_SESSION['loggedin'])){
	
	if($_SESSION['loggedin']){
		
		$username = $_SESSION['username'];
		
		echo "Hello, $username! Join a Room!";
		
	}
	
} else {
	
	echo "Login or Create An Account";
	
}

?>

</p>

<br><br>
<?php 

if(isset($_SESSION['loggedin'])){
	
	if($_SESSION['loggedin']){
		
		include_once 'rooms.php';
		echo "&nbsp;&nbsp;<a href='controlpanel.php'><button>CONTROL PANEL</button></a>";
		
	}
	
} else {
	
	include_once 'loginform.php';
	
}

?>

</center>

</body>
</html>