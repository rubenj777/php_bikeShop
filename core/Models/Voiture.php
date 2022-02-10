<?php

namespace Models;

class Voiture extends AbstractModel implements \JsonSerializable {
    protected string $tableName = "voitures";
    private int $id;
    private string $name;
    private string $brand;
    private int $price;

    public function getId() {
        return $this->id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setBrand($brand) {
        $this->brand = $brand;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function jsonSerialize()
    {
        return ["id"=>$this->id, "name"=>$this->name, "brand"=>$this->brand, "price"=>$this->price];
    }

    /**
     * @param Voiture $voiture
     * @return void
     */
    public function save(Voiture $voiture)
    {
        $sql = $this->pdo->prepare("INSERT INTO {$this->tableName} (name, brand, price) VALUES (:name, :brand, :price)");
        $sql->execute([
            'name' => $voiture->name,
            'brand' => $voiture->brand,
            'price' => $voiture->price
        ]);
    }
}
