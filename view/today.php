<div class="content-center" >
    <div class="col-md-9 tbl "  >
        <div style="width: 100%">
            <p style="font-size: 24px;   margin: 20px; ">Today <span id="tday" style="font-size: 12px"></span></p>
        </div>
            <ul class="list-group">
            <? if($data['task']): ?>
                <?foreach ($data['task'] as $key=> $val):?>
                    <?foreach ($data['project'] as $k=> $v):?>
                        <?foreach ($data['priority'] as $p):?>
                            <?if($val['project_id'] == $v['id']):?>
                                <?if($val['priority_id'] == $p['id']):?>

                                 <li class="list-group-item">
                                     <a href="index.php">
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
                        <button style="float: left" type="submit" name="addTask" class="btn">Add</button>
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