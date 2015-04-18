<?php
include("forAllPages.php");
include("models/addQuestionModel.php");
include("models/DBConfig.php");
include("views/addQuestionView.php");
include("controllers/addQuestionController.php");

$pdo = new PDO(DBconfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
$model = new AddQuestionModel($pdo);
$controller = new AddQuestionController($model);
$view = new AddQuestionView($model);

$controller->checkAuthorisation();

if (isset($_POST['action'])){
    $controller->{$_POST['action']}($_POST);
}

$view->output();