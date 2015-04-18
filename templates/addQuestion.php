<?php include("templates/header.php"); ?>
    <div style="padding-top: 10px"></div>
    <div class="container">
        <?php
        $addQuestionState = $this->addQuestionModel->getAddQuestionState();
        if ($addQuestionState != 0): ?>
            <div
                class="alert alert-<?php $addQuestionState == QUESTION_ADD_FAILED ? print "warning" : print "success"; ?> alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?php if ($addQuestionState == QUESTION_ADD_FAILED) :
                    $errorArray = $this->addQuestionModel->getAddQuestionErrorArray();
                    foreach ($errorArray as $error) : ?>
                        <p><?php print $error; ?></p>
                    <?php endforeach;
                else :?>
                    <p>Successfully added question!</p>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <h3>Add New Question</h3>

        <form class="form-horizontal" role="form" method="post">
            <input type="hidden" name="action" value="addNewQuestion">

            <div class="form-group form-group-sm">
                <label class="col-sm-1 control-label" for="question">Topic</label>

                <div class="col-sm-4">
                    <input id="question" type="text" name="topic"
                           value="<?php $addQuestionState == QUESTION_ADD_FAILED ? print $this->addQuestionModel->getQuestionBeingAdded()->getTopic() : print "" ; ?>"
                           class="form-control">
                </div>
            </div>
            <div class="form-group form-group-sm">
                <label class="col-sm-1 control-label" for="question">Question</label>

                <div class="col-sm-4">
                    <input id="question" type="text" name="question"
                           value="<?php $addQuestionState == QUESTION_ADD_FAILED ? print $this->addQuestionModel->getQuestionBeingAdded()->getQuestion() : print "" ; ?>"
                           class="form-control">
                </div>
            </div>

            <div class="form-group form-group-sm">
                <label class="col-sm-1 control-label" for="option1">Option 1</label>

                <div class="col-sm-4">
                    <input id="option1" type="text" name="option1"
                           value="<?php $addQuestionState == QUESTION_ADD_FAILED ? print $this->addQuestionModel->getQuestionBeingAdded()->getOption1() : print "" ; ?>"
                           class="form-control">
                </div>
            </div>

            <div class="form-group form-group-sm">
                <label class="col-sm-1 control-label" for="option2">Option 2</label>

                <div class="col-sm-4">
                    <input id="option2" type="text" name="option2"
                           value="<?php $addQuestionState == QUESTION_ADD_FAILED ? print $this->addQuestionModel->getQuestionBeingAdded()->getOption2() : print "" ; ?>"
                           class="form-control">
                </div>
            </div>

            <div class="form-group form-group-sm">
                <label class="col-sm-1 control-label" for="option3">Option 3</label>

                <div class="col-sm-4">
                    <input id="option3" type="text" name="option3"
                           value="<?php $addQuestionState == QUESTION_ADD_FAILED ? print $this->addQuestionModel->getQuestionBeingAdded()->getOption3() : print "" ; ?>"
                           class="form-control">
                </div>
            </div>

            <div class="form-group form-group-sm">
                <label class="col-sm-1 control-label" for="option4">Option 4</label>

                <div class="col-sm-4">
                    <input id="option4" type="text" name="option4"
                           value="<?php $addQuestionState == QUESTION_ADD_FAILED ? print $this->addQuestionModel->getQuestionBeingAdded()->getOption4() : print "" ; ?>"
                           class="form-control">
                </div>
            </div>

            <div class="form-group form-group-sm">
                <label class="col-sm-1 control-label" for="explanation">Explanation</label>

                <div class="col-sm-4">
                    <input id="explanation" type="text" name="explanation"
                           value="<?php $addQuestionState == QUESTION_ADD_FAILED ? print $this->addQuestionModel->getQuestionBeingAdded()->getExplanation() : print "" ; ?>"
                           class="form-control">
                </div>
            </div>

            <input type="submit" class="btn btn-sm btn-success" value="Add New Question">
        </form>
    </div>
<?php include("templates/footer.php"); ?>