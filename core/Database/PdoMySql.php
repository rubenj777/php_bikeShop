<?php

namespace Database;

class PdoMySql
{
    /**
     * Retourne un objet de la classe Pdo pour intéragir avec la DB
     * a chaque projet, nouvelle bdd : dbname = nom de la bdd, 2ème paramètre = nom de la bdd, 3ème paramètre = mdp de la bdd
     * bdd de l'exam poo
     * @return PDO
     */
    public static function getPdo(): \PDO
    {
        $pdo = new \PDO("mysql:host=localhost;dbname=magasinVelo;charset=utf8", "user", "ruben", [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ
        ]);
        return $pdo;
    }
}
