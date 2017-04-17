<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">IMDterest</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <form class="navbar-form navbar-left">
                <div class="search-box">
                    <input type="text" class="form-control" placeholder="Search">
                    <div class="result"></div>
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
            <ul class="nav navbar-nav pull-right">

                <li>
                    <a href="upload.php"><span class="glyphicon glyphicon-plus-sign inverse" style="font-size: 20px;" aria-hidden="true"></span></a>
                </li>


                <div class="dropdown pull-right menu-dropdown">
                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                        <li></li><a href="profile.php">Bewerk je profiel</a></li>
                        <li></li><a href="user_uploads.php">Mijn uploads</a></li>
                        <li role="separator" class="divider"></li>
                       <li></li><a href="logout.php">Logout</a></li>
                    </ul>
                </div>

            </ul>
            
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
