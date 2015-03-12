<?php
include("forAllPages.php");
include("models/DBConfig.php");
include("models/uploadQuestionModel.php");
include("controllers/uploadQuestionController.php");
include("views/uploadQuestionView.php");

$pdo = new PDO(DBconfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
$model = new UploadQuestionModel($pdo);
$controller = new UploadQuestionController($model);

$controller->checkAuthorisation();
if (isset($_FILES["fileName"])){
    $controller->processFileUpload($_FILES["fileName"]);
}
$view = new UploadQuestionView($model);
$view->output();