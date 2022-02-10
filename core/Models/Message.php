<?php

namespace Models;

class Message extends AbstractModel implements \JsonSerializable
{
    protected string $tableName = "messages";
    private int $id;
    private string $author;
    private string $content;

    public function getId()
    {
        return $this->id;
    }

    public function setAuthor($author)
    {
        $this->author = $author;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }


    public function jsonSerialize()
    {
        return [
            "id"=>$this->id,
            "author"=>$this->author,
            "content"=>$this->content
        ];
    }

    /**
     * @param Message $message
     * @return void
     */
    public function save(Message $message)
    {
        $sql = $this->pdo->prepare("INSERT INTO {$this->tableName} (author, content) VALUES (:author, :content)");
        $sql->execute([
            'author' => $message->author,
            'content' => $message->content
        ]);
    }
}
