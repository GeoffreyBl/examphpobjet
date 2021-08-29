<?php

class CommentManager
{
    private $db;

    public function __construct()
    {
        $this->setDb(new PDO('mysql:host=localhost;dbname=news;port=8889;', 'root', 'root'));
    }

    public function setDb(PDO $db)
    {
        $this->db = $db;
    }

    public function create(Comment $comment){
        $req = $this->db->prepare("INSERT INTO `comments` (content, articleId) VALUES (:content, :articleId)");

        $req->bindValue(":content", $comment->getContent(), PDO::PARAM_STR);
        $req->bindValue(":articleId", $comment->getArticleId(), PDO::PARAM_INT);
        $req->execute();
    }

    public function get(int $id){
        $req = $this->db->prepare("SELECT * FROM `comments` WHERE id = :id");
        $req->bindParam(":id", $id, PDO::PARAM_INT);
        $req->execute();
        $data = $req->fetch();
        return new Comment($data);
    }
    
    public function getAll(){
        $comment = [];
        foreach ($this->db->query("SELECT * FROM `comments`") as $commentary){
            $comment[] = new Comment($commentary);
        }
        return $comment;
    }

    public function update(Comment $comment){
        $req = $this->db->prepare("UPDATE `comments` SET content = :content WHERE id = :id");
        $req->bindValue(":id", $comment->getId(), PDO::PARAM_INT);
        $req->bindValue(":content", $comment->getContent(), PDO::PARAM_STR);
        $req->execute();
    }

    public function delete(Comment $comment)
    {
        $this->db->exec("DELETE FROM `comments` WHERE id=" . $comment->getId()); 
    }
}