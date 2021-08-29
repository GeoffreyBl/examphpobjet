<?php

class Article
{
    private $id;
    private $title;
    private $content;
    private $author;
    private $category;
    
    public function __construct(array $data)
    {
        $this->hydrate($data);
    }
    
    public function getTitle(): string
    {
        return $this->title;
    }
    
    public function getId(): int
    {
        return $this->id;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function setId(int $id): void
    {
        if ($id > 0) {
            $this->id = $id;
        } else {
            echo "Mauvais ID";
        }
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }
    
    public function setAuthor(string $author): void
    {
        $this->author = $author;
    }

    public function setCategory(string $category): void
    {
        $this->category = $category;
    }

    public function hydrate(array $data)
    {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }
}
