$(document).ready(function () {
    $('#register').submit(function (e) {
        e.preventDefault();
        if (usernameExistReg() && validEmail() &&password_hintReg('pwsc','#error-alert4') && pass_confirmReg()) {
            $("#register").unbind('submit');
            document.register.submit();
        }else {
            window.alert("Va rugăm completati corespunzator campurile care au culoarea roșie.");
        }
    });
});

function pass_confirmReg() {
    var password = document.getElementById('pwscr').value;
    if (password.length < 6 || password.length > 20) {
        return false;
    }
    return password.localeCompare(document.getElementById('pwsc').value) == 0;

}

function validEmail() {
    const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    var email = document.getElementById("email").value;
    return re.test(String(email).toLowerCase())
}


function password_hintReg(id, alert_id) {
    var password = document.getElementById(id).value;
    return !(password.length < 6 || password.length > 20);
}


function usernameExistReg() {
    var username = document.getElementById('namec').value;
    if (username.length < 6 || username.length > 20) {
       return false;
    } else {
        $.ajax({
            type: "POST",
            url: 'home/verifyUsername',
            data: {'user': document.getElementById('namec').value},

            success: function (response) {
                const jsonData = JSON.parse(response);
                if (jsonData.success == "1") {
                    return false;
                } else {
                    return true;
                }
            }
        });
    }
}