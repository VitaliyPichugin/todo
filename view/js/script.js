jQuery(document).ready(function ($) {

    $(function(){
       $('.content-center').css('height', $(window).height() + 'px');
        $(window).resize(function() {
            $('.content-center').css('height', $(window).height() + 'px');
        });
    });
    $('#canvas').css({
        width: '500px',
        height: '500px'
    });


    $('.add_task').click(function () {
        $('.hide_form_task').css('display', 'block');
        $('.add_task').css('display', 'none');

        $('.type_priority').attr('src', draw('thunder', 'black'));
        $('.type_project').attr('src', draw('smile', 'black'));

    });

    $('.type_project').click(function () {
        $('.modal_project').css('display', 'block');

    });

    $('.add_project').click(function () {
        $('.hide_form_project').css('display', 'block');
        $('.add_project').css('display', 'none');

    });

    $('.project_cancel').click(function (e) {
       e.preventDefault();
        $('.hide_form_project').css('display', 'none');
        $('.add_project').css('display', 'block');
    });//task_cancel

    $('.task_cancel').click(function (e) {
        e.preventDefault();
        $('.hide_form_task').css('display', 'none');
        $('.add_task').css('display', 'block');
    });//task_cancel

    $('#login').click(function (e) {
        $('.hide_reg').css('display', 'none');
        $('.hide_login').css('display', 'block');
    });
    $('#registration').click(function () {
        $('.hide_reg').css('display', 'block');
        $('.hide_login').css('display', 'none');
    });

    $('#color-picker').iris({
        change: function (e, u) {
            $(this).css( 'background-color', u.color.toString());
            $('#color_hex').val(u.color.toString());
        }
    });
    $(document).click(function (e) {
        if (!$(e.target).is(".colour-picker, .iris-picker, .iris-picker-inner")) {
            $('#color-picker').iris('hide');
            return false;
        }
    });
    $('#color-picker').click(function () {
        $('#color-picker').iris('hide');
        $(this).iris('show');
        return false;
    });

});

function draw(figure, color) {
    var canvas ;
        switch (figure){
            case 'circle':
                jQuery('body').append('<canvas style="width: 40px;  display: none" id="canvas"></canvas>');
                 canvas = document.getElementById('canvas');
                 context = canvas.getContext('2d');
                context.beginPath();
                context.arc(150, 75, 50, 0, 2*Math.PI, false);
                context.fillStyle = color;
                context.fill();
                break;
            case 'rectangle':
                jQuery('body').append('<canvas style="width: 40px;  display: none" id="canvas"></canvas>');
                 canvas = document.getElementById('canvas');
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