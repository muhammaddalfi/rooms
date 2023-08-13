$(document).ready(function () {
    $(document).ajaxSend(function () {
        $("#overlay").fadeIn(300);
    });
    $(document).ajaxComplete(function () {
        $("#overlay").fadeOut(300);
    });

});