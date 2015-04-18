<?php

class QuestionEditController
{
    private $questionEditModel;

    public function __construct(QuestionEditModel $questionEditModel)
    {
        $this->questionEditModel = $questionEditModel;
    }

    public function checkAuthorisation()
    {
        if (isset($_SESSION['username'])) {
            return;
        } else {
            header("Location: login.php");
        }
    }

    public function initialiseQuestionListing()
    {
        $this->questionEditModel->getAllQuestions();
    }

    public function loadQuestion($questionID)
    {
        $this->questionEditModel->getQuestionForEditing($questionID);
    }

    public function saveEditedQuestion()
    {
        if ($this->questionEditModel->validateEditedQuestion($_POST)) {
            $this->questionEditModel->saveEditedQuestion();
        }
    }

    public function removeEditedQuestion()
    {
        $this->questionEditModel->removeEditedQuestion();
    }
}