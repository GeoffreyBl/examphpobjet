<?php 
$title = "Modifier un commentaire";
include "navbar.php";
function chargerClasse($classe)
{
    require $classe . ".php";
}
spl_autoload_register("chargerClasse");
$manager = new CommentManager();
if($_POST){
    $data = [
        'content' => $_POST['content'],
        'id' => $_GET['id']
    ];
    $manager = new CommentManager();
    $ret = new Comment($data);
    $manager->update($ret);
    header('Location:index.php');
}
foreach($manager->getAll() as $comment){
    if($comment->getId() == $_GET['id']){?>
        <form method="post">
            <h4>Modification du commentaire : </h4>
            <input type="text" class="form-control" value="<?= $comment->getContent(); ?>" name="content" id="content"><br>
            <input type="hidden" name="id" value="<?= $comment->getId(); ?>">
            <button type="submit" class="btn" id="submitbutton">Modifier</button>
        </form>
<?php

    }
}
?>
