function email() {
    const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    var email = document.getElementById("email2").value;
    if (re.test(String(email).toLowerCase())) {
        document.getElementById("error-alert3").style.display = "none";
    } else {
        document.getElementById("error-alert3").style.display = "block";
    }
}

function nameI() {
    var name = document.getElementById("nameinput").value;
    if (name.length > 0) {
        document.getElementById("error-alert4").style.display = "none";
    } else {
        document.getElementById("error-alert4").style.display = "block";
    }
}

function first() {
    var name = document.getElementById("lastnameinput").value;
    if (name.length > 0) {
        document.getElementById("error-alert5").style.display = "none";
    } else {
        document.getElementById("error-alert5").style.display = "block";
    }
}

function notifyM() {
    var name = document.getElementById("nameinput").value;
    var first = document.getElementById("lastnameinput").value;
    const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    var email = document.getElementById("email2").value;
    if (re.test(String(email).toLowerCase()) && name.length > 0 && first.length > 0) {
        return true;
    }
    window.alert("Corectati camourile care au mesaje cu rosu.");
    return false;


}

function sterge() {
    var decision = confirm("Sigur vrei sa iti stergi contul?");
    if (decision == true) {
        window.location.replace("http://localhost/settings/delete");
    }
}

function moderator() {
    var decision = confirm("Sigur vrei sa devii moderator?");
    if (decision == true) {
        window.location.replace("http://localhost/settings/role");
    }

}

function utilizator() {
    var decision = confirm("Sigur vrei sa devii utilizator normal?");
    if (decision == true) {
        window.location.replace("http://localhost/settings/role");
    }
}