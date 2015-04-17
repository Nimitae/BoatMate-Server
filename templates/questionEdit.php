<?php include("templates/header.php"); ?>
    <div style="padding-top: 10px"></div>
    <div class="container">
        <?php
        $editQuestionState = $this->questionEditModel->getEditQuestionState();
        if ($editQuestionState == QUESTION_SAVE_FAILED): ?>
            <div
                class="alert alert-<?php $editQuestionState == QUESTION_SAVE_FAILED ? print "warning" : print ""; ?> alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?php
                $errorArray = $this->questionEditModel->getQuestionErrorArray();
                foreach ($errorArray as $error) : ?>
                    <p><?php print $error; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <h3>Edit Question</h3>

        <form class="form-horizontal" role="form" method="post">
            <input type="hidden" name="action" value="saveEditedQuestion">
            <input type="hidden" name="questionID"
                   value="<?php print $this->questionEditModel->getQuestionBeingEdited()->getQuestionID(); ?>">
            <div class="form-group form-group-sm">
                <label class="col-sm-1 control-label" for="question">Topic</label>

                <div class="col-sm-4">
                    <input id="question" type="text" name="topic"
                           value="<?php print $this->questionEditModel->getQuestionBeingEdited()->getTopic(); ?>"
                           class="form-control">
                </div>
            </div>

            <div class="form-group form-group-sm">
                <label class="col-sm-1 control-label" for="question">Question</label>

                <div class="col-sm-4">
                    <input id="question" type="text" name="question"
                           value="<?php print $this->questionEditModel->getQuestionBeingEdited()->getQuestion(); ?>"
                           class="form-control">
                </div>
            </div>

            <div class="form-group form-group-sm">
                <label class="col-sm-1 control-label" for="option1">Option 1</label>

                <div class="col-sm-4">
                    <input id="option1" type="text" name="option1"
                           value="<?php print $this->questionEditModel->getQuestionBeingEdited()->getOption1(); ?>"
                           class="form-control">
                </div>
            </div>

            <div class="form-group form-group-sm">
                <label class="col-sm-1 control-label" for="option2">Option 2</label>

                <div class="col-sm-4">
                    <input id="option2" type="text" name="option2"
                           value="<?php print $this->questionEditModel->getQuestionBeingEdited()->getOption2(); ?>"
                           class="form-control">
                </div>
            </div>

            <div class="form-group form-group-sm">
                <label class="col-sm-1 control-label" for="option3">Option 3</label>

                <div class="col-sm-4">
                    <input id="option3" type="text" name="option3"
                           value="<?php print $this->questionEditModel->getQuestionBeingEdited()->getOption3(); ?>"
                           class="form-control">
                </div>
            </div>

            <div class="form-group form-group-sm">
                <label class="col-sm-1 control-label" for="option4">Option 4</label>

                <div class="col-sm-4">
                    <input id="option4" type="text" name="option4"
                           value="<?php print $this->questionEditModel->getQuestionBeingEdited()->getOption4(); ?>"
                           class="form-control">
                </div>
            </div>

            <div class="form-group form-group-sm">
                <label class="col-sm-1 control-label" for="explanation">Explanation</label>

                <div class="col-sm-4">
                    <input id="explanation" type="text" name="explanation"
                           value="<?php print $this->questionEditModel->getQuestionBeingEdited()->getExplanation(); ?>"
                           class="form-control">
                </div>
            </div>

            <input type="submit" class="btn btn-sm btn-success" value="Save">

        </form>
    </div>
<?php include("templates/footer.php"); ?>