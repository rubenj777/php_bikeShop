<?php

namespace Controllers;

class Velo extends AbstractController
{
    protected $defaultModelName = \Models\Velo::class;

    /**
     * affiche tous les vélos grace à la méthode findAll()
     */
    public function index()
    {
        return $this->render("velos/index", ["pageTitle" => "Accueil", "velos" => $this->defaultModel->findAll()]);
    }

    /**
     * @return void
     */
    public function indexApi()
    {
        return $this->json($this->defaultModel->findAll());
    }

    /**
     * @return Response|void
     */
    public function showApi()
    {
        $id = null;

        if (!empty($_GET['id']) && ctype_digit($_GET['id'])) {
            $id = $_GET['id'];
        }

        if (!$id) {
            return $this->json("pas d'id");
        }

        $velo = $this->defaultModel->findById($id);

        if (!$velo) {
            return $this->json("pas de vélo");
        }

        sleep(1);
        return $this->json($this->defaultModel->findById($id));
    }

    /**
     * affiche un seul vélo grace à la methode findById()
     * affiche les avis grace à la methode findAllByVelo()
     */
    public function show()
    {
        $id = null;

        if (!empty($_GET['id']) && ctype_digit($_GET['id'])) {
            $id = $_GET['id'];
        }

        if (!$id) {
            return $this->redirect(["type" => "velo", "action" => "index", "info" => "noId"]);
        }

        $velo = $this->defaultModel->findById($id);

        if (!$velo) {
            return $this->redirect(["type" => "velo", "action" => "index", "info" => "noId"]);
        }

        return $this->render("velos/show", ["pageTitle" => $velo->getName(), "velo" => $velo]);
    }

    /**
     * vérifie les informations entrées par l'utilisateur avant de faire appel à la méthode save() qui insert les données dans la DB
     */
    public function new()
    {
        $user = $this->getUser();
        if(!$user) {
            return $this->redirect(["type"=>"velo", "action"=>"index", "info"=>"Vous devez être connecté pour créer un vélo"]);
        }

        $name = null;
        $description = null;
        $price = null;
        $user_id = null;

        if (!empty($_POST['name']) && !empty($_POST['description']) && !empty($_POST['price'])) {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
        }

        if ($name && $description && $price && !empty($_FILES['imageVelo'])) {

            $file = new \App\File('imageVelo');
            $file->upload();

            $velo = new \Models\Velo();

            $velo->setName($name);
            $velo->setDescription($description);
            $velo->setPrice($price);
            $velo->setImage($file->getName());
            $velo->setUserId($this->getUser()->getId());


            if (!$file->isImage()) {
                return $this->redirect(["type" => "velo", "action" => "index"]);
            } else {
                $this->defaultModel->save($velo);
            }

            return $this->redirect(["type" => "velo", "action" => "index"]);
        }
        return $this->render("velos/create", ["pageTitle" => "Nouveau vélo"]);
    }

    /**
     * vérifie les informations entrées par l'utilisateur avant de faire appel à la méthode save() qui insert les données dans la DB
     */
    public function newApi()
    {
        $user = $this->getUser();
        if(!$user) {
            return $this->redirect(["type"=>"velo", "action"=>"index", "info"=>"Vous devez être connecté pour créer un vélo"]);
        }

        $name = null;
        $description = null;
        $price = null;
        $user_id = null;

        if (!empty($_POST['name']) && !empty($_POST['description']) && !empty($_POST['price'])) {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
        }

        if ($name && $description && $price && !empty($_FILES['imageVelo'])) {

            $file = new \App\File('imageVelo');
            $file->upload();

            $velo = new \Models\Velo();

            $velo->setName($name);
            $velo->setDescription($description);
            $velo->setPrice($price);
            $velo->setImage($file->getName());
            $velo->setUserId($this->getUser()->getId());


            if (!$file->isImage()) {
                return $this->redirect(["type" => "velo", "action" => "index"]);
            } else {
                $this->defaultModel->save($velo);
            }

            return $this->redirect(["type" => "velo", "action" => "index"]);
        }
        return $this->render("velos/create", ["pageTitle" => "Nouveau vélo"]);
    }

    /**
     * cherche l'id du velo a supprimer et fait appel à la méthode remove($id) qui supprime le velo de la DB
     * @return Response
     */
    public function delete()
    {
        $id = null;

        if (!empty($_POST['id']) && ctype_digit($_POST['id'])) {
            $id = $_POST['id'];
        }

        if (!$id) {
            return $this->redirect(["type" => "velo", "action" => "index", "info" => "noId"]);
        }

        $velo = $this->defaultModel->findById($id);

        if ($velo) {
            $this->defaultModel->remove($velo);
        }

        return $this->redirect(["type" => "velo", "action" => "index"]);
    }

    /**
     * cherche l'id du vélo à modifier
     * récupère les infos du formulaire et vérifie qu'elles sont correctes
     * si tout est ok, fait appel à la fonction update() pour enregistrer les modifs dans la bdd
     */
    public function edit()
    {

        $name = null;
        $description = null;
        $price = null;
        $id = null;
        $velo = null;

        if (!empty($_GET['id']) && ctype_digit($_GET['id'])) {
            $id = $_GET['id'];

        }
        $velo = $this->defaultModel->findById($id);

        if (!empty($_POST['name']) && !empty($_POST['description']) && !empty($_POST['price'])) {
            $name = htmlspecialchars($_POST['name']);
            $description = htmlspecialchars($_POST['description']);
            $price = htmlspecialchars($_POST['price']);
        }

        if ($name && $description && $price && !empty($_FILES['imageVelo'])) {
            unset($file);
            $file = new \App\File('imageVelo');
            $file->upload();


            $velo->setName($name);
            $velo->setDescription($description);
            $velo->setPrice($price);

            $velo->setImage($file->getName());

            if (!$file->isImage()) {
                return $this->redirect(["type" => "velo", "action" => "index"]);
            } else {
                $this->defaultModel->update($velo);
            }

            return $this->redirect([
                'type' => 'velo',
                'action' => 'show',
                'id' => $id
            ]);
        }
        return $this->render('velos/edit', ['pageTitle' => "Modifier", 'velo' => $velo]);
    }

}
