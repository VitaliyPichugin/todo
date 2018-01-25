<div class="content" id="re_left">
    <div class="col-md-3 tbl-left" >
        <div id="reload_project" class="page_link">
            <ul class="list-group"  >
                <li class="list-group-item"><a href="/today">Today (<?=$data['ctnTd']?>)</a></li>
                <li class="list-group-item"><a href="/sevenday">Nex 7 Day (<?=$data['ctnSd']?>)</a></li>
                <li class="list-group-item"><a href="/archive">Archive (<?=$data['ctnAd']?>)</a></li>
            </ul>
            <a href="<?=$_REQUEST['uri']?>" style="font-size: 18px">Projects</a>
            <ul class="list-group ">
                <? if($data['project']): ?>
                    <?foreach ($data['project'] as $key=> $val):?>
                        <? $_SESSION['cnt_single'] = 0;?>
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
                            <div style="float: right" class="dropdown">
                                <span><?=$v['name_project']?>
                                <a data-toggle="dropdown" class="menu_li"><span id="menu"><img style="width: 10px" src="view/css/menu.png"></span></a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                    <li class="menu_edit_project" id="<?=$val['id']?>">Edit</li>
                                    <li class="menu_delete_project" id="<?=$val['id']?>" >Delete</li>
                                </ul>
                            </div>
                        </li>
                    <?endforeach;?>
                <? endif;?>
            </ul>
        </div>
        <? require_once 'form_project.php'?>
        <? require_once 'form_project_edit.php'?>
    </div>
    <div class="content-center" >
        <div class="col-md-9 tbl "  >
            <div style="width: 100%">
                <p style="font-size: 24px;   margin: 20px; "><?=$title?> <span id="tday" style="font-size: 12px"></span></p>
            </div>
            <div id="reload_task">
                <ul class="list-group">
                    <? require_once 'taskExpired.php'?>
                    <? require_once 'task.php'?>
                </ul>
            </div>
            <? require_once 'form_task.php'?>
            <? require_once 'form_task_edit.php'?>
        </div>
    </div>
</div>