<?php
// Create connection
$conn = mysqli_connect("db.soic.indiana.edu","i308u16_team05","my+sql=i308u16_team05","i308u16_team05");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$roles = mysqli_real_escape_string($conn, $_POST['roles']);

$sql = "select s.studentID as studentID, c.courseID as courseID, c.title as title, g.Letter_grade as grade
from student as s, grade as g, course as c
where g.courseID = c.courseID
and s.studentID = g.studentID
and s.studentID = '$roles'
group by c.courseID
UNION
select s2.studentID, 'total' as total, sum(c2.credit), avg(g2.gpa)
from student as s2, grade as g2, course as c2
where g2.courseID = c2.courseID
and s2.studentID = g2.studentID
and s2.studentID = '$roles'";

$result = mysqli_query($conn, $sql);
$num_rows = mysqli_num_rows($result);
if ($result->num_rows > 0) {
    echo "<table border = 1><tr><th>student ID</th><th>course ID</th><th>title</th><th>Letter_grade</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["studentID"]."</td><td>".$row["courseID"]."</td><td>".$row["title"]."</td><td>".$row["grade"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
mysqli_close($conn);
?>
