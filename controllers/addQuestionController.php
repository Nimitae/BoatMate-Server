<?php

class AddQuestionController
{
    private $addQuestionModel;

    public function __construct(AddQuestionModel $addQuestionModel)
    {
        $this->addQuestionModel = $addQuestionModel;
    }

    public function checkAuthorisation()
    {
        if (isset($_SESSION['username'])) {
            return;
        } else {
            header("Location: login.php");
        }
    }

    public function addNewQuestion($data)
    {
        $this->addQuestionModel->addNewQuestion($data);
    }
}