<?php

$connect=mysqli_connect("localhost","root","","corona");
if($connect->connect_error)
{
    die("Error:".$connect->connect_error);
}
$country=$_GET['selected_country'];

if(empty($country)) {
    $sql = "SELECT patients.id,first_name, last_name, birth_year, country_name, infected FROM patients INNER JOIN countries ON patients.country_id = countries.id ORDER BY patients.id DESC";
}
else
{
    $sql = "SELECT patients.id,first_name, last_name, birth_year, country_name, infected FROM patients INNER JOIN countries ON patients.country_id = countries.id WHERE countries.country_name='{$_GET['selected_country']}' ORDER BY patients.id DESC";
}
$result= $connect->query($sql);
$patients=[];
if($result->num_rows>0)
{
    while ($row=$result->fetch_assoc())
    {
        $patients[]=$row;
    }
}
$resposne="";
$brojac_pacijenata=0;
$zarazaeni=0;
$nezarazeni=0;
foreach ($patients as $patient)
{
    if($patient['infected']==1) {
        $zarazaeni++;
    }
    else {
        $nezarazeni++;
    }

    if($brojac_pacijenata<5) {
        $link[$brojac_pacijenata]="Delete_patient.php?patient_id=".$patient["id"];
        /*  $link[$brojac_pacijenata]="{$patient["id"]}";*/
        $resposne .= "
        <tr>
        <td>{$patient['first_name']} {$patient['last_name']}</td>    
        <td>{$patient['birth_year']}</td>   
        <td>{$patient['country_name']}</td> 
        <td>{$patient['infected']}</td> 
        <td><a href='{$link[$brojac_pacijenata]}' onclick=\"return  confirm('Are you sure you want to delete this patient?')\">Delete</a></td>
        </tr>";
    }
        $brojac_pacijenata++;

}
echo  $resposne;
echo "
        <tr>
        <td>All infected in {$country}</td>    
        <td></td>   
        <td></td> 
        <td></td> 
        <td>$zarazaeni</td>
        </tr>
         <tr>
        <td>All uninfected in {$country} </td>    
        <td></td>   
        <td></td> 
        <td></td> 
        <td>$nezarazeni</td>
        </tr>
        ";
?>

