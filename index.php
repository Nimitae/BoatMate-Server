<?php
include("models/userModel.php");
include("models/DBConfig.php");
include("views/loginView.php");
include("controllers/loginController.php");
include("forAllPages.php");

$pdo = new PDO(DBconfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
$userModel = new UserModel($pdo);
$loginController = new LoginController($userModel);
if (isset($_POST['action'])) {
    $loginController->{$_POST['action']}($_POST);
}
$view = new LoginView($userModel);
$view->output();