<?php
include("forAllPages.php");
include("models/DBConfig.php");
include("models/questionEditModel.php");
include("controllers/questionEditController.php");
include("views/questionEditView.php");

$pdo = new PDO(DBconfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
$model = new QuestionEditModel($pdo);
$controller = new QuestionEditController($model);
$view = new QuestionEditView($model);

$controller->checkAuthorisation();

if (isset($_GET['editQuestion'])) {
    $controller->loadQuestion($_GET['editQuestion']);
    if (isset($_POST['action'])){
        $controller->{$_POST['action']}($_POST);
    }
}
$controller->initialiseQuestionListing();
$view->output();
