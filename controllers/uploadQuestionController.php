<?php

class UploadQuestionController
{
    private $uploadQuestionModel;

    public function __construct(UploadQuestionModel $uploadQuestionModel)
    {
        $this->uploadQuestionModel = $uploadQuestionModel;
    }

    public function processFileUpload($fileData)
    {
        $this->uploadQuestionModel->processFileUpload($fileData);
    }

    public function checkAuthorisation()
    {
        if (isset($_SESSION['username'])) {
            return;
        } else {
            header("Location: login.php");
        }
    }
}