<?php

$first_name=$_GET["first_name"];
$last_name=$_GET["last_name"];
$date=$_GET["date"];
$country=$_GET["country_name"];
$infected=$_GET["infected"];
if($first_name==null || $last_name==null || $date==null || $country==null||$infected==null)
{
    setcookie("Popuni_sva_polja",true);
    header("Location: Main_page.php");
}
else{

    $connect=mysqli_connect("localhost","root","",'corona');
    if($connect->connect_error)
    {
        die("Error:".$connect->connect_error);
    }
    $sql="SELECT * FROM patients ORDER BY patients.id DESC";
    $result= $connect->query($sql);

    $last_id=0;

    if($result->num_rows>0)
    {

        $last_id=$result->fetch_assoc()["id"];

    }

    $last_id=$last_id+1;
    $connect->close();

    $connect=mysqli_connect('localhost','root','','corona');
    $sql="INSERT INTO patients ( id,country_id,first_name,last_name,birth_year,infected) VALUES ('{$last_id}','{$country}','{$first_name}','{$last_name}','{$date}','{$infected}')";
    $connect->query($sql);
    $connect->close();

    header("Location: index_page.php");
}
?>