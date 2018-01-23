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
<div class="content" id="re_left">
    <div class="col-md-3 tbl-left" >
        <div id="reload_project">
            <ul class="list-group"  >
                <li class="list-group-item"><a href="/today">Today (<?=count($data['task'])?>)
                    </a></li>
                <li class="list-group-item"><a href="/sevenday">Nex 7 Day</a></li>
                <li class="list-group-item"><a href="/archive">Archive</a></li>
            </ul>
            <h3>Projects</h3>
            <ul class="list-group ">
                <? if($data['project']): ?>
                    <?foreach ($data['project'] as $key=> $val):?>
                        <li class="list-group-item " id="<?= $val['id']?>">
                            <? $_SESSION['cnt_single'] = 0;?>
                            <? foreach ($data['task'] as $v): ?>
                                <? if( $val['id'] == $v['project_id']): ?>
                                    <? $_SESSION['cnt_single']++;?>
                                <? endif;?>
                            <?endforeach;?>
                            <a  class="link_task link_cnt" id="<?= $val['id']?>">
                                <img  src="<?=$val['type']?>">
                                <?= $val['name_project']?>
                                (<?=$_SESSION['cnt_single']?>)
                            </a>
                        </li>
                    <?endforeach;?>
                <? endif;?>
            </ul>
        </div>
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
        <!--Dynamic template-->
        <div class="content-center" >
            <div class="col-md-9 tbl "  >
                <div style="width: 100%">
                    <p style="font-size: 24px;   margin: 20px; ">Today <span id="tday" style="font-size: 12px"></span></p>
                </div>
                <ul class="list-group">
                    <div id="reload_task">
                    <? if($data['task']): ?>
                        <?foreach ($data['task'] as $key=> $val):?>
                            <?foreach ($data['project'] as $k=> $v):?>
                                <?foreach ($data['priority'] as $p):?>
                                    <?if($val['project_id'] == $v['id']):?>
                                        <?if($val['priority_id'] == $p['id']):?>
                                            <li class="list-group-item">
                                                <a id="name_task">
                                                    <img name="<?=$p['id']?>" src="<?=$p['type']?>">
                                                    <?=$val['name_task']?>
                                                </a>
                                                <div style="float: right" class="dropdown">
                                                    <span><?=$v['name_project']?></span>
                                                    <img  src=<?=$v['type']?>>
                                                    <a data-toggle="dropdown" class="menu_li"><span id="menu"><img style="width: 10px" src="view/css/menu.png"></span></a>
                                                    <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                                        <li id="<?=$val['id']?>">Edit</li>
                                                        <li id="<?=$val['id']?>" >Delete</li>
                                                        <li id="<?=$val['id']?>">Done</li>
                                                    </ul>
                                                </div>
                                            </li>
                                        <? endif;?>
                                    <? endif;?>
                                <?endforeach;?>
                            <?endforeach;?>
                        <?endforeach;?>
                    <? endif;?>
                    </div>
                </ul>
                <div class="hide_form_task">
                    <form   method="post">
                        <div class="form-group form-inline">
                            <div class="col-md-12 inpt_task">
                                <input type="text" style="width: 80%" name="add_task" class="form-control">
                                <input type="text" style="width: 20%;  float: right" name="task_date" id="datepicker"  class="form-control" >
                                <input type = "hidden" name = "datepicker" >
                            </div>
                            <div class="btn-left">
                                <button style="float: left" type="submit" id="add_task" name="addTask" class="btn">Add</button>
                                <a style="float: left; margin-right: 5px" class="btn task_cancel">Cancel</a>
                            </div>
                            <div class="btn-right">
                                <img src="" class="type_project" data-toggle="modal" data-target="#modal_project">
                                <img src="" class="type_priority" data-toggle="modal" data-target="#modal_priority">
                                <input type="hidden" name="task_project">
                                <input type="hidden" name="task_priority">
                            </div>
                        </div>
                    </form>
                </div>
                <a class="add_task">Add Task +</a>
            </div>
        </div>
</div>
<?php require_once 'footer.php';?>
