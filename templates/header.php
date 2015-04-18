<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="assets/js/bootstrap.js"></script>
<link href="assets/css/bootstrap.css" rel="stylesheet">

<div id="wrap">
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Boatmate</a>
            </div>
            <div class="navbar-collapse collapse navbar-right">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            Manage<b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="questions.php">Questions</a></li>
                            <li><a href="addquestion.php">Add Question</a></li>
                            <li><a href="upload.php">Upload CSV</a></li>
                        </ul>
                    </li>
                    <?php if (isset($_SESSION['username'])): ?>
                        <li class="dropdown">
                            <p class="navbar-text">Logged in as <?php print $_SESSION['username']; ?></p>
                        </li>
                        <li class="dropdown">
                            <p class="navbar-text"><a href="logout.php">Logout</a></p>
                        </li>
                    <?php else : ?>
                    <li class="dropdown">
                        <a href="login.php">Login</a>
                    </li>

                    <?php endif; ?>
                    <?php /*if (!isset($_SESSION["userID"])): ?>
                        <form class="navbar-form navbar-left" action="home.php?action=login" method="post"
                              role="Sign In">
                            <div class="form-group">
                                <input name="name" id="name" type="text" class="form-control"
                                       placeholder="Username">
                                <input name="password" id="password" type="password" class="form-control"
                                       placeholder="Password">
                            </div>
                            <button type="submit" class="btn btn-success">Sign In</button>
                        </form>
                    <?php else: ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <span class="glyphicon glyphicon-cog"></span><b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="settings.php"><span class="glyphicon glyphicon-cog"></span> Settings</a>
                                </li>
                                <li><a href="home.php?action=logout"><span class="glyphicon glyphicon-off"></span> Sign
                                        Out</a></li>
                            </ul>
                        </li>
                    <?php endif; */ ?>
                </ul>
            </div>
        </div>
    </div>
    <div style="height: 50px;"></div>
</div>