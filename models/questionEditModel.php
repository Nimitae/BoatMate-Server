<?php
include("models/questionObject.php");

class QuestionEditModel
{
    private $pdo;
    private $questionsContainer;
    private $questionBeingEdited;
    private $editQuestionState;
    private $editQuestionErrorArray;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAllQuestions()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM questions;");
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->questionsContainer = $this->createQuestionObjectsArrayFromQueryResults($data);
    }

    public function getQuestionForEditing($questionID)
    {
        $questionBeingEdited = $this->getQuestionByQuestionID($questionID);
        if ($questionBeingEdited){
            $this->questionBeingEdited = $questionBeingEdited;
            $this->editQuestionState = QUESTION_FOUND;
        } else {
            $this->editQuestionState = QUESTION_NOT_FOUND;
        }
    }

    public function getQuestionByQuestionID($questionID)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM questions WHERE questionID = :questionID LIMIT 1;");
        $stmt->bindParam(':questionID', $questionID);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($data) {
            return new Question($data['topic'],$data['question'], $data['option1'], $data['option2'], $data['option3'], $data['option4'], $data['explanation'], $data['questionID'], $data['questionImage'], $data['explanationImage']);
        } else {
            return false;
        }
    }

    private function createQuestionObjectsArrayFromQueryResults($data)
    {
        $questionContainer = array();
        foreach ($data as $row) {
            $newQuestionObject = new Question($row['topic'],$row['question'], $row['option1'], $row['option2'], $row['option3'], $row['option4'], $row['explanation'], $row['questionID'], $row['questionImage'], $row['explanationImage']);
            $questionContainer[] = $newQuestionObject;
        }
        return $questionContainer;
    }

    public function getQuestionsContainer()
    {
        return $this->questionsContainer;
    }

    public function getEditQuestionState()
    {
        return $this->editQuestionState;
    }

    public function getQuestionBeingEdited()
    {
        return $this->questionBeingEdited;
    }

    public function getQuestionErrorArray(){
        return $this->editQuestionErrorArray;
    }

    public function validateEditedQuestion($data)
    {
        $this->questionBeingEdited = new Question($data['topic'],$data['question'], $data['option1'], $data['option2'], $data['option3'], $data['option4'], $data['explanation'], $data['questionID']);
        $this->editQuestionErrorArray = $this->questionBeingEdited->validateQuestionProperties(false);
        if (sizeof ($this->editQuestionErrorArray) > 0) {
            $this->editQuestionState = QUESTION_SAVE_FAILED;
            return false;
        } else {
            return true;
        }
    }

    public function saveEditedQuestion()
    {
        $stmt = $this->pdo->prepare("UPDATE questions SET question = :question,
                                      option1 = :option1,
                                      option2 = :option2,
                                      option3 = :option3,
                                      option4 = :option4,
                                      explanation = :explanation,
                                      questionImage = :questionImage,
                                      explanationImage = :explanationImage,
                                      topic = :topic
                                      WHERE questionID =:questionID;");
        /** @var Question $editedQuestion */
        $editedQuestion = $this->questionBeingEdited;
        $questionID = $editedQuestion->getQuestionID();
        $question = $editedQuestion->getQuestion();
        $option1 = $editedQuestion->getOption1();
        $option2 = $editedQuestion->getOption2();
        $option3 = $editedQuestion->getOption3();
        $option4 = $editedQuestion->getOption4();
        $explanation = $editedQuestion->getExplanation();
        $questionImage = $editedQuestion->getQuestionImage();
        $explanationImage = $editedQuestion->getExplanationImage();
        $topic = $editedQuestion->getTopic();
        $stmt->bindParam(':questionID', $questionID);
        $stmt->bindParam(':question', $question);
        $stmt->bindParam(':option1', $option1);
        $stmt->bindParam(':option2', $option2);
        $stmt->bindParam(':option3', $option3);
        $stmt->bindParam(':option4', $option4);
        $stmt->bindParam(':explanation', $explanation);
        $stmt->bindParam(':questionImage', $questionImage);
        $stmt->bindParam(':explanationImage', $explanationImage);
        $stmt->bindParam(':topic', $topic);
        if ($stmt->execute()){
            $this->editQuestionState = QUESTION_SAVED;
        } else {
            $this->editQuestionErrorArray[] = $stmt->errorInfo()[2];
            $this->editQuestionState = QUESTION_SAVE_FAILED;
        }
    }

    public function removeEditedQuestion()
    {
        $stmt = $this->pdo->prepare("DELETE FROM questions WHERE questionID = :questionID;");
        $questionID = $this->questionBeingEdited->getQuestionID();
        $stmt->bindParam(':questionID', $questionID);
        if($stmt->execute()){
            $this->editQuestionState = QUESTION_DELETED;
        } else {
            $this->editQuestionErrorArray[] = $stmt->errorInfo()[2];
            $this->editQuestionState = QUESTION_SAVE_FAILED;
        }
    }
}