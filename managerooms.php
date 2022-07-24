<?php

include_once 'inc.php';
error_reporting(0)

?>

<?php

if(isset($_POST['remove_submit'])){
	
	$TargetRoomID = $_POST['roomid'];
	
	mysqli_query($con, "DELETE FROM rooms WHERE id = $TargetRoomID;");
	mysqli_query($con, "DELETE FROM roommessages WHERE roomid = $TargetRoomID");
	
	header("location: managerooms.php");
	
}

?>

<?php

if(!isset($_SESSION['loggedin'])){
	
	header('location: login.php');
	
}

if(!$_SESSION['loggedin']){
		
	header('location: login.php');
		
}

?>

<center>

<h1>Manage Your Rooms</h1>
<p>This is where you, <?php echo "<b>".$_SESSION['username']."</b>"; ?>, can manage your rooms!</p>
<br><br><br>
<?php
$CurrentUser = $_SESSION['username'];
$GetRooms = mysqli_query($con, "SELECT * FROM rooms WHERE owner = '$CurrentUser';");

if(mysqli_num_rows($GetRooms)){
	echo "<table border='1'>
	<tr>
	<th>Room Name</th>
	<th>Visits</th>
	</tr>";
	while($row = mysqli_fetch_assoc($GetRooms)){
	
		$roomname = htmlspecialchars($row['name']);
		$roomowner = htmlspecialchars($row['owner']);
		$roomvisits = $row['visits'];
		$roomid = $row['id'];
	
		echo "<tr>";
		echo "<td>&nbsp;&nbsp;&nbsp;$roomname</td>";
		echo "<td>&nbsp;&nbsp;&nbsp;$roomvisits</td>";
		echo "<td><form method='POST'><br><button type='submit' name='remove_submit'>REMOVE</button><input type='hidden' name='roomid' value='$roomid'></form></td>";
		echo "<td><form method='POST' action='editroom.php'><br><button type='submit' name='edit_link'>EDIT</button><input type='hidden' name='roomid' value='$roomid'><input type='hidden' name='roomname' value='$roomname'></form></td>";
		echo "</tr>";
	
	}
	echo "</table>";
	
} else {
	
	echo "You currently have no rooms ): But you can create one <a href='createroom.php'>here</a>!!";
	
}
               
?>

</center>