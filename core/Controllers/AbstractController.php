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
     * @param $res
     * @return void
     */
    public function json($res,? string $methodSpe = null){
        return \App\Response::json($res, $methodSpe);
    }

    /**
     * @param string $dataType
     * @param array $requestBodyParams
     * @return array|false
     */
    public function post(string $dataType, array $requestBodyParams) {
        return \App\Request::post($dataType, $requestBodyParams);
    }

    /**
     * @param string $dataType
     * @param array $requestBodyParams
     * @return array|false
     */
    public function get(string $dataType, array $requestBodyParams) {
        return \App\Request::get($dataType, $requestBodyParams);
    }

    /**
     * @param string $dataType
     * @param array $requestBodyParams
     * @return array|false
     */
    public function put(string $dataType, array $requestBodyParams) {
        return \App\Request::put($dataType, $requestBodyParams);
    }

    /**
     * @param string $dataType
     * @param array $requestBodyParams
     * @return array|false
     */
    public function delete(string $dataType, array $requestBodyParams) {
        return \App\Request::delete($dataType, $requestBodyParams);
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
