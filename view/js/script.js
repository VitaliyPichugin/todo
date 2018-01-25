jQuery(document).ready(function ($) {
    hideFormTask();
    $('.content-center').css('height', $(window).height() + 'px');
    window.addEventListener('load', function () {
        $('.content-center').css('height', $(window).height() + 'px');

    });
    window.addEventListener('resize', function () {
        $('.content-center').css('height', $(window).height() + 'px');
    });


    $('#color-picker').colorpicker({
        format: 'hex'
    }).on('colorpickerChange colorpickerCreate', function (e) {
        e.color.tetrad().forEach(function () {
            $('#color-picker').css({
                backgroundColor: $('#color-picker').val(),
                color: $('#color-picker').val()
            });
            $('#color_hex').val($('#color-picker').val());

        });
    });

    var toDay = $.datepicker.formatDate("dd M", new Date());
    var toDayField = $.datepicker.formatDate("dd.mm.yy", new Date());
    $('[name = datepicker]').val(toDayField);
    $('#tday').html(toDay);

    window.addEventListener('click', function () {
        jQuery("#datepicker, #datepicker_edit").datepicker({
            altField: "[name = datepicker]",
            altFormat: "dd.mm.yy",
            dateFormat: 'dd M',
            constrainInput: true,
            /* minDate: 0*/
        });
    });

    $(document).on('click', 'body', function(e){
        $(this).find('.list_project_modal').click(function () {
            $('.list_project_modal').css('background-color', 'white').removeClass('selected_modal_project');
            $(this).css('background-color', 'grey').addClass('selected_modal_project');
            $('[name=task_project]').val($('.selected_modal_project').attr('id'));
        });
        $(this).find('.list_priority_modal').click(function () {
            $('.list_priority_modal').css('background-color', 'white').removeClass('selected_modal_priority');
            $(this).css('background-color', 'grey').addClass('selected_modal_priority');
            $('[name=task_priority]').val($('.selected_modal_priority').attr('id'));
        });
    });


    $('[name=addProject]').on('click',function (e) {
        e.preventDefault();
        var color = $('#color_hex').val();
        var src = draw('circle', color);
        if ($('[name=add_project]').val() != '') {
            $.ajax({
                method: 'POST',
                url: 'index.php',
                data: {
                    addProject: 'send',
                    add_project: $('[name=add_project]').val(),
                    type: src
                },
                success: function (html) {
                    var doom = '<html>' + html;
                    var res_task = $(doom).find('#reload_task');
                    $('#reload_task').html(res_task);

                    var res_modal = $(doom).find('#reload_modal');
                    $('#reload_modal').html(res_modal);

                    var res_proj = $(doom).find('#reload_project');
                    $('#reload_project').html(res_proj);
                    clear();//reload_modal
                },
                error: function (e) {
                    console.log(e)
                }
            });
        } else {
            $('[name=add_task]').css('border-color', 'red');
        }
    });
    $('[name=addTask]').on('click', function (e) {
        e.preventDefault();
        if ($('[name=add_task]').val() != '' && $('[name=task_project]').val() != '' && $('[name=task_prioriry]').val() != '') {
            $.ajax({
                method: 'POST',
                url: 'index.php',
                data: {
                    addTask: 'send',
                    add_task: $('[name=add_task]').val(),
                    priority_id: $('[name=task_priority]').val(),
                    project_id: $('[name=task_project]').val(),
                    date: $('[name = datepicker]').val(),
                    status: $('[name="status"]:checked').parent('p').text()
                },
                success: function (html) {
                    var doom = '<html>' + html;
                    var res_task = $(doom).find('#reload_task');
                    $('#reload_task').html(res_task);

                    var res_proj = $(doom).find('#reload_project');
                    $('#reload_project').html(res_proj);
                    clear();
                },
                error: function (e) {
                    console.log(e)
                }
            });
        } else {
            alert('selected not all');
        }
    });

    $('body').on('mouseover', '.list-group-item', function(e){
        $(this).find('.menu_li').each(function () {
            $(this).css('display', 'inline');
        });
    });
    $('body').on('mouseout', '.list-group-item', function(e){
        $(this).find('.menu_li').each(function () {
            $(this).css('display', 'none');
        });
    });

    $('.link_task').each(function () {  //todo
        $('body').on('click', '.link_task', function(e){
            var self = $(this);
            $.ajax({
                method: 'GET',
                url: 'index.php',
                data: {
                    id: self.attr('id')
                },
                success: function (html) {
                    var doom = '<html>' + html;
                    var res = $(doom).find('#reload_task');
                    $('#reload_task').html(res);
                    $('.content-center').css('height', $(window).height() + 'px');
                    $('.list-group-item ').css('background-color', 'white');
                    self.parents('li').css('background-color', 'grey');
                    $('.expired').css('background-color',  '#ff5c52');
                },
                error: function (e) {
                    console.log(e)
                }
            });
        });
    });

    //todo сократить код
    $('body').on('click', '.list-group-item', function(e){
        $(this).find('.menu_delete').each(function () {
            $(this).click(function () {
                $.ajax({
                    method: 'POST',
                    url: 'index.php',
                    data: {
                        del_id: $(this).attr('id')
                    },
                    success: function (html) {
                        var doom = '<html>' + html;
                        var res_task = $(doom).find('#reload_task');
                        $('#reload_task').html(res_task);

                        var res_proj = $(doom).find('#reload_project');
                        $('#reload_project').html(res_proj);
                    },
                    error: function (e) {
                        console.log(e)
                    }
                });
            });
        });
        $(this).find('.menu_delete_project').each(function () {
            $(this).click(function () {
                $.ajax({
                    method: 'POST',
                    url: 'index.php',
                    data: {
                        del_id_project: $(this).attr('id')
                    },
                    success: function (html) {
                        var doom = '<html>' + html;
                        var res_task = $(doom).find('#reload_task');
                        $('#reload_task').html(res_task);

                        var res_proj = $(doom).find('#reload_project');
                        $('#reload_project').html(res_proj);
                    },
                    error: function (e) {
                        console.log(e)
                    }
                });
            });
        });

        $(this).find('.menu_edit_project').each(function () {
            $(this).click(function (e) {
                $('#color-picker_edit').colorpicker({
                    format: 'hex'
                }).on('colorpickerChange colorpickerCreate', function (e) {
                    e.color.tetrad().forEach(function () {
                        $('#color-picker_edit').css({
                            backgroundColor: $('#color-picker_edit').val(),
                            color: $('#color-picker_edit').val()
                        });
                        $('#color_hex_edit').val($('#color-picker_edit').val());

                    });
                });
                $('.hide_form_project_edit').css('display', 'block');
                $('.hide_form_project').css('display', 'none');
                $('.menu_edit_project').parents('li').css('background-color', 'white');
                $(this).parents('li').css('background-color', '#ddb004');
                var project_id = $(this).attr('id');
                //var type = draw('circle',$('#color_hex_edit').val());
                //$('#editProject').click(function (e) {
                $(document).on('click', '#editProject', function(e){
                    e.preventDefault();
                    if ($('[name=editProject]').val() != '') {
                        $.ajax({
                            method: 'POST',
                            url: 'index.php',
                            data: {
                                send: 'project_edit_menu',
                                edit_id_project: project_id,
                                type: draw('circle',$('#color_hex_edit').val()),
                                edit_project: $('[name=edit_project]').val()
                            },
                            success: function (html) {
                                var doom = '<html>' + html;
                                var res_proj = $(doom).find('#reload_project');
                                $('#reload_project').html(res_proj);
                                $('.hide_form_project_edit').css('display', 'none');
                            },
                            error: function (e) {
                                alert('err');
                                console.log(e)
                            }
                        });
                    }else {
                        alert('selected not all');
                    }
                });
            });
        });
        $(this).find('.menu_done').each(function () {
            $(this).click(function () {
                $.ajax({
                    method: 'POST',
                    url: 'index.php',
                    data: {
                        done_id: $(this).attr('id')
                    },
                    success: function (html) {
                        var doom = '<html>' + html;
                        var res_task = $(doom).find('#reload_task');
                        $('#reload_task').html(res_task);

                        var res_proj = $(doom).find('#reload_project');
                        $('#reload_project').html(res_proj);
                    },
                    error: function (e) {
                        console.log(e)
                    }
                });
            });
        });
        $(this).find('.menu_edit').each(function () {
            $(this).click(function (e) {
                $('.hide_form_task').css('display', 'none');
                $('.hide_form_task_edit').css('display', 'block');
                $('.type_project').attr('src', draw('smile', '#ffe28a'));
                $('.type_priority').attr('src', draw('thunder', '#ffe28a'));
                $('.menu_edit').parents('li').css('background-color', 'white');
                $('.expired').css('background-color',  '#ff5c52');
                $(this).parents('li').css('background-color', '#ddb004');
                var edit_id = $(this).attr('id');
                $('#edit_task').click(function (e) {
                    e.preventDefault();
                    if ($('[name=edit_task]').val() != '' && $('[name=task_project]').val() != '' &&
                        $('[name=task_prioriry]').val() != '') {
                        $.ajax({
                            method: 'POST',
                            url: 'index.php',
                            data: {
                                send: 'task_edit',
                                edit_id: edit_id,
                                edit_task: $('[name=edit_task]').val(),
                                priority_id: $('[name=task_priority]').val(),
                                project_id: $('[name=task_project]').val(),
                                date: $('[name = datepicker]').val(),
                                status: $('[name="status"]:checked').parent('p').text()
                            },
                            success: function (html) {
                                alert('ok');
                                var doom = '<html>' + html;
                                var res_task = $(doom).find('#reload_task');
                                $('#reload_task').html(res_task);

                                var res_proj = $(doom).find('#reload_project');
                                $('#reload_project').html(res_proj);
                                $('.hide_form_project_edit, .hide_form_task_edit').css('display', 'none');
                                clear();
                            },
                            error: function (e) {
                                console.log(e)
                            }
                        });
                    }else {
                        alert('selected not all');
                    }
                });
            });
        });
    });
});

