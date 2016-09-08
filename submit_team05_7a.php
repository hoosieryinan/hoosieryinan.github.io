<?php
// Create connection
$conn = mysqli_connect("db.soic.indiana.edu","i308u16_team05","my+sql=i308u16_team05","i308u16_team05");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$roles = mysqli_real_escape_string($conn, $_POST['course']);

$sql = "SELECT concat(s.lname,', ', s.fname) as fullname, m.name
FROM student AS s, studentMajor AS sm, major AS m, advise AS adve, advisor AS advr
WHERE s.studentID = sm.studentID
AND sm.majorID = m.majorID
AND adve.advisorID = advr.advisorID
AND adve.studentID = s.studentID
AND advr.fname = 'Jonathan'
AND advr.lname = 'Lynwood'
GROUP BY s.lname
ORDER BY s.lname ASC";

$result = mysqli_query($conn, $sql);
$num_rows = mysqli_num_rows($result);
if ($result->num_rows > 0) {
    echo "<table><tr><th>fullname</th><th>name</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["fullname"]."</td><td>".$row["name"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
mysqli_close($conn);
?>