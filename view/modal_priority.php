<div class="modal fade " id="modal_priority" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog vertical-align-center " >
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Закрыть</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Выбор состаяния</h4>
                </div>
                    <div class="modal-body">
                        <ul class="list-group li-modal"  >
                            <? if($data['priority']): ?>
                                <?foreach ($data['priority'] as $key=> $val):?>
                                    <li class="list-group-item list_priority_modal li-modal" id="<?=$val['id']?>">
                                        <p >
                                            <img  src="<?=$val['type']?>"><a ><?= $val['name']?></a>
                                        </p>
                                    </li>
                                <?endforeach;?>
                            <? endif;?>
                        </ul>
                        <p class="notDone" style="width: inherit">Not done <input id="notDone" name="status" checked type="radio"></p>
                        <p class="done" style="width: inherit">Done <input id="done" name="status" type="radio"></p>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary add_type_priority" data-dismiss="modal">Выбрать</button>
                </div>
            </div>
        </div>
    </div>
</div>