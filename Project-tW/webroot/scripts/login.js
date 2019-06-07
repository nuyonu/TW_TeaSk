$(document).ready(function () {
    $('#login').submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: 'home/verifyLogin',
            data: $(this).serialize(),
            success: function (response) {
                var jsonData = JSON.parse(response);
                if (jsonData.success == "1") {
                    $("#login").unbind('submit');
                    document.login.submit();
                } else {
                    $('#cred').show();
                }
            }
        });
    });
});
