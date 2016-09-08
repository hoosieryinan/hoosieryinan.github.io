<?php
// Create connection
$conn = mysqli_connect("db.soic.indiana.edu","i308u16_team05","my+sql=i308u16_team05","i308u16_team05");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$roles = mysqli_real_escape_string($conn, $_POST['course']);

$sql = "SELECT m.name, m.min_credits, m.min_gpa, d.name as department
FROM major AS m, department AS d, majorDept AS md
WHERE d.deptID = md.deptID
AND m.majorID = md.majorID
GROUP BY m.name
ORDER BY m.name ASC";

$result = mysqli_query($conn, $sql);
$num_rows = mysqli_num_rows($result);
if ($result->num_rows > 0) {
    echo "<table><tr><th>name</th><th>min_credits</th><th>min_gpa</th><th>department</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["name"]."</td><td>".$row["min_credits"]."</td><td>".$row["min_gpa"]."</td>
        <td>".$row["department"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
mysqli_close($conn);
?>