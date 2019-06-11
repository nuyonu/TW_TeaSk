$("error-alert").hide();

function password_hint(id, alert_id) {
    var password = document.getElementById(id).value;
    if (password.length < 6 || password.length > 20) {
        document.getElementById(id).style.color = "red";
        document.getElementById(id).style.border = "2px solid #2196F3";
        $(alert_id).show();
    } else {
        $(alert_id).hide();

    }
}


function val() {
    var password = document.getElementById("namec").value;
    if (password.length < 8) {
        document.getElementById("error-alert2").style.display = "block";
    } else {
        document.getElementById("error-alert2").style.display = "none";
    }
}

function verifyPass() {
    var password = document.getElementById("pwsc").value;
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
    var password = document.getElementById('pwscr').value;
    if (password.localeCompare(document.getElementById('pwsc').value) != 0) {
        $('#error-alert6').show();
    } else {
        $('#error-alert6').hide();
    }

}

function pass_confirm() {
    var password = document.getElementById('pwscr').value;
    if (password.localeCompare(document.getElementById('pwsc').value) != 0) {
        $('#error-alert6').show();
    } else {
        $('#error-alert6').hide();
    }

}

function username(id, alert_id) {
    var node = document.getElementById(id);
    var password = node.value;
    if (password.length < 6 || password.length > 20) {
        console.log(1);
        $(alert_id).show();
    } else {
        $(alert_id).hide();

        console.log(2);
    }
    // border: 2px solid #2196F3;
    // color: #2196F3;

}

function valided() {
    const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    var email = document.getElementById("email").value;
    if (re.test(String(email).toLowerCase())) {
        $("#error-alert3").hide();
    } else {
        $("#error-alert3").show();
    }
}

function validetePassword(pass) {
    const re = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
    return !re.test(pass);
}
