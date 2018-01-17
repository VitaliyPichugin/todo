<!DOCTYPE html>
<html  lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=$title?></title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body id="body">

<section class="header" style="width: 100%">
    <nav class="navbar navbar-default container" role="navigation" style="width: 100%">
        <div class="container-fluid">
            <?php if($_SESSION['email'] && $_SESSION['pass'] && !$_SESSION['login_error']): ?>
                <p class="navbar-text">Ваша почта <span class="user"><?=$_SESSION['email']?></span></p>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <form class="navbar-form navbar-right" role="search" method="post">
                        <input type="submit" class="btn btn-default" name="logout" value="Выйти">
                    </form>
                </div>
            <?php endif; ?>

            <?php if(!$_SESSION['email'] && !$_SESSION['pass']): ?>
                <p class="navbar-text" >JOBS</p>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <form class="navbar-form navbar-right" role="search" method="post">
                        <div class="form-group">
                            <a class="form-control">Sign in</a> or <a class="form-control">Sign up</a>
                            <!--<input type="email" class="form-control" required="required" name="email" placeholder="E-mail">
                            <input type="password" class="form-control" name="pass" placeholder="Password" required="required">-->
                        </div>

                    </form>
                </div>
            <?php endif; ?>
            <?php if($_SESSION['login_error'] && $_SESSION['email']): ?>
                <p class="navbar-text">Был введен неверный пароль от почты - <span class="user"><?=$_SESSION['email']?></span></p>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <form class="navbar-form navbar-right" role="search" method="post">
                        <input type="submit" class="btn btn-default" name="logout" value="Попробовать снова">
                    </form>
                </div>
            <?php endif; ?>
        </div>
        <!-- /.container-fluid -->
    </nav>
</section>
<section class="content container modal-content con">
    <div align="center">
    <div class=" col-md-3 tbl_left" >
        <div  class="modal-form " style="display: none">

        </div>
        <ul class="list-group">
            <li class="list-group-item"><a href="index.php">ToDay</a></li>
            <li class="list-group-item"><a href="index.php">7 Day</a></li>
        </ul>
    </div>

    <div class="col-md-9 tbl text-center " align="center" style="background-color: blanchedalmond" >
        <ul class="list-group" >
        <li class="list-group-item"><a href="index.php">Task</a></li>
        <li class="list-group-item"><a href="index.php">7 Task</a></li>
        <li class="list-group-item"><a href="index.php">Task</a></li>
        <li class="list-group-item"><a href="index.php">7 Task</a></li>
        <li class="list-group-item"><a href="index.php">Task</a></li>
        <li class="list-group-item"><a href="index.php">7 Task</a></li>
        </ul>
    </div>
    </div>
</section>

</body>
</html>