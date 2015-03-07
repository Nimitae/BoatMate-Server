<?php

class LoginView
{
    private $userModel;

    public function __construct(UserModel $userModel = NULL) {
        $this->userModel = $userModel;
    }

    public function output(){
        if ($this->userModel->getLoginState() == LOGIN_SUCCESSFUL){
            include("templates/loginSuccess.php");
        } else {
            include("templates/loginPage.php");
        }
    }
}