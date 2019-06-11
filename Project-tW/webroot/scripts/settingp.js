function verifyPass() {
    var password = document.getElementById("newpassword").value;
    const re = new RegExp("^(?=.*[a-z])");
    if (re.test(password)) {
        document.getElementById("i2").style.display = "none";
    } else {
        document.getElementById("i2").style.display = "block";
    }
    // const re = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");

    const re2 = new RegExp("^(?=.*[A-Z])");
    if (re2.test(password)) {
        document.getElementById("i3").style.display = "none";
    } else {
        document.getElementById("i3").style.display = "block";
    }

    const re3 = new RegExp("^(?=.*[0-9])");
    if (re3.test(password)) {
        document.getElementById("i4").style.display = "none";
    } else {
        document.getElementById("i4").style.display = "block";
    }
    const re4 = new RegExp("^(?=.*[!@#\\$%\\^&\\*])");
    if (re4.test(password)) {
        document.getElementById("i5").style.display = "none";
    } else {
        document.getElementById("i5").style.display = "block";
    }

    if (password.length < 8 || password.length > 100) {
        document.getElementById("i1").style.display = "block";
    } else {
        document.getElementById("i1").style.display = "none";
    }

    if (validetePassword(password)) {
        document.getElementById("error-alertStr").style.display = "block";
    } else {
        document.getElementById("error-alertStr").style.display = "none";
    }
    var password = document.getElementById('newpassword').value;
    if (password.localeCompare(document.getElementById('confirmpasword').value) != 0) {
        document.getElementById("error-alert6").style.display = "block";
    } else {
        document.getElementById("error-alert6").style.display = "none";
    }

}


function pass_confirm() {
    var password = document.getElementById('newpassword').value;
    if (password.localeCompare(document.getElementById('confirmpasword').value) != 0) {
        document.getElementById("error-alert6").style.display = "block";
    } else {
        document.getElementById("error-alert6").style.display = "none";
    }

}

function validetePassword(pass) {
    const re = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
    return !re.test(pass);
}


$(document).ready(function () {
    $('#register').submit(function (e) {
        e.preventDefault();

        var password = document.getElementById('newpassword').value;
        var conf = document.getElementById('confirmpasword').value;
        if (validetePassword(password) && password.localeCompare(conf) == 0) {
            $("#register").unbind('submit');
            document.contact.submit();


        } else {
            window.alert("Va rugăm completati corespunzator campurile care au culoarea roșie.");
        }
    });
});