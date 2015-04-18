<?php

class AddQuestionView
{
    private $addQuestionModel;

    public function __construct(AddQuestionModel $addQuestionModel = NULL)
    {
        $this->addQuestionModel = $addQuestionModel;
    }

    public function output()
    {
        include("templates/addQuestion.php");
    }
}