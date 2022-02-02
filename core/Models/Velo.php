<?php

namespace Models;

class Velo extends AbstractModel
{
    protected string $tableName = "velos";
    private int $id;
    private string $name;
    private string $description;
    private string $image;
    private int $price;

    // GETTERS
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function getPrice()
    {
        return $this->price;
    }

    //SETTERS
    public function setName($name)
    {
        $this->name = $name;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * sauvegarde un velo dans la bdd
     * @param Velo $velo
     * @return void
     */
    public function save(Velo $velo)
    {
        $sql = $this->pdo->prepare("INSERT INTO {$this->tableName} (name, description, image, price) VALUES (:name, :description, :image, :price)");
        $sql->execute([
            'name' => $velo->name,
            'description' => $velo->description,
            'image' => $velo->image,
            'price' => $velo->price
        ]);
    }


    /**
     * update un vélo dans la bdd
     * @param Velo $velo
     * @return void
     */
    public function update(Velo $velo)
    {
        $sql = $this->pdo->prepare("UPDATE {$this->tableName} SET name = :name, image = :image, description = :description, price = :price WHERE id = :id");
        $sql->execute([
            'name' => $velo->name,
            'image' => $velo->image,
            'description' => $velo->description,
            'price' => $velo->price,
            'id' => $velo->id,
        ]);
    }

    /**
     * trouve tous les avis attachés à un vélo
     */
    public function getAvis()
    {
        $modelAvis = new \Models\Avis();
        return $modelAvis->findAllByVelo($this);
    }
}
