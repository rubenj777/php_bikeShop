<?php

namespace Models;

abstract class AbstractModel
{
    protected $pdo;
    protected string $tableName;

    public function __construct()
    {
        $this->pdo = \Database\PdoMySql::getPdo();
    }

    /**
     * retourn un element par son id
     * renvoie un tableau avec un element
     * @param integer 
     * @return array|bool
     */
    public function findById(int $id)
    {
        $sql = $this->pdo->prepare("SELECT * FROM {$this->tableName} WHERE id = :id");
        $sql->execute(["id" => $id]);
        $sql->setFetchMode(\PDO::FETCH_CLASS, get_class($this));
        $element = $sql->fetch();
        return $element;
    }


    /**
     * retourne un tableau contenant tous les elements
     * tous les champs de la table sql en question
     * @return array $elements
     */
    public function findAll(): array
    {
        $sql = $this->pdo->query("SELECT * FROM {$this->tableName}");
        $elements = $sql->fetchAll(\PDO::FETCH_CLASS, get_class($this));

        return $elements;
    }

    /**
     * supprime un element de la bdd par son id
     * @param object $object
     */
    public function remove($object): void
    {
        $sql = $this->pdo->prepare("DELETE FROM {$this->tableName} WHERE id = :id");
        $sql->execute([
            'id' => $object->getId()
        ]);
    }
}
