<?php
include("models/questionObject.php");

class AddQuestionModel
{
    private $pdo;
    private $questionBeingAdded;
    private $addQuestionState;
    private $addQuestionErrorArray;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function addNewQuestion($data)
    {
        $this->questionBeingAdded = new Question($data['topic'],$data['question'], $data['option1'], $data['option2'], $data['option3'], $data['option4'], $data['explanation']);
        $this->addQuestionErrorArray = $this->questionBeingAdded->validateQuestionProperties(false);
        if (sizeof ($this->addQuestionErrorArray) > 0) {
            $this->addQuestionState = QUESTION_ADD_FAILED;
        } else {
            $this->saveNewQuestionInDatabase($this->questionBeingAdded);
        }
    }

    public function saveNewQuestionInDatabase($question)
    {
        $sqlStatement = "INSERT INTO questions (questionID, question, option1, option2, option3, option4, explanation, questionImage, explanationImage, topic) VALUES (NULL, :question, :option1, :option2, :option3, :option4, :explanation, :questionImage, NULL, :topic)";
        $stmt = $this->pdo->prepare($sqlStatement);
        /** @var Question $question */
        $questionStatement = $question->getQuestion();
        $option1 = $question->getOption1();
        $option2 = $question->getOption2();
        $option3 = $question->getOption3();
        $option4 = $question->getOption4();
        $explanation = $question->getExplanation();
        $questionImage = $question->getQuestionImage();
        $topic = $question->getTopic();
        $stmt->bindParam(':question', $questionStatement);
        $stmt->bindParam(':option1', $option1);
        $stmt->bindParam(':option2', $option2);
        $stmt->bindParam(':option3', $option3);
        $stmt->bindParam(':option4', $option4);
        $stmt->bindParam(':explanation', $explanation);
        $stmt->bindParam(':questionImage', $questionImage);
        $stmt->bindParam(':topic', $topic);
        if ($stmt->execute()){
            $this->addQuestionState = QUESTION_ADDED;
        } else {
            $this->addQuestionErrorArray[] = $stmt->errorInfo()[2];
            $this->addQuestionState = QUESTION_ADD_FAILED;
        }
    }

    public function getAddQuestionState()
    {
        return $this->addQuestionState;
    }

    public function getAddQuestionErrorArray()
    {
        return $this->addQuestionErrorArray;
    }

    public function getQuestionBeingAdded()
    {
        return $this->questionBeingAdded;
    }
}