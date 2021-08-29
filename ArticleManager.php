<?php

class ArticleManager
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

    public function create(Article $data)
    {
        $req = $this->db->prepare("INSERT INTO `articles` (title, content, author, category) VALUES (:title, :content, :author, :category)");

        $req->bindValue(":title", $data->getTitle(), PDO::PARAM_STR);
        $req->bindValue(":content", $data->getContent(), PDO::PARAM_STR);
        $req->bindValue(":author", $data->getAuthor(), PDO::PARAM_STR);
        $req->bindValue(":category", $data->getCategory(), PDO::PARAM_STR);

        $req->execute();
    }

    public function get(int $id)
    {
        $req = $this->db->prepare("SELECT * FROM `articles` WHERE id = :id");
        $req->bindParam(":id", $id, PDO::PARAM_INT);
        $req->execute();
        $data = $req->fetch();
        if (!$data){
            return NULL;
        } else {
            return new Article($data);
        }
    }
    public function getAll()
    {
        $articles = [];
        foreach ($this->db->query("SELECT * FROM `articles` ORDER BY id DESC") as $data) {
            $articles[] = new Article($data);
        }
        return $articles;
    }

    public function update(Article $data)
    {
        $req = $this->db->prepare("UPDATE `articles` SET title = :title, content = :content, author = :author, category = :category WHERE id = :id");

        $req->bindValue(':id', $data->getId(), PDO::PARAM_INT);
        $req->bindValue(':title', $data->getTitle(), PDO::PARAM_STR);
        $req->bindValue(':content', $data->getContent(), PDO::PARAM_STR);
        $req->bindValue(':author', $data->getAuthor(), PDO::PARAM_STR);
        $req->bindValue(':category', $data->getCategory(), PDO::PARAM_STR);

        $req->execute();
    }

    public function delete(int $id)
    {
        $req = $this->db->prepare("DELETE FROM `articles` WHERE id = :id");
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
    }
}
