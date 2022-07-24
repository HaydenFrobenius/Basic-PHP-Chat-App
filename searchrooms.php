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

<h1>Search For a Room!</h1>
<br><br><br>
<form method='GET'>
<input type='text' name='search_bar' placeholder='Search Here!'>&nbsp;&nbsp;<button type='submit' name='search_submit'>SEARCH</button>
</form>
<br><br><br>
<?php

if(isset($_GET['search_submit'])){
	$SearchQuery = $_GET['search_bar'];
	$Search = mysqli_query($con, "SELECT * FROM rooms WHERE name LIKE '%$SearchQuery%' ORDER BY visits DESC;");
	$srn = mysqli_num_rows($Search);
	
	if($srn > 0){
		echo "<table border='1'>
		<tr>
		<th>Name</th>
		<th>Owner</th>
		<th>Visits</th>
		</tr>";
		while($row = mysqli_fetch_assoc($Search)){
			
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
		
		echo "</table>";
		
	} else {
		
		echo "Sorry, no results ): But you can always create your own room <a href='createroom.php'>here</a>!!";
		
	}
	
}

?>
</center>