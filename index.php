<?php 
$title = "Accueil";

include "navbar.php";

function chargerClasse($classe)
{
    require $classe . ".php";
}
spl_autoload_register("chargerClasse");
echo "<div class='container d-flex flex-wrap justify-content-center'>";
?>

<?php
$x = new ArticleManager();
$articles = $x->getAll();
$count = 0;
if($_GET['category']){
    foreach ($articles as $article) {
        if($article->getCategory() == $_GET['category']){
            echo "
            <div class='card indexcardbig m-3' style='width: 50rem;'>
                <div class='card-body'>
                    <b><h5 class='card-title m-0'>{$article->getTitle()}</h5></b>
                    <span><em id='author'> par : {$article->getAuthor()} dans {$article->getCategory()}</em></span>
                    <p class='card-text mt-2'>" . substr($article->getContent(), 0, 100) . " ...</p>
                    <a href='./read.php?id={$article->getId()}'  class='card-link lireLaSuite'>Lire la suite <i class='fas fa-arrow-right'></i></a>
                    <a href='./delete.php?id={$article->getId()}' id='trashcan'><i class='far fa-trash-alt'></i></a>
                    <a href='./update.php?id={$article->getId()}' id='edit'><i class='far fa-edit'></i></a>
                </div>
            </div>";
            $count++;
        }
    }
    if($count == 0){
        header("Location:404.php");
    }
} else {
    foreach ($articles as $article) {
        echo "
        <div class='card indexcard m-3'>
            <div class='card-body'>
                <b><h5 class='card-title m-0'>{$article->getTitle()}</h5></b>
                <span><em id='author'> par : {$article->getAuthor()} dans {$article->getCategory()}</em></span>
                <p class='card-text mt-2'>" . substr($article->getContent(), 0, 100) . " ...</p>
                <a href='./read.php?id={$article->getId()}'  class='card-link lireLaSuite'>Lire la suite <i class='fas fa-arrow-right'></i></a>
                <a href='./delete.php?id={$article->getId()}' id='trashcan'><i class='far fa-trash-alt'></i></a>
                <a href='./update.php?id={$article->getId()}' id='edit'><i class='far fa-edit'></i></a>
            </div>
        </div>";
    }
}
?>

</div>
</body>

</html>