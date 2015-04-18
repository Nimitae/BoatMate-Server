<?php

class QuestionEditView
{
    private $questionEditModel;

    public function __construct(QuestionEditModel $questionEditModel = NULL)
    {
        $this->questionEditModel = $questionEditModel;
    }

    public function output()
    {
        switch ($this->questionEditModel->getEditQuestionState()) {
            case QUESTION_FOUND :
            case QUESTION_SAVE_FAILED :
                include("templates/questionEdit.php");
                break;
            case QUESTION_SAVED :
            case QUESTION_DELETED :
            case QUESTION_NOT_FOUND :
            default:
                include("templates/questionList.php");
        }
    }
}