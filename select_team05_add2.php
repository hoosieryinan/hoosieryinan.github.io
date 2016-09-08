<?php
// Create connection
$conn = mysqli_connect("db.soic.indiana.edu","i308u16_team05","my+sql=i308u16_team05","i308u16_team05");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$roles = mysqli_real_escape_string($conn, $_POST['course']);

$sql = "SELECT CONCAT(a.fname, ' ', a.lname) AS full_name, asp.specialization
FROM advisor AS a, advisorSpec AS asp
WHERE a.advisorID = asp.advisorID AND
asp.specialization in ('Mathematics', 'Robotics')";

$result = mysqli_query($conn, $sql);
$num_rows = mysqli_num_rows($result);
if ($result->num_rows > 0) {
    echo "<table border = 1><tr><th>full_name</th><th>specialization</th>
    </tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["full_name"]."</td><td>".$row["specialization"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
mysqli_close($conn);
?>