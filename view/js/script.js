function circle(color)
{
    var canvas = document.getElementById('circle');
    var obCanvas = canvas.getContext('2d');

    obCanvas.beginPath();
    obCanvas.arc(150, 75, 50, 0, 2*Math.PI, false);
    obCanvas.fillStyle = color;
    obCanvas.fill();
    obCanvas.lineWidth = 1;
    obCanvas.strokeStyle = color;
    obCanvas.stroke();

    var circle = canvas.toDataURL("image/png");

    return circle;
}

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

jQuery(document).ready(function ($) {
    $('body').append('<canvas style="width: 50px; display: none" id="canvas"></canvas>');
    $(function(){
       $('.content-center').css('height', $(window).height() + 'px');
        $(window).resize(function() {
            $('.content-center').css('height', $(window).height() + 'px');
        });
    });

   //var c = circle('green');
    var c = draw('rectangle', 'grey');
    console.log(c);

});