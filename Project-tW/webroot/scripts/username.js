function usernameExist() {
    var username = document.getElementById('namec').value;
    if (username.length < 6 || username.length > 20) {
        // document.getElementById(id).style.color = "red";
        // document.getElementById(id).style.border = "2px solid #2196F3";

        $('#error-alert2').show();
    } else {
        $('#error-alert2').hide();
        // console.log(JSON.stringify({'user' : document.getElementById('namec').value}));
        $.ajax({
            type: "POST",
            url: 'home/verifyUsername',
            data: {'user' : document.getElementById('namec').value},

            success: function (response) {
                const jsonData = JSON.parse(response);
                if (jsonData.success == "1") {
                    $('#error_username').show();
                } else {
                    $('#error_username').hide();
                }
            }
        });
    }
}