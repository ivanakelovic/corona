<?php
$connect=mysqli_connect("localhost", "root","","corona");
if($connect->connect_error)
{
    die("Error:".$connect->connect_error);
}
$sql="DELETE  FROM patients WHERE patients.id='{$_GET['patient_id']}'";
$result=$connect->query($sql);
$connect->close();
header("Location: index_page.php");
?>