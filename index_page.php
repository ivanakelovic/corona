<?php

$connect=mysqli_connect("localhost","root","","corona");
if($connect->connect_error)
{
    die("Error:".$connect->connect_error);
}
$sql="SELECT * FROM countries";
$result=$connect->query($sql);
if($result->num_rows>0)
{
    while ($row=$result->fetch_assoc())
    {
        $countries[]=$row;
    }
}
$connect->close();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="style_Index_page.css" rel="stylesheet">

    <title>Index</title>
</head>
<body>
<div class="zaglavlje">
    <img src="logo.png">
    <button class="dugme" onclick="window.location='Main_page.php'">Add</button>
</div>
<div class="ispis_tabela">
    <select id="select_country">
    <option value="">--Select country--</option>
        <?php
        $name=[];
        foreach($countries as $name)
        {
            echo "<option value='{$name['country_name']}'>{$name['country_name']}</option>";
        }
        ?>
    </select>
    <table>
        <thead>
        <tr>
            <th>First and Last name</th>
            <th>Birth year</th>
            <th>Country</th>
            <th>Infected</th>
            <th></th>
        </tr>
        </thead>
        <tbody id="ispis_pacijenata_table">

        </tbody>
    </table>
</div>

<script src="getCountry.js"></script>
</body>
</html>