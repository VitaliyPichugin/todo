<div class="modal fade " id="modal_project" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog vertical-align-center">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Закрыть</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Выбор проэкта</h4>
                </div>
                <div class="modal-body">
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary">Выбрать</button>
                </div>
            </div>
        </div>
    </div>
</div>