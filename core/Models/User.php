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
        $this->password = password_hash($password, PASSWORD_DEFAULT);
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

    /**
     * @param string $username
     * @return User|bool
     */
    public function findByUsername(string $username)
    {
        $sql = $this->pdo->prepare("SELECT * FROM {$this->tableName} WHERE username = :username");
        $sql->execute(["username" => $username]);
        $sql->setFetchMode(\PDO::FETCH_CLASS, get_class($this));
        return $sql->fetch();

    }

    /**
     * @param User $user
     * @param string $password
     * @return bool
     */
    public function logIn(User $user, string $password)
    {
        $result = false;
        if(password_verify($password, $user->password)) {
            $_SESSION['user'] = $user;
            $result = true;
        }
        return $result;
    }

    /**
     * @return void
     */
    public function logOut()
    {
        unset($_SESSION['user']);
    }
}
