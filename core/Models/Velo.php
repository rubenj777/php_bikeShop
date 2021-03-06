<?php

namespace Models;

class Velo extends AbstractModel implements \JsonSerializable
{
    public function jsonSerialize()
    {
      return [
          "id"=>$this->id,
          "name"=>$this->name,
          "description"=>$this->description,
          "image"=>$this->image,
          "avis"=>$this->getAvis(),
      ];
    }

    protected string $tableName = "velos";
    private int $id;
    private string $name;
    private string $description;
    private string $image;
    private int $price;
    private int $user_id;

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

    public function getUserId()
    {
        return $this->user_id;
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

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * sauvegarde un velo dans la bdd
     * @param Velo $velo
     * @return void
     */
    public function save(Velo $velo)
    {
        $sql = $this->pdo->prepare("INSERT INTO {$this->tableName} (name, description, image, price, user_id) VALUES (:name, :description, :image, :price, :user_id)");
        $sql->execute([
            'name' => $velo->name,
            'description' => $velo->description,
            'image' => $velo->image,
            'price' => $velo->price,
            'user_id'=>$velo->user_id,
        ]);
    }


    /**
     * update un v??lo dans la bdd
     * @param Velo $velo
     * @return void
     */
    public function update(Velo $velo)
    {
        $sql = $this->pdo->prepare("UPDATE {$this->tableName} 
        SET name = :name, description = :description, price = :price WHERE id = :id");
        $sql->execute([
            'name' => $velo->name,
            'description' => $velo->description,
            'price' => $velo->price,
            'id' => $velo->id,
        ]);
    }

    /**
     * trouve tous les avis attach??s ?? un v??lo
     */
    public function getAvis()
    {
        $modelAvis = new \Models\Avis();
        return $modelAvis->findAllByVelo($this);
    }

    public function getUser()
    {
        $modelUser = new \Models\User();
        return $modelUser->findById($this->user_id);
    }
}
