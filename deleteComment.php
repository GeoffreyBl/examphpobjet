<?php  
include "navbar.php";
function chargerClasse($classe)
{
    require $classe . ".php";
}
spl_autoload_register("chargerClasse");

if($_GET){
    $manager = new CommentManager;
    $comment = $manager->get($_GET['id']);
    $manager->delete($comment);
    header("Location:index.php");
} else {
    header("Location:index.php");
}