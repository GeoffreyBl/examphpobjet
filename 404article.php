<?php 
$title = "Oups";
include "navbar.php";
function chargerClasse($classe)
{
    require $classe . ".php";
}
spl_autoload_register("chargerClasse");
?>
<img src="./404article.jpeg" alt="" style="text-align:center;width:auto;margin-left:30%;height:70vh;">