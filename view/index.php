<?require_once 'header.php';?>
<?php require_once 'modal_project.php';?>
<?php require_once 'modal_priority.php';?>
<section class="header" style="width: 100%">
    <nav class="navbar navbar-default container" role="navigation" style="width: 100%">
        <div class="container-fluid">
            <p class="navbar-text">TODO</p>
            <a class="btn btn-default navbar-text" style="float: right; width: 100px" href="/logout">Выход</a>
        </div>
    </nav>
</section>
<? require_once 'view/'.$content; ?>
<?php require_once 'footer.php';?>
