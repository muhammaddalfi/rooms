$(document).ready(function () {
    $(document).ajaxSend(function () {
        $("#overlay").fadeIn(0);
    });
    $(document).ajaxComplete(function () {
        $("#overlay").fadeOut(0);
    });

});