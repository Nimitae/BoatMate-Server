<?php include("templates/header.php"); ?>
    <div style="padding-top: 10px"></div>

    <div class="container">
        <?php $uploadQuestionState = $this->uploadQuestionModel->getUploadQuestionState();
        if (isset($uploadQuestionState)): ?>
            <div
                class="alert alert-<?php $uploadQuestionState == UPLOAD_CSV_SUCCESSFUL ? print "success" : print "warning"; ?> alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                <?php if ($uploadQuestionState == UPLOAD_CSV_SUCCESSFUL) : ?>
                    <p>QuestionCSV successfully uploaded!</p>
                <?php elseif ($uploadQuestionState == UPLOAD_CSV_FAILED) :
                    foreach ($this->uploadQuestionModel->getFileUploadErrors() as $error) : ?>
                    <p><?php print $error; ?></p>

                    <?php endforeach;
                endif; ?>

            </div>
        <?php endif; ?>
        <h3>Upload Question CSV</h3>

        <form enctype='multipart/form-data' method='post'>
            <div class="form-group">
                <input type="file" name="fileName">
            </div>
            <input type="submit" value="Upload" class="btn btn-success">
        </form>
    </div>



<?php include("templates/footer.php"); ?>