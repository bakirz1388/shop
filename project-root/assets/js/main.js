const main = {};

main.post = (action, data, onSuccess, onError) => {
    $.ajax({
        url: "../api/" + action,
        type: "POST",
        contentType: "application/json",
        data: JSON.stringify(data),
        dataType: "json",
        success: res => onSuccess(res),
        error: xhr => {
            const response = xhr.responseJSON || { message: "خطای غیرمنتظره رخ داد." };
            if (onError) {
                onError(response, xhr.status);
                return;
            }
            main.TOAST(response.message || "خطای غیرمنتظره رخ داد.", "invalid");
        }
    });
};

main.postForm = (action, data, onSuccess, onError) => {
    $.ajax({
        url: "../api/" + action,
        type: "POST",
        data: data,
        dataType: "json",
        success: res => onSuccess(res),
        error: xhr => {
            const response = xhr.responseJSON || { message: "خطای غیرمنتظره رخ داد." };
            if (onError) {
                onError(response, xhr.status);
                return;
            }
            main.TOAST(response.message || "خطای غیرمنتظره رخ داد.", "invalid");
        }
    });
};

main.setError = (message, selector) => {
    $(".error-msg").text(message);
    if (selector) {
        $(selector).addClass("invalid");
    }
};

main.register = () => {
    $(".error-msg").text("");
    $(".invalid").removeClass("invalid");

    if ($("#realname").val() === "") {
        main.setError("نام کامل خود را بنویسید", "#realname");
        return;
    }
    if ($("#r-username").val() === "") {
        main.setError("نام کاربری خود را بنویسید", "#r-username");
        return;
    }
    if ($("#email").val() === "") {
        main.setError("ایمیل خود را بنویسید", "#email");
        return;
    }
    if ($("#r-password").val() === "") {
        main.setError("رمز عبور خود را بنویسید", "#r-password");
        return;
    }
    if ($("#repassword").val() === "") {
        main.setError("تکرار رمز عبور را بنویسید", "#repassword");
        return;
    }
    if ($("#r-password").val() !== $("#repassword").val()) {
        main.setError("تکرار رمز عبور با رمز عبور یکی نیست", "#repassword");
        return;
    }

    const data = {
        realname: $("#realname").val().trim(),
        username: $("#r-username").val().trim(),
        email: $("#email").val().trim(),
        password: $("#r-password").val()
    };

    main.post("register_action.php", data, res => {
        if (res.code === 400) {
            location.href = "login.php";
        }
    }, res => {
        main.setError(res.message || "ثبت نام انجام نشد", "#r-username");
    });
};

main.login = () => {
    $(".error-msg").text("");
    $(".invalid").removeClass("invalid");

    if ($("#l-username").val() === "") {
        main.setError("نام کاربری خود را بنویسید", "#l-username");
        return;
    }
    if ($("#l-password").val() === "") {
        main.setError("رمز عبور خود را بنویسید", "#l-password");
        return;
    }

    const data = {
        username: $("#l-username").val().trim(),
        password: $("#l-password").val()
    };

    main.post("login_action.php", data, res => {
        if (res.code === 401) {
            location.href = "index.php";
        }
    }, res => {
        $("#l-username, #l-password").addClass("invalid");
        main.setError(res.message || "ورود انجام نشد");
    });
};

main.addProduct = () => {
    $(".error-msg").text("").removeClass("success-msg");
    $(".invalid").removeClass("invalid");

    if ($("#product-name").val() === "") {
        main.setError("نام محصول الزامی است", "#product-name");
        return;
    }
    if ($("#product-category").val() === "0") {
        main.setError("دسته‌بندی محصول را انتخاب کنید", "#product-category");
        return;
    }
    if ($("#product-price").val() === "") {
        main.setError("قیمت محصول الزامی است", "#product-price");
        return;
    }
    if ($("#product-stock").val() === "") {
        main.setError("موجودی محصول الزامی است", "#product-stock");
        return;
    }
    if ($("#product-description").val() === "") {
        main.setError("توضیح محصول الزامی است", "#product-description");
        return;
    }
    if (!$("#product-image")[0].files[0]) {
        main.setError("تصویر محصول را انتخاب کنید", "#product-image");
        return;
    }

    const formData = new FormData();
    formData.append("file", $("#product-image")[0].files[0]);
    formData.append("name", $("#product-name").val().trim());
    formData.append("category", $("#product-category").val());
    formData.append("price", $("#product-price").val());
    formData.append("stock", $("#product-stock").val());
    formData.append("description", $("#product-description").val().trim());

    $.ajax({
        url: "../api/product_action.php",
        method: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "json",
        success: res => {
            $(".error-msg").text(res.message).addClass("success-msg");
            $(".seller-card").addClass("valid");
            $("#seller-product-form").find("input[type='text'], input[type='number'], textarea").val("");
            $("#product-category").val("0");
            $("#product-image").val("");
        },
        error: xhr => {
            const res = xhr.responseJSON || { message: "ثبت محصول انجام نشد." };
            main.setError(res.message);
        }
    });
};

