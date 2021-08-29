<?php  
include "navbar.php";
function chargerClasse($classe)
{
    require $classe . ".php";
}
spl_autoload_register("chargerClasse");

if($_GET){
    $manager = new ArticleManager;
    $manager->delete($_GET['id']);
    header("Location:index.php");
} else {
    header("Location:index.php");
}