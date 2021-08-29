<?php
class Comment{
    private $id;
    private $content;
    private $articleId;

    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    public function hydrate(array $data){
        foreach ($data as $key => $value) {
            $methode = 'set'.ucfirst($key);
            if (method_exists($this, $methode)) {
                $this->$methode($value);
            }
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent(string $content)
    {
        if ($content) {
            $this->content = $content;
        }
    }

    public function getArticleId()
    {
        return $this->articleId;
    }

    public function setId(int $id): void
    {
        if ($id > 0) {
            $this->id = $id;
        } else {
            echo "Mauvais ID";
        }
    }
    
    public function setArticleId(int $articleId)
    {
        if ($articleId > 0) {
            $this->articleId = $articleId;
        }
    }
}