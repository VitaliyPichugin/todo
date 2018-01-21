
<!DOCTYPE html>
<html  lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TODO</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <link rel="stylesheet" href="http://todo2/css/style.css">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
    <section class="header" style="width: 100%">
        <nav class="navbar navbar-default container" role="navigation" style="width: 100%">
            <div class="container-fluid">
                <p class="navbar-text" >TODO</p>
                <a class="btn btn-default navbar-text" style="float: right; width: 100px" href="/auth/registration">Регистрация</a>
                <a class="btn btn-default navbar-text" style="float: right; width: 100px" href="/auth/login">Вход</a>
            </div>

        </nav>
    </section>

    <div class="form" style="margin: 10% 30%; height: 15%">
        <div style="text-align: center" class="content container modal-content sign">
            <? require_once 'view/'.$content ;?>
            <!--Dynamic content-->
        </div>
    </div><!-- form  -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="http://todo2/js/bootstrap-colorpicker.min.js"></script>
<link rel="stylesheet" media="screen" type="text/css" href="http://todo2/css/bootstrap-colorpicker.min.css" />
<script type="text/javascript" src="http://todo2/js/script.js"></script>
</body>
<footer>
</footer>
</html>
