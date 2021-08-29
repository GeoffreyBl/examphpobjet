<?php 
$title = "Creation d'un article";
include "navbar.php";
function chargerClasse($classe)
{
    require $classe . ".php";
}
spl_autoload_register("chargerClasse");

if($_POST){
    if(strlen($_POST['title']) > 1 && strlen($_POST['content']) > 1 && strlen($_POST['author']) > 1){
        $data = [
            'title' => $_POST['title'],
            'content' => $_POST['content'],
            'author' => $_POST['author'],
            'category' => $_POST['category'],
        ];
        $ret = new Article($data);
        $manager = new ArticleManager;
        $manager->create($ret);
        header('Location:index.php');
    } else {
        echo "<center><h3> Merci de vérifier votre saisie</center></h3>";
    }
}
?>

<div class="container mt-3">
    <h3>Publier un article</h3>
    <form method="POST">
        <input type="text" placeholder="Titre de l'article" name="title" id="title" class="form-control inputstyle" required>
        <br>
        <label for="content" class="form-label">Contenu de l'article</label>
        <textarea name="content" id="content_create" class="form-control" required></textarea>
        <br>
        <div class="d-flex selectcreate justify-content-between">
            <select class="form-control" name="category" id="category_create">
                <option>High-tech</option>
                <option>Programmation</option>
                <option>Automobile</option>
            </select>
            <input type="text" class="form-control inputstyle" placeholder="Auteur" required name="author" id="author_create">
            <button type="submit" class="btn" id="submitbutton">Publier</button>
        </div>
    </form>
</div>