<?php
if(isset($_COOKIE['Popuni_sva_polja']))
{
    setcookie('Popuni_sva_polja', false);
    include_once ('Tekst_za_kuki_popuni_sva_polja.php');
}
$connect=mysqli_connect("localhost","root","","corona");
if($connect->connect_error)
{
    die("Error:".$connect->connect_error);
}

$sql = "SELECT * FROM countries";

$result=$connect->query($sql);
$countries=[];
if($result->num_rows>0)
{
    while($row=$result->fetch_assoc())
    {
        $countries[]=$row;
    }
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="style_Main_page.css" rel="stylesheet">
    <title>SZO - Dodaj osobu</title>
</head>
<body>

<div class="container">
    <div class="slika">
        <img src="logo.png">
    </div>
    <form action="Add_patient.php" method="get">
    <table>
        <tr>
            <td><label for="first_name" class="nowrap">Frist name:</label></td>
            <td><input type="text" name="first_name" id="first_name" required></td>
        </tr>
        <tr>
            <td><label for="last_name">Lat name:</label></td>
            <td><input type="text" name="last_name" id="last_name" required></td>
        </tr><tr>
            <td><label for="date">Birth date:</label></td>
            <td><input type="date" name="date" id="date" required></td>
        </tr><tr>
            <td><label for="country_name">Country:</label></td>
            <td><select name="country_name" id="country_name" required >
                    <option>--Select country--</option>
                    <?php
                    foreach($countries as $country)
                    {
                        echo "<option value='{$country['id']}'>{$country['country_name']}</option>";
                    }
                    ?>
                </select></td>
        </tr>
        <tr>
            <td><label for="infected">Infected:</label></td>
            <td class="radio_dugmici"><input type="radio" name="infected" id="infected" value="1" required>Yes<input type="radio" name="infected" id="infected" value="0" required>No</td>
        </tr>
        <tr>
            <td></td>
            <td class="dugmici_add_res"><button type="submit" class="dugme" id="add">Add</button>
                <button type="button" class="dugme" id="reset" >Reset fields</button>
                <script>
                     var b=document.getElementById("reset");
                     b.addEventListener("click",brisi);
                     function brisi() {
                         var poruka=confirm("Do you want to reset fields?");
                         if(poruka==true) {
                             var first_name = document.getElementById('first_name');
                             first_name.value = '';
                             var last_name = document.getElementById('last_name');
                             last_name.value = '';
                             var date = document.getElementById('date');
                             date.value = '';
                             var country_name = document.getElementById('country_name');
                             country_name.value = '';

                             var add_button = document.getElementById('add');
                             add_button.style.backgroundColor = "red";
                         }
                         else {

                         }
                     }

                </script>
            </td>
        </tr>
    </table>
    </form>
</div>

</body>
</html>
