<?php

namespace Models;

class User extends AbstractModel
{
    protected string $tableName = "users";
    private int $id;
    private string $username;
    private string $password;
    private string $email;
    private string $display_name;

    // GETTERS
    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getDisplayName()
    {
        return $this->display_name;
    }

    // SETTERS
    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setDisplayName($display_name)
    {
        $this->display_name = $display_name;
    }

    /**
     * @param User $user
     * @return void
     */
    public function save(User $user)
    {
        $sql = $this->pdo->prepare("INSERT INTO {$this->tableName} (username, password, email, display_name) VALUES (:username, :password, :email, :display_name)");
        $sql->execute([
            'username' => $user->username,
            'password' => $user->password,
            'email' => $user->email,
            'display_name' => $user->display_name
        ]);
    }
}
