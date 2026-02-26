

// **=========== register check ============**
const main = {}

main.reg = () => {

    $(".error-msg").text("");
    $(".invaled").removeClass("invaled");


    if ($("#realname").val() == "") {
        $(".error-msg").text("نام کامل خود را بنویسید");
        $("#realname").addClass("invaled");
        return;
    }
    if ($("#r-username").val() == "") {
        $(".error-msg").text("نام کاربری خود را بنویسید");
        $("#r-username").addClass("invaled");
        return;
    }
    if ($("#email").val() == "") {
        $(".error-msg").text("ایمیل خود را بنویسید");
        $("#email").addClass("invaled");
        return;
    }
    if ($("#r-password").val() == "") {
        $(".error-msg").text("پسورد خود را بنویسید");
        $("#r-password").addClass("invaled");
        return;
    }
    if ($("#repassword").val() == "") {
        $(".error-msg").text("پسورد خود را برای تایید بنویسید");
        $("#re-password").addClass("invaled");
        return;
    }

    if ($("#r-password").val() != $("#repassword").val()) {
        $(".error-msg").text("تایید پسورد شباهت ندارد");
        $("#repassword").addClass("invaled");
        return;
    }

};

$(() => {
    $(".auth-btn").on('click', function () {
        main.reg();
    });
});

// **=========== login check ============**

main.log = () => {

    $(".error-msg").text("");
    $(".invaled").removeClass("invaled");

    if ($("#l-username").val() == "") {
        $(".error.msg").text("نام کاربری خود را بنویسید");
        $("#l-username").addClass("invaled");
        return;
    }
    if ($("#l-password").val() == "") {
        $(".error-msg").text("پسورد خود را بنویسید");
        $("#l-password").addClass("invaled");
    }
}

$(() => {
    $(".auth-btn").on('click', function () {
        main.log();
    });
});