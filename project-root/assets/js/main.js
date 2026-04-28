

// **=========== register check ============**
const main = {};

main.post = (action, data, func) => {
    $.ajax({
        url: "api/" + action,
        type: "POST",
        contentType: "application/json",
        data: JSON.stringify(data),
        dataType: "json",
        success: res => {
            func(res);
        }
    });
}



main.register = () => {

    $(".error-msg").text("");
    $(".invalid").removeClass("invalid");


    if ($("#realname").val() == "") {
        $(".error-msg").text("نام کامل خود را بنویسید");
        $("#realname").addClass("invalid");
        return;
    };
    if ($("#r-username").val() == "") {
        $(".error-msg").text("نام کاربری خود را بنویسید");
        $("#r-username").addClass("invalid");
        return;
    };
    if ($("#email").val() == "") {
        $(".error-msg").text("ایمیل خود را بنویسید");
        $("#email").addClass("invalid");
        return;
    };

    let emailSplit = ($("#email").val()).split("@");
    if (emailSplit.length != 2) {
        $(".error-msg").text("ایمیل شما صحیح نمیباشد");
        $("#email").addClass("invalid");
        return;
    };

    if (emailSplit[1].split('.').length != 2) {
        $(".error-msg").text("ایمیل شما صحیح نمیباشد");
        $("#email").addClass("invalid");
        return;
    };

    if (emailSplit[1].split('.')[0].length < 3) {
        $(".error-msg").text("ایمیل شما صحیح نمیباشد");
        $("#email").addClass("invalid");
        return;
    };

    if (emailSplit[1].split('.')[1].length < 2) {
        $(".error-msg").text("ایمیل شما صحیح نمیباشد");
        $("#email").addClass("invalid");
        return;
    };

    if ($("#r-password").val() == "") {
        $(".error-msg").text("پسورد خود را بنویسید");
        $("#r-password").addClass("invalid");
        return;
    };
    if ($("#repassword").val() == "") {
        $(".error-msg").text("پسورد خود را برای تایید بنویسید");
        $("#re-password").addClass("invalid");
        return;
    };

    if ($("#r-password").val() != $("#repassword").val()) {
        $(".error-msg").text("تایید پسورد شباهت ندارد");
        $("#repassword").addClass("invalid");
        return;
    };

    let data = {
        realname: $("#realname").val(),
        username: $("#r-username").val(),
        email: $("#email").val(),
        password: $("#r-password").val(),
        role: 0
    }

    main.post('register_action.php', data, res => {
        if (res.code == 500) {
            $("#r-username").addClass("invalid");
            $(".error-msg").text("این نام کاربری تکراری است");
            return;
        }
        if (res.code == 501) {
            $(".error-msg").text("An error occured while registering!");
            return;
        }
        if (res.code == 400) {
            location.href = 'login.php';
        }
    })

};

// **=========== login check ============**

main.login = () => {

    $(".error-msg").text("");
    $(".invalid").removeClass("invalid");

    if ($("#l-username").val() == "") {
        $(".error-msg").text("نام کاربری خود را بنویسید");
        $("#l-username").addClass("invalid");
        return;
    };
    if ($("#l-password").val() == "") {
        $(".error-msg").text("پسورد خود را بنویسید");
        $("#l-password").addClass("invalid");
        return;
    };

    let LoginData = {
        username: $("#l-username").val(),
        password: $("#l-password").val(),
    }

    main.post('login_action.php', LoginData, res => {
        if (res.code == 502) {
            $("#l-username").addClass("invalid");
            $("#l-password").addClass("invalid");
            $(".error-msg").text("نام کاربری یا پسورد یافت نشد");
            return;
        }
        if (res.code == 401) {
            location.href = 'index.php';

        }
    })
}

main.addProduct = () => {
    $(".error-msg").text("");
    $('.invalid').removeClass('invalid');


    if ($('#product-name').val() == "") {
        $(".error-msg").text("نام محصول الزامی است");
        $('#product-name').addClass('invalid');
        return;
    }
    if ($("#product-category").val() == 0) {
        $(".error-msg").text("انتخاب دسته‌بندی محصول الزامی است");
        $('#product-category').addClass('invalid');
        return;
    }
    if ($("#product-price").val() == "") {
        $(".error-msg").text("قیمت محصول الزامی است");
        $('#product-price').addClass('invalid');
        return;
    }
    if ($("#product-stock").val() == "") {
        $(".error-msg").text("نام محصول الزامی است");
        $('#product-stock').addClass('invalid');
        return;
    }
    if ($("#product-image").val() == "undefined") {
        $(".error-msg").text("قیمت محصول الزامی است");
        $('#product-image').addClass('invalid');
        return;
    }
    if ($("#product-description").val() == "") {
        $(".error-msg").text("نام محصول الزامی است");
        $('#product-description').addClass('invalid');
        return;
    }

    let file = $('#product-image')[0].files[0];
    let formData = new FormData();
    formData.append('file', $('#product-image')[0].files[0]);
    formData.append('name', $('#product-name').val());
    formData.append('category', $('#product-category').val());
    formData.append('price', $('#product-price').val());
    formData.append('stock', $('#product-stock').val());
    formData.append('description', $('#product-description').val());
    formData.append('img', $('#product-img').val());


    $.ajax({
        url: "api/product_action.php",
        method: "POST",
        data: formData,
        contentType: false,
        processData: false
    })

    if (res.code == 501) {
        console.log(2);

    }
    if (res.code == 400) {
        console.log(1);

    }

}


$(() => {
    $("#register-btn").on('click', function () {
        main.register();
    });
    $("#login-btn").on('click', function () {
        main.login();
    });

    $('#submit-product').on('click', function () {
        main.addProduct();
    })
});