$(document).ready(function () {
    $("#sendnow").click(function () {
        var name = $('#name').val().trim();
        var email = $('#email').val().trim();
        var mobile = $('#mobile').val().trim();
        var captcha_val = $('#captcha_val').val().trim();
        var msg = $('textarea[name="msg"]').val();
        $.ajax({
            method: "POST",
            url: "contact_action.php",
            data: { name: name, email: email, mobile: mobile, msg: msg, captcha_val: captcha_val },
            beforeSend: function () {
                $('#sendnow').hide();
                $('#subloader').show();
                $('#subloader').html('<img src="loader.gif" height="100">');
            },
            success: function (data) {

                var obj = JSON.parse(data);
                $('#msg').html(obj.errors);
                var status = obj.status;
                $('#subloader').hide();
                $('#subloader').html("");
                $('#sendnow').show();
                if (status == 'success') {
                    $('#hide_form').hide();
                    $('#success').html('Thank you ' + name + ' ! Your message has been sent . We will contcat you soon as possible.. ');

                }
                $("#captcha").attr('src', 'captchaimg.php');

            }
        });
    });
});
