<?php
include("models/DBConfig.php");
include("models/questionObject.php");

function createQuestionObjectsArrayFromQueryResults($data)
{
    $questionContainer = array();
    foreach ($data as $row) {
        $newQuestionObject = new Question($row['topic'],$row['question'], $row['option1'], $row['option2'], $row['option3'], $row['option4'], $row['explanation'], $row['questionID'], $row['questionImage'], $row['explanationImage']);
        $questionContainer[] = $newQuestionObject;
    }
    return $questionContainer;
}

$pdo = new PDO(DBconfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
$stmt = $pdo->prepare("SELECT * FROM questions;");
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
$questionsContainer = createQuestionObjectsArrayFromQueryResults($data);
header("Access-Control-Allow-Origin: *");
echo json_encode($questionsContainer);




