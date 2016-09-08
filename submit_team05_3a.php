<?php
// Create connection
$conn = mysqli_connect("db.soic.indiana.edu","i308u16_team05","my+sql=i308u16_team05","i308u16_team05");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$roles = mysqli_real_escape_string($conn, $_POST['course']);

$sql = "SELECT f.facultyID as facultyID, f.lname as lname, f.fname as fname, c.courseID as courseID, c.title as title, COUNT(*) AS times_taught
FROM faculty AS f, course AS c, grade as g
WHERE f.facultyID = g.facultyID AND
c.courseID = g.courseID
GROUP BY c.courseID, f.facultyID
ORDER BY f.facultyID";

$result = mysqli_query($conn, $sql);
$num_rows = mysqli_num_rows($result);
if ($result->num_rows > 0) {
    echo "<table><tr><th>facultyID</th><th>lname</th><th>fname</th><th>courseID</th><th>title</th>
    <th>times_taught</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["facultyID"]."</td><td>".$row["lname"]."</td><td>".$row["fname"]."</td>
        <td>".$row["courseID"]."</td><td>".$row["title"]."</td><td>".$row["times_taught"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
mysqli_close($conn);
?>