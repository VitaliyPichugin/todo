<div class="modal fade " id="modal_project" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog vertical-align-center " >
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Закрыть</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Выбор проэкта</h4>
                </div>
                <div class="modal-body">
                    <ul class="list-group "  >
                        <? if($data['project']): ?>
                            <?foreach ($data['project'] as $key=> $val):?>
                                <li class="list-group-item list_project_modal li-modal" id="<?= $val['id']?>">
                                    <? $_SESSION['cnt_single'] = 0;?>
                                    <? foreach ($data['task'] as $v): ?>
                                        <? if( $val['id'] == $v['project_id']): ?>
                                            <? $_SESSION['cnt_single']++;?>
                                        <? endif;?>
                                    <?endforeach;?>
                                    <a >
                                        <img  src="<?=$val['type']?>">
                                        <?= $val['name_project']?>
                                        (<?=$_SESSION['cnt_single']?>)
                                    </a>
                                </li>
                            <?endforeach;?>
                        <? endif;?>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default " data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary add_type_project" data-dismiss="modal">Выбрать</button>
                </div>
            </div>
        </div>
    </div>
</div>