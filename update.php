<?php 
$title = "Modifier un article";
include "navbar.php";
function chargerClasse($classe)
{
    require $classe . ".php";
}
spl_autoload_register("chargerClasse");
$manager = new ArticleManager;
$article = $manager->get($_GET['id']);

if($_POST){
    if(strlen($_POST['title']) > 1 && strlen($_POST['content']) > 1 && strlen($_POST['author']) > 1){
        $data = [
            'id' => $_GET['id'],
            'title' => $_POST['title'],
            'content' => $_POST['content'],
            'author' => $_POST['author'],
            'category' => $_POST['category'],
        ];
        $ret = new Article($data);
        $manager = new ArticleManager;
        $manager->update($ret);
        header('Location:index.php');
    } else {
            echo "<center><h3 style='color:red'>Merci de vérifier votre saisie</h3></center>";
    }
}

?>
<div class="container mt-3">
    <h3>Modifier un article</h3>
    <form method="POST">
        <label for="title" class="form-label">Titre de l'article</label>
        <input type="text" required name="title" id="title" class="form-control" value="<?= $article->getTitle();?>">
        <br>
        <label for="content" class="form-label" >Contenu de l'article</label>
        <textarea name="content" required id="content_create" class="form-control"><?= $article->getContent();?></textarea>
        <br>
        <select class="form-control" name="category" id="category" value="<?= $article->getCategory();?>">
            <option>High-tech</option>
            <option>Programmation</option>
            <option>Automobile</option>
        </select><br>
        <label for="author" class="form-label">Auteur de l'article</label>
        <input type="text" required class="form-control inputstyle" placeholder="Auteur" name="author" id="author_create" value="<?= $article->getAuthor();?>"><br>
        <button type="submit" class="btn" id="submitbutton">Publier</button>
    </form>
</div>