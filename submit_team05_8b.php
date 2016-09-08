<?php
// Create connection
$conn = mysqli_connect("db.soic.indiana.edu","i308u16_team05","my+sql=i308u16_team05","i308u16_team05");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$roles = mysqli_real_escape_string($conn, $_POST['course']);

$sql = "select s.fname as fname, s.lname as lname, c.title as title
from student as s, course as c, canvas as ca
where c.courseID = ca.courseID
and ca.studentID = s.studentID
and c.courseID = '$roles'
order by s.lname, s.fname";

$result = mysqli_query($conn, $sql);
$num_rows = mysqli_num_rows($result);
if ($result->num_rows > 0) {
    echo "<table><tr><th>fname</th><th>lname</th><th>title</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["fname"]."</td><td>".$row["lname"]."</td><td>".$row["title"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
mysqli_close($conn);
?>