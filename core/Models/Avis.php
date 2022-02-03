<?php

namespace Models;

class Avis extends AbstractModel
{
    protected string $tableName = "avis";
    private int $id;
    private string $author;
    private string $content;
    private int $velo_id;
    private int $user_id;


    // GETTERS
    public function getId()
    {
        return $this->id;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getVeloId()
    {
        return $this->velo_id;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    // SETTERS
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function setVeloId($velo_id)
    {
        $this->velo_id = $velo_id;
    }

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * trouver tous les avis d'un vélo
     * renvoie un tableau contenant les avis
     * @param Velo $velo
     * @return array|bool
     */
    public function findAllByVelo(Velo $velo)
    {
        $sql = $this->pdo->prepare("SELECT * FROM {$this->tableName} WHERE velo_id = :velo_id");
        $sql->execute(['velo_id' => $velo->getId()]);
        $avis = $sql->fetchAll(\PDO::FETCH_CLASS, get_class($this));
        return $avis;
    }

    /**
     * insert dans la bdd le nouveau commentaire
     * @param Avis $avis
     */
    public function save(Avis $avis): void
    {
        $sql = $this->pdo->prepare("INSERT INTO {$this->tableName} (content, velo_id, user_id) VALUES (:content, :velo_id, :user_id)");
        $sql->execute([
            'content' => $avis->content,
            'velo_id' => $avis->velo_id,
            'user_id' => $avis->user_id,
        ]);
    }

    /**
     * update un avis dans la bdd
     * @param Avis $avis
     * @return void
     */
    public function update(Avis $avis)
    {
        $sql = $this->pdo->prepare("UPDATE {$this->tableName} SET author = :author, content = :content WHERE id = :id");
        $sql->execute([
            'author' => $avis->author,
            'content' => $avis->content,
            'id' => $avis->id,
        ]);
    }

    public function getUser()
    {
        $modelUser = new \Models\User();
        return $modelUser->findById($this->user_id);
    }
}
