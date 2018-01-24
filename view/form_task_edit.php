<div class="hide_form_task_edit">
    <form   method="post">
        <div class="form-group form-inline">
            <div class="col-md-12 inpt_task">
                <input type="text" style="width: 80%" name="edit_task" class="form-control">
                <input type="text" style="width: 20%;  float: right" name="task_date" readonly id="datepicker_edit"  class="form-control" >
                <input type = "hidden" name = "datepicker" >
            </div>
            <div class="btn-left">
                <button style="float: left" type="submit" id="edit_task" name="editTask" class="btn">Edit</button>
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