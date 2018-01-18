jQuery(document).ready(function ($) {
    $('body').append('<canvas style="width: 50px; display: none" id="canvas"></canvas>');
    $(function(){
       $('.content-center').css('height', $(window).height() + 'px');
        $(window).resize(function() {
            $('.content-center').css('height', $(window).height() + 'px');
        });
    });
    var c = draw('rectangle', 'grey');

    $('.add_task').click(function () {
        $('.hide_form_task').css('display', 'block');
        $('.add_task').css('display', 'none');
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

});

function draw(figure, color) {
    var canvas = document.getElementById('canvas');
    if (canvas.getContext){
        var obCanvas = canvas.getContext('2d');
        var circle;
        switch (figure){
            case 'circle':
                obCanvas.beginPath();
                obCanvas.arc(150, 75, 50, 0, 2*Math.PI, false);
                obCanvas.fillStyle = color;
                obCanvas.fill();
                break;
            case 'rectangle':
                obCanvas.rect(120,25,100,100);
                obCanvas.fillStyle = color;
                obCanvas.fill();
                break;
        }
        circle = canvas.toDataURL("image/png");
        return circle;
    }
}