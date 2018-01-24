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
                                <? endif;?>
                            <?endforeach;?>
                            <a  class="link_task link_cnt" id="<?= $val['id']?>">
                                <img  src="<?=$val['type']?>">
                                <?= $val['name_project']?>
                            </a>
                        </li>
                    <?endforeach;?>
                <? endif;?>
            </ul>
        </div>
        <? require_once 'form_project.php'?>
    </div>
    <!--Dynamic template-->
    <div class="content-center" >
        <div class="col-md-9 tbl "  >
            <div style="width: 100%">
                <p style="font-size: 24px;   margin: 20px; "><?=$title?> <span id="tday" style="font-size: 12px"></span></p>
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
                                                    <span class="name_task"><?=$val['name_task']?></span>
                                                    <? if($val['status'] == 'Not done'): ?>
                                                        <span style="color: darkgoldenrod">(<?=$val['status']?>)</span>
                                                    <?else:?>
                                                        <span style="color: green">(<?=$val['status']?>)</span>
                                                    <? endif;?>
                                                </a>
                                                <div style="float: right" class="dropdown">
                                                    <span><?=$v['name_project']?></span>
                                                    <img  src=<?=$v['type']?>>
                                                    <a data-toggle="dropdown" class="menu_li"><span id="menu"><img style="width: 10px" src="view/css/menu.png"></span></a>
                                                    <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                                        <li class="menu_edit" id="<?=$val['id']?>">Edit</li>
                                                        <li class="menu_delete" id="<?=$val['id']?>" >Delete</li>
                                                        <li class="menu_done" id="<?=$val['id']?>">Done</li>
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
            <? require_once 'form_task.php'?>
        </div>
    </div>
</div>