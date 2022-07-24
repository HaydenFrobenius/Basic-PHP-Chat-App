<?php
include_once 'inc.php';

if(!isset($_SESSION['loggedin'])){
	
	header('location: login.php');
	
}

if(!$_SESSION['loggedin']){
		
	header('location: login.php');
		
}

$GetRooms = mysqli_query($con, "SELECT * FROM rooms ORDER BY visits DESC;");
$NumRooms = mysqli_num_rows($GetRooms);
?>
<center>
<a href='searchrooms.php'><button>Search For a Room</button></a>&nbsp;&nbsp;OR&nbsp;&nbsp;<a href='createroom.php'><button>Create a Room</button></a>

<br><br><br>
<?php
if($NumRooms > 0){
	
	echo "<table border='1'>
		<tr>
		<th>Room Name</th>
		<th>Room Owner</th>
		<th>Visits</th>
		</tr>";
	
	while($row = mysqli_fetch_assoc($GetRooms)){
	
		$roomname = htmlspecialchars($row['name']);
		$roomowner = htmlspecialchars($row['owner']);
		$roomvisits = $row['visits'];
		$roomid = $row['id'];
	
		echo "<tr>";
		echo "<td>$roomname</td>";
		echo "<td>$roomowner</td>";
		echo "<td>$roomvisits</td>";
		echo "<td><a href='joinroom.php?id=$roomid'>JOIN</a></td>";
		echo "</tr>";
	
	}
} else {
	
	echo "No Rooms Currently Exist ): But You Can Create One!!";
	
}
echo "</table>";
?>
</center>
<br><br><br>
<a href='signout.php'><button>SIGN OUT</button></a>