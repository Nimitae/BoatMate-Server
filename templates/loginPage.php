<?php include("templates/header.php"); ?>

    <div style="padding-top: 10px"></div>

    <div class="container">
        <div class="col-sm-2">
            <h3>Sign In</h3>
            <br>
            <?php
            $loginState = $this->userModel->getLoginState();
            if ($loginState == LOGIN_UNSUCCESSFUL) :
                print "Error logging in. Either your username or password is wrong!";
            endif; ?>
            <form action="login.php" method="post">
                <input type="hidden" name="action" value="loginUser">
                <input type="text" name="username" class="form-control" placeholder="Username">
                <br>
                <input type="text" name="password" class="form-control" placeholder="Password">
                <br>
                <input type="submit" class="btn btn-success btn-sm">
            </form>
        </div>
    </div>

<?php include("templates/footer.php"); ?>