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
        $name = null;
        $description = null;
        $price = null;

        if (!empty($_POST['name']) && !empty($_POST['description']) && !empty($_POST['price'])) {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
        }

        // var_dump($_POST);
        // die();

        if ($name && $description && $price && !empty($_FILES['imageVelo'])) {

            $file = new \App\File('imageVelo');
            $file->upload();

            $velo = new \Models\Velo();

            $velo->setName($name);
            $velo->setDescription($description);
            $velo->setPrice($price);
            $velo->setImage($file->getName());


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
     * (pour cette méthode je ne suis pas parvenu à récuperer l'id en instanciant une nouvelle classe vélo que je passe dans les paramètres)
     * (j'ai donc fait la méthode "à l'ancienne")
     */
    public function edit()
    {
        $pageTitle = "Modifier le vélo";
        $id = null;
        $velo = null;

        if (!empty($_GET['id']) && ctype_digit($_GET['id'])) {
            $id = $_GET['id'];
        }

        if ($id) {
            $velo = $this->defaultModel->findById($id);
        }

        $name = null;
        $image = null;
        $description = null;
        $price = null;
        $idToEdit = null;

        if (!empty($_POST['id']) && ctype_digit($_POST['id'])) {
            $idToEdit = $_POST['id'];
        }
        // var_dump($idToEdit);
        // die();


        if (!empty($_POST['name']) && !empty($_POST['image']) && !empty($_POST['description']) && !empty($_POST['price'])) {
            $name = htmlspecialchars($_POST['name']);
            $image = htmlspecialchars($_POST['image']);
            $description = htmlspecialchars($_POST['description']);
            $price = htmlspecialchars($_POST['price']);
        }

        if ($name && $image && $description && $price && $idToEdit) {
            $velo = new \Models\Velo();
            $velo->setName($name);
            $velo->setImage($image);
            $velo->setDescription($description);
            $velo->setPrice($price);

            $this->defaultModel->update($velo, $idToEdit);

            return $this->redirect([
                'type' => 'velo',
                'action' => 'show',
                'id' => $idToEdit
            ]);
        }
        return $this->render('velos/edit', ['pageTitle' => $pageTitle, 'velo' => $velo]);
    }
}