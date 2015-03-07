<?php

class LoginController
{
    private $userModel;

    public function __construct(UserModel $userModel)
    {
        $this->userModel = $userModel;
    }

    public function loginUser($request)
    {
        $loginUser = $this->userModel->findUserByUsernameAndPassword($request['username'], $request['password']);
        if ($loginUser){
            $this->setSessionUsername($loginUser);
        }
        return $loginUser;
    }

    private function setSessionUsername(User $user){
        $_SESSION['username'] = $user->getUsername();
    }
}