main.addShopCart = productId => {
    main.postForm("cart_action.php", { id: productId }, res => {
        if (typeof res.cartCount !== "undefined") {
            $(".cart-count").text(res.cartCount);
        }
        main.TOAST(res.message || "محصول به سبد خرید اضافه شد", "valid");
    }, res => {
        main.TOAST(res.message || "افزودن به سبد خرید انجام نشد", "invalid");
    });
};

main.removeShopCart = productId => {
    main.postForm("cart_remove.php", { id: productId }, res => {
        if (typeof res.cartCount !== "undefined") {
            $(".cart-count").text(res.cartCount);
        }
        main.TOAST(res.message || "محصول حذف شد", "valid");
    }, res => {
        main.TOAST(res.message || "حذف از سبد خرید انجام نشد", "invalid");
    });
};

main.checkout = () => {
    $(".buy-btn").prop("disabled", true);
    main.postForm("buy_action.php", {}, res => {
        main.TOAST(res.message || "خرید ثبت شد", "valid");
    }, res => {
        $(".buy-btn").prop("disabled", false);
        main.TOAST(res.message || "ثبت خرید انجام نشد", "invalid");
    });
};

main.TOAST = (text, cls) => {
    const card = '<div class="toast ' + cls + '">' + text + "</div>";
    $("main").append(card);
    setTimeout(() => {
        $(".toast").addClass("active");
    }, 20);
    setTimeout(() => {
        $(".toast").removeClass("active");
        setTimeout(() => {
            $(".toast").remove();
        }, 600);
    }, 2500);
};

main.roleChange = (userID, role) => {
    main.postForm("role_change.php", { user_id: userID, role: role }, () => {
        location.reload();
    }, res => {
        main.TOAST(res.message || "تغییر نقش انجام نشد", "invalid");
    });
};

main.changeUser = () => {
    $(".error-msg").text("");
    $(".invalid").removeClass("invalid");

    if ($("#name-panel").val() === "") {
        main.setError("فیلدها نباید خالی باشند", "#name-panel");
        return;
    }
    if ($("#uname-panel").val() === "") {
        main.setError("فیلدها نباید خالی باشند", "#uname-panel");
        return;
    }
    if ($("#email-panel").val() === "") {
        main.setError("فیلدها نباید خالی باشند", "#email-panel");
        return;
    }

    const data = {
        realname: $("#name-panel").val().trim(),
        username: $("#uname-panel").val().trim(),
        email: $("#email-panel").val().trim(),
        password: $("#pass-panel").val()
    };

    main.post("change_user.php", data, res => {
        $(".form-area").addClass("valid");
        $(".error-msg").addClass("success-msg").text(res.message || "تغییرات ذخیره شد.");
        setTimeout(() => {
            location.reload();
        }, 1200);
    }, res => {
        main.setError(res.message || "ذخیره تغییرات انجام نشد");
    });
};

$(() => {
    $("#register-btn").on("click", main.register);
    $("#login-btn").on("click", main.login);
    $(".btn-save").on("click", main.changeUser);
    $("#submit-product").on("click", main.addProduct);
    $(".add-shop-cart").on("click", function () {
        main.addShopCart($(this).attr("data-id"));
    });
    $(".remove-shop-cart").on("click", function () {
        main.removeShopCart($(this).attr("data-id"));
    });
    $(".buy-btn").on("click", main.checkout);
    $(".admin-user-btn").on("click", function () {
        main.roleChange($(this).attr("data-id"), $(this).attr("data-role"));
    });
});
