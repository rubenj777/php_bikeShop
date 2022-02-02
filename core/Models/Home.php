<?php

namespace Models;

class Home extends AbstractModel
{
    protected string $tableName = "table sql";

    // une propriété private ainsi qu'un getter et un setter pour chaque colonne de la table sql
    // cela permet d'améliorer la sécurité du code afin qu'on ne puisse pas faire tout ce qu'on veut
    // avec depuis l'extérieur de la classe

    // on peut effectuer des vérifications : si l'attribut est déjà initialisé ou si le paramètre n'est pas null par ex

    // private $content;

    // public function getContent()
    // {
    //     return $this->content;
    // }

    // public function setContent($content)
    // {
    //     $this->content = $content;
    // }
}
