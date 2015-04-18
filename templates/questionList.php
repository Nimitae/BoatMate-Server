<?php include("templates/header.php"); ?>

<div style="padding-top: 10px"></div>
<div class="container">
    <?php
    $editQuestionState = $this->questionEditModel->getEditQuestionState();
    if (isset($editQuestionState)): ?>
        <div
            class="alert alert-<?php $editQuestionState == QUESTION_SAVED || $editQuestionState == QUESTION_DELETED ? print "success" : print "warning"; ?> alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <p>
                <?php if ($editQuestionState == QUESTION_SAVED) :
                    print "Question successfully edited!";
                elseif ($editQuestionState == QUESTION_NOT_FOUND) :
                    print "Question not found!";
                elseif ($editQuestionState == QUESTION_DELETED) :
                    print "Question was deleted successfully!";
                endif;
                ?>
            </p>
        </div>
    <?php endif; ?>

    <h3>Questions List</h3>
    <table class="table table-hover">
        <thead>
        <th style="width: 10%">Topic</th>
        <th style="width: 20%">Question</th>
        <th style="width: 10%">Option1</th>
        <th style="width: 10%">Option2</th>
        <th style="width: 10%">Option3</th>
        <th style="width: 10%">Option4</th>
        <th style="width: 20%">Explanation</th>
        <th style="width: 10%">QuestionImage</th>
        </thead>
        <tbody>
        <?php foreach ($this->questionEditModel->getQuestionsContainer() as $question) :
            /** @var Question $question */ ?>
            <tr onclick="window.location='?editQuestion=<?php print $question->getQuestionID(); ?>'">
                <td><?php print htmlspecialchars($question->getTopic()); ?></td>
                <td><?php print htmlspecialchars($question->getQuestion()); ?></td>
                <td><?php print htmlspecialchars($question->getOption1()); ?></td>
                <td><?php print htmlspecialchars($question->getOption2()); ?></td>
                <td><?php print htmlspecialchars($question->getOption3()); ?></td>
                <td><?php print htmlspecialchars($question->getOption4()); ?></td>
                <td><?php print htmlspecialchars($question->getExplanation()); ?></td>
                <td><?php print htmlspecialchars($question->getQuestionImage()); ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php include("templates/footer.php"); ?>
