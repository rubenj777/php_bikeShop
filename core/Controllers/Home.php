<?php

namespace Controllers;

class Home extends AbstractController
{
    protected $defaultModelName = \Models\Home::class;

    /**
     * affiche l'accueil
     * le kernel surveille deux paramètres dans l'url
     * 'type' et 'action' pour le controller et la méthode
     * pour cette méthode : home / index
     */
    public function index()
    {
        // si besoin d'intéragir avec la bdd, utiliser le model par defaut du controller et faire une requête directement depuis la class
        // $elements = $this->defaultModel->findAll();

        // 2 paramètres sont nécessaires :
        // - dossier / template
        // - tableau d'options qui contient minimum le titre de la page et un index et valeur pour chaque variable exploité par le template

        return $this->render("home/index", ["pageTitle" => "Home page"]);
    }
}
