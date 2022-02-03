<?php

namespace Controllers;

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
            $username = htmlspecialchars($_POST['username']);
            $password = htmlspecialchars($_POST['password']);
            $email = htmlspecialchars($_POST['email']);
            $display_name = htmlspecialchars($_POST['display_name']);
        }

        if ($username && $password & $email && $display_name) {

            if ($this->defaultModel->findByUsername($username)) {
                return $this->redirect(["type" => "user", "action" => "signUp", "info" => "userExists"]);
            }
            $user = new \Models\User();
            $user->setUsername($username);
            $user->setPassword($password);
            $user->setEmail($email);
            $user->setDisplayName($display_name);

            $this->defaultModel->register($user);


            return $this->redirect(["type" => "velo", "action" => "index"]);
        }
        return $this->render("users/signup", ["pageTitle" => "Inscription"]);
    }

    public function signIn()
    {
        $username = null;
        $password = null;

        if (!empty($_POST['username']) && !empty($_POST['password'])) {
            $username = htmlspecialchars($_POST['username']);
            $password = htmlspecialchars($_POST['password']);
        }

        if ($username && $password) {

            $loggingInUser = $this->defaultModel->findByUsername($username);

            if (!$loggingInUser) {
                $this->redirect(["type" => "user", "action" => "signIn", "info"=>"unknown"]);
            }

            if (!$loggingInUser->logIn($password)) {
                $this->redirect(["type" => "user", "action" => "signIn", "info" => "wrongPassword"]);
            }

            $this->redirect(["type" => "home", "action" => "index"]);

        }

        return $this->render("users/signin", ["pageTitle" => "Connexion"]);
    }

    public function signOut()
    {
        $this->defaultModel->logOut();
        return $this->redirect(["type" => "home", "action" => "index", "info" => "logOut"]);
    }
}
