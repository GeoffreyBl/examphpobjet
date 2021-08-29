<?php 
$title = "Lecture d'un article";
include "navbar.php";

function chargerClasse($classe)
{
    require $classe . ".php";
}
spl_autoload_register("chargerClasse");

$manager = new ArticleManager;
if ($manager->get($_GET['id']) == NULL) {
    header("Location:404article.php");
} else {
    $article = $manager->get($_GET['id']);
}
?>

<div class="container">
    <h1 id="titleread"><?= $article->getTitle();?></h1>
    <p id="author_read"><em>Par <?= $article->getAuthor(). " (" .  $article->getCategory() . ")";?></em></p>
    <p id="content"><?= $article->getContent();?></p>
    <p><u>Commentaires : </u></p>
    <?php 
    $manager = new CommentManager();
    $comments = $manager->getAll();
    foreach($comments as $comment){
        if($comment->getArticleId() == $_GET['id'])
            echo "<p class='m-0 mb-1'><i class='far fa-comment-dots'></i> - {$comment->getContent()} <a href='./deleteComment.php?id={$comment->getId()}' id=''><i class='far fa-trash-alt'></i></a>
                <a href='./updateComment.php?id={$comment->getId()}' id=''><i class='far fa-edit'></i></a>";
    }
    if($_POST){
        if(strlen($_POST['content']) > 1){
            $manager = new CommentManager();
            $data = [
                'content' => $_POST['content'],
                'articleId' => $_GET['id']
            ];
            $ret = new Comment($data);
            $manager->create($ret);
            echo "<meta http-equiv='refresh' content='0'>";
        } else {
            echo "<center><h3 style='color:red'>Merci de vérifier votre saisie</h3></center>";
        }
    }
    ?>
    <form method="POST">
        <label for="content"><u>Inserer un commentaire :</u></label>
        <input type="text" class="form-control" name="content" required id="content">
        <button type="submit" class="btn" id="submitbutton">Envoyer</button>
    </form>
</div>