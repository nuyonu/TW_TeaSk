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


function pass_confirm() {
    var password = document.getElementById('pwscr').value;
    if (password.length < 6 || password.length > 20) {
        $('#error-alert5').show();
    } else {
        $('#error-alert5').hide();

    }
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
