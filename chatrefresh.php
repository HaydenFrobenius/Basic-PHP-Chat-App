<?php include_once 'inc.php'; ?>

<html>

<head>
<meta http-equiv='refresh' content='3'></meta>
</head>

<body>

<?php

$CurrentRoomID = $_GET['id'];

$GetRoomMessages = mysqli_query($con, "SELECT * FROM roommessages WHERE roomid = $CurrentRoomID;");

while($row = mysqli_fetch_assoc($GetRoomMessages)){
	
	$roomid = $row['roomid'];
	$sender = htmlspecialchars($row['sender']);
	$timestamp = $row['timestamp'];
	$message = htmlspecialchars($row['message']);
	
	echo "<small>$timestamp</small>";
	echo "<p><b><i>$sender</i></b>:&nbsp;&nbsp;&nbsp;$message</p><br><br>";
	
}

?>

<script>
var cookiesplit = document.cookie.split(";");

for(i=0;i<cookiesplit.length;i++){
	
	if(cookiesplit[i].split("=")[0] == "scroll"){
		window.scrollTo(window.scrollX, cookiesplit[i].split("=")[1]);
	}
	
}
document.cookie="scroll="+window.scrollY+";";
</script>
</body>

</html>