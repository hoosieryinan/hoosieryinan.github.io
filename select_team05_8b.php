<?php
// Create connection
$conn = mysqli_connect("db.soic.indiana.edu","i308u16_team05","my+sql=i308u16_team05","i308u16_team05");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$roles = mysqli_real_escape_string($conn, $_POST['course']);

$sql = "SELECT s.lname as lname, s.fname as fname, s.parent_phone as parent_phone
FROM student AS s, grade AS g, class AS cl
WHERE s.studentID = g.studentID AND
g.classID = cl.classID AND
cl.semesterID not in (3,4)
GROUP BY s.studentID
ORDER BY s.lname ASC";

$result = mysqli_query($conn, $sql);
$num_rows = mysqli_num_rows($result);
if ($result->num_rows > 0) {
    echo "<table border = 1><tr><th>fname</th><th>lname</th><th>parent_phone</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row['fname']."</td><td>".$row['lname']."</td><td>".$row['parent_phone']."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
mysqli_close($conn);
?>