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