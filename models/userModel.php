<?php
include("models/userObject.php");

class UserModel
{
    private $pdo;
    private $loginState;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAllUsers()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM user;");
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $this->createUserObjectsArrayFromQueryResults($data);
    }

    public function findUserByUsernameAndPassword($username, $password)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM user WHERE username = :username AND password = :password LIMIT 1;");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($data) {
            $this->loginState = LOGIN_SUCCESSFUL;
            return new User($data['username'], $data['password'], $data['position'], $data['userID']);
        } else {
            $this->loginState = LOGIN_UNSUCCESSFUL;
            return false;
        }
    }

    private function createUserObjectsArrayFromQueryResults($data)
    {
        $userContainer = array();
        foreach ($data as $row) {
            $newUserObject = new User($row['username'], $row['password'], $row['position'], $row['userID']);
            $userContainer[] = $newUserObject;
        }
        return $userContainer;
    }

    public function getLoginState()
    {
        return $this->loginState;
    }
}