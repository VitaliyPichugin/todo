<div class="content" id="re_left">
    <div class="col-md-3 tbl-left" >
        <div id="reload_project">
            <ul class="list-group"  >
                <li class="list-group-item"><a href="/today">Today (<?=$data['ctnTd']?>)</a></li>
                <li class="list-group-item"><a href="/sevenday">Nex 7 Day (<?=$data['ctnSd']?>)</a></li>
                <li class="list-group-item"><a href="/archive">Archive (<?=$data['ctnAd']?>)</a></li>
            </ul>
        </div>
    </div>
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
                                            </li>
                                        <? endif;?>
                                    <? endif;?>
                                <?endforeach;?>
                            <?endforeach;?>
                        <?endforeach;?>
                    <? endif;?>
                </div>
            </ul>
        </div>
    </div>
</div>