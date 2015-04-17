<?php

class Question implements JsonSerializable
{
    private $questionID;
    private $question;
    private $option1;
    private $option2;
    private $option3;
    private $option4;
    private $explanation;
    private $questionImage;
    private $explanationImage;
    private $topic;

    public function __construct($topic, $question, $option1, $option2, $option3, $option4, $explanation, $questionID = NULL, $questionImage = NULL, $explanationImage = NULL)
    {
        $this->questionID = $questionID;
        $this->topic = $topic;
        $this->question = $question;
        $this->option1 = $option1;
        $this->option2 = $option2;
        $this->option3 = $option3;
        $this->option4 = $option4;
        $this->explanation = $explanation;
        $this->questionImage = $questionImage;
        $this->explanationImage = $explanationImage;
    }

    public function getQuestionID()
    {
        return $this->questionID;
    }

    public function getQuestion()
    {
        return $this->question;
    }

    public function getOption1()
    {
        return $this->option1;
    }

    public function getOption2()
    {
        return $this->option2;
    }

    public function getOption3()
    {
        return $this->option3;
    }

    public function getOption4()
    {
        return $this->option4;
    }

    public function getExplanation()
    {
        return $this->explanation;
    }

    public function getQuestionImage()
    {
        return $this->questionImage;
    }

    public function getExplanationImage()
    {
        return $this->explanationImage;
    }

    public function getTopic()
    {
        return $this->topic;
    }

    public function validateQuestionProperties($isNewQuestion = true)
    {
        $errorArray = array();
        if (!$isNewQuestion && !isset($this->questionID) && is_numeric($this->questionID)) {
            $errorArray["questionID"] = "QuestionID is invalid or missing!";
        }

        if (!isset($this->question) || empty($this->question)) {
            $errorArray["question"] = "Question cannot be blank!";
        }

        if (!isset($this->topic) || empty($this->topic)) {
            $errorArray["topic"] = "Question Topic cannot be blank!";
        }

/*
        if (!isset($this->option1) || empty($this->option1)) {
            $errorArray["option1"] = "Option 1 cannot be blank!";
        }

        if (!isset($this->option2) || empty($this->option2)) {
            $errorArray["option2"] = "Option 2 cannot be blank!";
        }

        if (!isset($this->option3) || empty($this->option3)) {
            $errorArray["option3"] = "Option 3 cannot be blank!";
        }

        if (!isset($this->option4) || empty($this->option4)) {
            $errorArray["option4"] = "Option 4 cannot be blank!";
        }

        if (!isset($this->explanation) || empty($this->explanation)) {
            $errorArray["explanation"] = "Explanation cannot be blank!";
        }
  */
        return $errorArray;
    }

    public function jsonSerialize()
    {
        return array(
            'topic' => $this->topic,
        'question'=> $this->question,
            'option1' => $this->option1,
            'option2' => $this->option2,
            'option3' => $this->option3,
            'option4' => $this->option4,
            'explanation' => $this->explanation,
            'questionImage' => $this->questionImage,
            'explanationImage' => $this->explanationImage

        );
    }
}