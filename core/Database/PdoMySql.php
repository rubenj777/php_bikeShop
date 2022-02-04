<?php

namespace Database;

class PdoMySql
{

    private static $currentPdo = null;

    /**
     * Retourne un objet de la classe Pdo pour intéragir avec la DB
     * nouvelle bdd : dbname = nom de la bdd, 2ème paramètre = nom de la bdd, 3ème paramètre = mdp de la bdd
     * condition pour ne pas ré instancier un nouveau pdo a chaque requete :
     * si $currentPdo est null, on instancie pdo
     * si $currentPdo non null (contient le pdo), on le retourne simplement
     * @return PDO
     */
    public static function getPdo(): \PDO
    {
        if(is_null(self::$currentPdo)) {
            self::$currentPdo = new \PDO("mysql:host=localhost;dbname=magasinVelo;charset=utf8", "user", "ruben", [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ
            ]);
        }
        return self::$currentPdo;
    }
}
