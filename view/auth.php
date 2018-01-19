<?php require_once 'header.php';?>
    <section class="header" style="width: 100%">
        <nav class="navbar navbar-default container" role="navigation" style="width: 100%">
            <div class="container-fluid">
                <p class="navbar-text" >JOBS</p>
            </div>
        </nav>
    </section>

    <div class="form" style="margin: 10% 30%; height: 15%">
        <div style="text-align: center" class="content container modal-content sign">
            <h1>Регистрация/Вход</h1>
            <input type="button" id="registration"  value="Регистрация">
            <input type="button" id="login" value="Вход">

        </div>
            <? require_once 'registration.php'?>
        <? require_once 'login.php'?>

    </div><!-- form  -->

<?php require_once 'footer.php';?>