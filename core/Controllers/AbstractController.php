<?php

namespace Controllers;

abstract class AbstractController
{
    // dans chaque controller enfant on va initialiser le $defaultModelName en instanciant la classe correspondante : \Models\Element::class
    protected object $defaultModel;
    protected $defaultModelName;

    /**
     * le constructeur initialise un nouvel objet contenu dans $defaultModel
     */
    public function __construct()
    {
        $this->defaultModel = new $this->defaultModelName();
    }

    /**
     * permet de se rediriger vers la page qu'on souhaite en indiquant le chemin dans les paramètres
     * @return Response
     */
    public function redirect(?array $url = null)
    {
        return \App\Response::redirect($url);
    }

    /**
     * permet de faire le rendering d'une page
     * on chercher le template correspondant dans les paramètres
     */
    public function render(string $template, array $data)
    {
        return \App\View::render($template, $data);
    }

    public function getUser() {
        return \Models\User::getUser();
    }
}
