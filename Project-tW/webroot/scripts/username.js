function usernameExist() {
    var username = document.getElementById('namec').value;
    if (username.length > 7 || username.length <100) {

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