function draw(figure, color) {
    var canvas ;
    switch (figure){
        case 'circle':
            jQuery('body').append('<canvas style="width: 40px;  display: none" id="canvas_circle"></canvas>');
            canvas = document.getElementById('canvas_circle');
            context = canvas.getContext('2d');
            context.beginPath();
            context.arc(150, 75, 50, 0, 2*Math.PI, false);
            context.fillStyle = color;
            context.fill();
            break;
        case 'rectangle':
            jQuery('body').append('<canvas style="width: 40px;  display: none" id="canvas_rect"></canvas>');
            canvas = document.getElementById('canvas_rect');
            context = canvas.getContext('2d');
            context.rect(120,25,100,100);
            context.fillStyle = color;
            context.fill();
            break;
        case 'thunder':
            jQuery('body').append('<canvas style="width: 40px;  display: none" id="canvas_th"></canvas>');
            canvas = document.getElementById('canvas_th');
            var context = canvas.getContext('2d');
            //todo
            context.lineWidth = 10;
            var obj ={
                line1: {
                    moveTo: {x:177, y: 122},
                    lineTo: {x: 222, y: 186}
                },
                line2: {
                    moveTo: {x:222, y:186},
                    lineTo: {x:178, y:173}
                },
                line3: {
                    moveTo: {x:178, y:173},
                    lineTo: {x:232, y:230}
                },
                line4: {
                    moveTo: {x:232, y:230},
                    lineTo: {x:192, y:211}
                },
                line5: {
                    moveTo: {x:192, y:211},
                    lineTo: {x:255, y:269}
                },
                line6: {
                    moveTo: {x:255, y:269},
                    lineTo: {x:242, y:223}
                },
                line7: {
                    moveTo: {x:242, y:223},
                    lineTo: {x:211, y:192}

                },
                line8: {
                    moveTo: {x:211, y:192},
                    lineTo: {x:266, y:213}

                },
                line9: {
                    moveTo: {x:266, y:213},
                    lineTo: {x:178, y:122}
                }
            };
            for(var line in obj){
                context.strokeStyle = color;
                context.beginPath();
                context.moveTo(obj[line].moveTo.x-70, obj[line].moveTo.y-120);
                context.lineTo(obj[line].lineTo.x-70, obj[line].lineTo.y-120);
                context.stroke();
                context.closePath();
            }
            break;
        case 'smile':{
            jQuery('body').append('<canvas style="width: 40px;  display: none" id="canvas_smile"></canvas>');
            canvas = document.getElementById('canvas_smile');
            var context = canvas.getContext('2d');
            context.lineWidth = 10;
            context.strokeStyle  = color;
            context.beginPath();
            context.arc(75,75,50,0,Math.PI*2,true);
            context.moveTo(110,75);
            context.arc(75,75,35,0,Math.PI,false);
            context.moveTo(65,65);
            context.arc(60,65,5,0,Math.PI*2,true);
            context.moveTo(95,65);
            context.arc(90,65,5,0,Math.PI*2,true);
            context.stroke();
            break;
        }
    }
    return canvas.toDataURL("image/png");

}

function hideFormTask() {
    $('.content').on('click', '.add_task', function () {
        $('.hide_form_task').css('display', 'block');
        $('.hide_form_task_edit').css('display', 'none');
        $('.add_task').css('display', 'none');

        $('.type_project').attr('src', draw('smile', 'black'));
        $('.type_priority').attr('src', draw('thunder', 'black'));

    });

    $('.content').on('click', '.type_project', function () {
        $('.modal_project').css('display', 'block');

    });

    $('.content').on('click', '.add_project', function () {
        $('.hide_form_project').css('display', 'block');
        $('.hide_form_project_edit').css('display', 'none');
        $('.add_project').css('display', 'none');

    });

    $('.content').on('click', '.project_cancel', function () {
        $('.hide_form_project').css('display', 'none');
        $('.hide_form_project_edit').css('display', 'none');
        $('.add_project').css('display', 'block');

    });


    $('.content').on('click', '.task_cancel', function () {
        $('.hide_form_task_edit').css('display', 'none');
        $('.hide_form_task').css('display', 'none');
        $('.add_task').css('display', 'block');

    });
}

function clear() {
    $('input').val('');

}