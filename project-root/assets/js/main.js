const main = {};

// **=========== register check ============**


main.post = (action, data, func) => {
    $.ajax({
        url: "../api/" + action,
        type: "POST",
        contentType: "application/json",
        data: JSON.stringify(data),
        dataType: "json",
        success: res => {
            func(res);
        }
    });
}
main.post1 = (action, data, func) => {
    $.ajax({
        url: "../api/" + action,
        type: "POST",
        data: data,
        success: res => {
            func(JSON.parse(res));
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
    if ($('#product-name').val().length > 30) {
        $(".error-msg").text("نام محصول از 30 کاراکتر زیاد است");
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
        $(".error-msg").text("موجودی محصول الزامی است");
        $('#product-stock').addClass('invalid');
        return;
    }
    if ($("#product-description").val() == "") {
        $(".error-msg").text("توضیحی برای محصول الزامی است");
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
        url: "../api/product_action.php",
        method: "POST",
        data: formData,
        contentType: false,
        processData: false
    })

    $(".error-msg").text("محصول شما با موفقیت اضافه شد");
    $(".error-msg").addClass("success-msg");
    $(".success-msg").removeClass("error-msg");
    $(".seller-card").addClass("valid");
}

main.addShopCart = (btn, ID) => {

    let data = {
        id: ID
    }

    main.post1('cart_action.php', data, res => {
        if (res.code == 405) {
            main.TOAST("محصول به سبد خرید منتقل شد", "valid");
        }
        if (res.code == 505) {
            main.TOAST("نیاز است که به اکانت خود ورود کنید", "invalid");
        }
    });
};

main.TOAST = (text, cls) => {
    let card = '<div class="toast ' + cls + '">' + text + '</div>';
    $('main').append(card);
    setTimeout(() => {

        $('.toast').addClass('active');
    }, 20)
    setTimeout(() => {
        $('.toast').removeClass('active');
        setTimeout(() => {
            $('.toast').remove();
        }, 600);

    }, 5000);
    setTimeout(() => {
        location.reload();
    }, 5150)
}

main.roleChange = (userID, role) => {

    let data = {
        user_id: userID,
        role: role
    }

    main.post1('role_change.php', data, res => {
        if (res.code == 406) {
            location.reload();
        }
    });
}

main.changeUser = () => {



    $(".error-msg").text("");
    $(".invalid").removeClass("invalid");

    if ($("#name-panel").val() == "") {
        $(".error-msg").text("فیاد ها نباید خالی باشند");
        $("#name-panel").addClass("invalid");
        return;
    };
    if ($("#uname-panel").val() == "") {
        $(".error-msg").text("فیاد ها نباید خالی باشند");
        $("#uname-panel").addClass("invalid");
        return;
    };
    if ($("#email-panel").val() == "") {
        $(".error-msg").text("فیاد ها نباید خالی باشند");
        $("#email-panel").addClass("invalid");
        return;
    };
    let emailSplit = ($("#email-panel").val()).split("@");
    if (emailSplit.length != 2) {
        $(".error-msg").text("ایمیل شما صحیح نمیباشد");
        $("#email-panel").addClass("invalid");
        return;
    };

    if (emailSplit[1].split('.').length != 2) {
        $(".error-msg").text("ایمیل شما صحیح نمیباشد");
        $("#email-panel").addClass("invalid");
        return;
    };

    if (emailSplit[1].split('.')[0].length < 3) {
        $(".error-msg").text("ایمیل شما صحیح نمیباشد");
        $("#email-panel").addClass("invalid");
        return;
    };

    if (emailSplit[1].split('.')[1].length < 2) {
        $(".error-msg").text("ایمیل شما صحیح نمیباشد");
        $("#email-panel").addClass("invalid");
        return;
    };


    let data = {
        realname: $("#name-panel").val(),
        username: $("#uname-panel").val(),
        email: $("#email-panel").val(),
        password: $("#pass-panel").val(),
    }


    main.post('change_user.php', data, res => {
        if (res.code == 501) {
            $(".error-msg").text("An error occured while registering!");
            return;
        }
        if (res.code == 508) {
            $("#uname-panel").addClass("invalid");
            $(".error-msg").text("این نام کاربری تکراری است");
            return;
        }
        if (res.code == 400) {
            $(".form-area").addClass("valid");
            $(".error-msg").addClass("success-msg");
            $(".success-msg").removeClass("error-msg");
            $(".success-msg").text("تغییرات با موفقیت انجام شد. (منتظر باشید ...)");
            setTimeout(() => {
                location.href = '../api/logout.php';
            }, 2000)
        }
    })
}



$(() => {
    $("#register-btn").on('click', function () {
        main.register();
    });
    $("#login-btn").on('click', function () {
        main.login();
    });
    $(".btn-save").on('click', function () {
        main.changeUser();
    });
    $('#submit-product').on('click', function () {
        main.addProduct();
    });
    $('.add-shop-cart').on('click', function () {
        main.addShopCart($(this), $(this).attr('data-id'));
    });
    $('.admin-user-btn').on('click', function () {
        main.roleChange($(this).attr('data-id'), $(this).attr('data-role'));
    });
});