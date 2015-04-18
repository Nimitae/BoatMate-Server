<?php
include("models/questionObject.php");

class UploadQuestionModel
{
    private $pdo;
    private $uploadQuestionState;
    private $fileUploadErrors;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
        $this->fileUploadErrors = array();
    }

    public function processFileUpload($fileData)
    {
        $this->validateFileUpload($fileData);
        if (sizeof($this->fileUploadErrors) == 0) {
            $fileHandler = fopen($fileData["tmp_name"], 'r');
            $questionData = array();
            while (($data = fgetcsv($fileHandler, 100000, ",")) !== FALSE) {
                $questionData[] = $data;
            }
            $questionsContainer = $this->constructQuestionsContainerFromQuestionData($questionData);
            if ($questionsContainer) {
                $this->emptyQuestionsTable();
                $this->storeQuestionArrayInDatabase($questionsContainer);
            }
        } else {
            $this->uploadQuestionState = UPLOAD_CSV_FAILED;
        }
    }

    public function getUploadQuestionState()
    {
        return $this->uploadQuestionState;
    }

    public function getFileUploadErrors()
    {
        return $this->fileUploadErrors;
    }

    private function validateFileUpload($fileData)
    {
        $fileType = explode(".", $fileData['name']);
        if (!isset($fileType[1]) || strtolower($fileType[1]) != "csv") {
            $this->fileUploadErrors[] = "File uploaded is not of csv format!";
        }
        if ($fileData['error'] > 0) {
            $this->fileUploadErrors[] = $fileData['error'];
        }
    }

    private function storeQuestionArrayInDatabase($questionsArray)
    {
        $allUploadSuccessful = true;
        for ($i = 0; $i < (sizeof($questionsArray) / 1000); $i++) {
            $sqlStatement = "INSERT INTO questions (questionID, question, option1, option2, option3, option4, explanation, questionImage, explanationImage, topic) VALUES ";
            $sqlParams = array();
            for ($questionIndex = 0; $questionIndex < min(sizeof($questionsArray) - 1000 * $i, 1000); $questionIndex++) {
                if ($questionIndex != 0){
                    $sqlStatement .= ",";
                }
                $sqlStatement .= "(NULL, ?, ?, ?, ?, ?, ?, ?, NULL, ?)";
                /** @var Question $currentQuestion */
                $currentQuestion = $questionsArray[$questionIndex + $i * 1000];
                $sqlParams[] = $currentQuestion->getQuestion();
                $sqlParams[] = $currentQuestion->getOption1();
                $sqlParams[] = $currentQuestion->getOption2();
                $sqlParams[] = $currentQuestion->getOption3();
                $sqlParams[] = $currentQuestion->getOption4();
                $sqlParams[] = $currentQuestion->getExplanation();
                $sqlParams[] = $currentQuestion->getQuestionImage();
                $sqlParams[] = $currentQuestion->getTopic();
            }
            $sqlStatement .= ";";
            $stmt = $this->pdo->prepare($sqlStatement);
            if (!$stmt->execute($sqlParams)){
                $allUploadSuccessful = false;
            }
        }
        if ($allUploadSuccessful){
            $this->uploadQuestionState = UPLOAD_CSV_SUCCESSFUL;
        } else {
            $this->uploadQuestionState = UPLOAD_CSV_FAILED;
            $this->fileUploadErrors[] = "An error occurred while uploading questions into the database!";
        }
    }

    private function constructQuestionsContainerFromQuestionData($questionData)
    {
        $questionsContainer = array();
        foreach ($questionData as $question) {
            $newQuestion = new Question($question[0],$question[1], $question[2], $question[3], $question[4], $question[5],$question[7], NULL, $question[6]);
            if (sizeof($newQuestion->validateQuestionProperties(true)) > 0) {
                $this->uploadQuestionState = UPLOAD_CSV_FAILED;
                $this->fileUploadErrors[] = "Some questions in CSV file are invalid!";
                return false;
            } else {
                $questionsContainer[] = $newQuestion;
            }
        }
        return $questionsContainer;
    }

    private function emptyQuestionsTable()
    {
        $this->pdo->query("TRUNCATE TABLE questions;");
    }
}