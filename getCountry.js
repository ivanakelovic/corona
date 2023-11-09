var xml=new XMLHttpRequest();
xml.onreadystatechange = function() {
    if(this.status==200 && this.readyState==4)
    {
        document.getElementById("ispis_pacijenata_table").innerHTML=this.responseText;
    }
}
var countryDropDown= document.getElementById("select_country");
countryDropDown.addEventListener("change", Izlistaj_pacijente);
window.addEventListener("load", Izlistaj_pacijente);

function Izlistaj_pacijente() {
    xml.open("GET", "Lista_pacijenata_za_drzave.php?selected_country="+countryDropDown.value);
    xml.send();

}