<?php

class UploadQuestionView
{
    private $uploadQuestionModel;

    public function __construct(UploadQuestionModel $uploadQuestionModel = NULL) {
        $this->uploadQuestionModel = $uploadQuestionModel;
    }

    public function output(){
        include("templates/uploadQuestionCSV.php");
    }
}