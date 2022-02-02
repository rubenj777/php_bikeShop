<?php

namespace Controllers;

use Models\AbstractModel;

class User extends AbstractController
{
    protected $defaultModelName = \Models\User::class;

    /**
     * vérifie les infos entrées par l'utilisateur dans le formulaire 
     * si tout est ok enregistre dans la bdd
     */
    public function signUp()
    {
        $username = null;
        $password = null;
        $email = null;
        $display_name = null;

        if (!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['email']) && !empty($_POST['display_name'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $email = $_POST['email'];
            $display_name = $_POST['display_name'];
        }

        if ($username && $password & $email && $display_name) {
            $user = new \Models\User();
            $user->setUsername($username);
            $user->setPassword($password);
            $user->setEmail($email);
            $user->setDisplayName($display_name);

            $this->defaultModel->save($user);

            return $this->redirect(["type" => "velo", "action" => "index"]);
        }
        return $this->render("users/create", ["pageTitle" => "Inscription"]);
    }
}
