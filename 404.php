<?php 
$title = "Oups";
include "navbar.php";
function chargerClasse($classe)
{
    require $classe . ".php";
}
spl_autoload_register("chargerClasse");
?>
<img src="./000-404.png" alt="" style="width:100%;height:100vh;">