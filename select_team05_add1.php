<?php
// Create connection
$conn = mysqli_connect("db.soic.indiana.edu","i308u16_team05","my+sql=i308u16_team05","i308u16_team05");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$roles = mysqli_real_escape_string($conn, $_POST['course']);


$sql = "SELECT CONCAT(f.fname, ' ', f.lname) AS full_name, rf.roomID as roomID, rf.feature as feature, b.building_name as building_name
FROM faculty AS f, roomFeature AS rf, building AS b, grade AS g, roomInBuilding AS rb
WHERE f.facultyID = g.facultyID AND
rf.roomID = g.roomID AND g.roomID = rb.roomID AND
b.buildingID = rb.buildingID AND
rf.feature = '$roles'";

$result = mysqli_query($conn, $sql);
$num_rows = mysqli_num_rows($result);
if ($result->num_rows > 0) {
    echo "<table border = 1><tr><th>full_name</th><th>roomID</th><th>feature</th><th>building_name</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["full_name"]."</td><td>".$row["roomID"]."</td><td>".$row["feature"]."</td>
        <td>".$row["building_name"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
mysqli_close($conn);
?>