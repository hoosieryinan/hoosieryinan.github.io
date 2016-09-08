<?php
$con=mysqli_connect("db.soic.indiana.edu", 
"i308u16_team05","my+sql=i308u16_team05","i308u16_team05");
//check connection
if(mysqli_connect_errno())
{
	echo "Failed to connect to MySQL:". mysqli_connect_error();
}

//escape variables for security sql injection
$sanfname = mysqli_real_escape_string($con,$_POST['firstname']);
$sanlname = mysqli_real_escape_string($con,$_POST['lastname']);
$sandob = mysqli_real_escape_string($con,$_POST['dob']);
$sangender = mysqli_real_escape_string($con,$_POST['gender']);
//Insert query insert form data into the artist table
$sql="INSERT INTO artist (first_name,last_name,dob,gender)
VALUES ('$sanfname','$sanlname','$sandob','$sangender')";
//check for error
if (!mysqli_query($con,$sql))
{
	die('Error:'.mysqli_error());
}
echo "I record added";
mysqli_close($con);
?>
