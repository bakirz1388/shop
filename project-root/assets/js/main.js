$(document).ready(function () {

    $(".main-nav a").hover(function () {
        $(this).css("letter-spacing", "1px");
    }, function () {
        $(this).css("letter-spacing", "0px");
    });

});

$(document).ready(function () {

    $(".tab-btn").click(function () {

        var tab = $(this).data("tab");

        $(".tab-btn").removeClass("active");
        $(this).addClass("active");

        $(".auth-form").removeClass("active");
        $("#" + tab).addClass("active");

    });

});