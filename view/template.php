<?require_once 'header.php';?>
<section class="header" style="width: 100%">
    <nav class="navbar navbar-default container" role="navigation" style="width: 100%">
        <div class="container-fluid">
            <p class="navbar-text">TODO</p>
            <a class="btn btn-default navbar-text" style="float: right; width: 100px" href="/logout">Выход</a>
        </div>
    </nav>
</section>
<div class="content">
    <div class="col-md-3 tbl-left" >
        <ul class="list-group"  >
            <li class="list-group-item"><a href="/today">Today</a></li>
            <li class="list-group-item"><a href="/sevenday">Nex 7 Day</a></li>
            <li class="list-group-item"><a href="/archive">Archive</a></li>
        </ul>
        <h3>Projects</h3>
        <ul class="list-group"  >
            <? if($data['project']): ?>
                <?foreach ($data['project'] as $key=> $val):?>
                    <li class="list-group-item list_project" id="<?= $val['id']?>">
                        <a >
                            <img  src="<?=$val['type']?>">
                            <?= $val['name_project']?>
                            (<?=$val['count_task']?>)
                        </a>
                    </li>
                <?endforeach;?>
            <? endif;?>
        </ul>
        <div class="hide_form_project">
            <form  action="" method="post">
                <div class="form-group form-inline input_form" >
                    <input id="color-picker" type="text" style="width: 20%; float: left;"  class="form-control" >
                    <input type="text" required style="width: 80%" name="add_project" class="form-control" id="task">
                    <input type="hidden" name="color" id="color_hex">
                </div>
                <button style="float: left; background-color: #2185a0" name="addProject" value="add_project" type="submit" class="btn">Add</button>
                <a style="float: left; margin-left: 5px" class="btn project_cancel">Cancel</a>
            </form>
        </div>
        <a class="add_project" >Add Project +</a>
    </div>
    <?php require_once 'modal_project.php';?>
    <?php require_once 'modal_priority.php';?>
    <?php require_once 'footer.php';?>
    <!--Dynamic template-->
   <? require_once 'view/'.$content; ?>
</div>

<div class="col-md-12 space-dialog"></div>
<div style="display: none" class="modal_priority modal-form">

</div>

