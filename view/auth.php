<?php require_once 'header.php';?>
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
    </div>
<?php require_once 'footer.php';?>
