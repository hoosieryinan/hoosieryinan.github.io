
<?php
$servername = "db.soic.indiana.edu";
$username = "i308u16_team05";
$password = "my+sql=i308u16_team05";
$dbname = "i308u16_team05";

$conn=mysqli_connect("db.soic.indiana.edu", 
"i308u16_team05","my+sql=i308u16_team05","i308u16_team05");
//check connection
if(!$conn){
	die("connection failed:" . mysqli_connect_error());
}

$sql = "SELECT artist_id, first_name, last_name, dob,gender FROM artist ORDER BY artist_id DESC";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "<table style='width:50%' border='1'>
	<tr>
	<th>Artist ID</th>
	<th>Fname</th>
	<th>Lname</th>
	<th>Birth</th>
	<th>Gender</th>
	</tr>";
 // output data of each row   
 	while($row = $result->fetch_assoc()) {
		 echo
	"<tr>
	<td>".$row["artist_id"]."</td>
	<td>".$row["first_name"]."</td>
	<td>".$row["last_name"]."</td>
	<td>".$row["dob"]."</td>
	<td>".$row["gender"]."</td>
	</tr>";
	 }

    echo "</table>";
	
}else{
	echo "Oops...";
}
mysqli_close($conn);
?>



