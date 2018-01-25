<? if($data['task']): ?>
    <?foreach ($data['task'] as $key=> $val):?>
        <?foreach ($data['project'] as $k=> $v):?>
            <?foreach ($data['priority'] as $p):?>
                <?if($val['project_id'] == $v['id']):?>
                    <?if($val['priority_id'] == $p['id']):?>
                        <?if($val['date'] < date('d.m.Y') && $_REQUEST['uti'] != '/sevenday'):?>
                            <li class="list-group-item expired">
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
                <? endif;?>
            <?endforeach;?>
        <?endforeach;?>
    <?endforeach;?>
<? endif;?>