function alertOut() {
    window.setTimeout(function () {
        $(".alert").fadeTo(500, 0).slideUp(500, function () {
            $(this).remove();
        });
    }, 2000);
}

function createDangerAlert(text) {
    let div = document.createElement("div");
    div.className = "alert alert-danger";
    div.innerHTML = text;
    div.style.display = "inline";
    document.getElementById("insert-code").prepend(div);
}

function successAlert(text) {
    let div = document.createElement("div");
    div.className = "alert alert-success";
    div.innerHTML = text;
    div.style.display = "inline";
    document.getElementById("insert-code").prepend(div);
}


//1 -alreadyUsed
//0 -don't exist
//2 -success
function sendCode() {
    let code = document.getElementById('code').value;
    console.log (code);
    let myRequest = new XMLHttpRequest();
    myRequest.onreadystatechange = function () {
        if (myRequest.readyState === 4) {
            console.log(myRequest.response);
            let serverResponse = JSON.parse(myRequest.response);
            if (serverResponse.success === 0) {
                createDangerAlert("Codul introdus nu este corect");
                alertOut();
            } else if(serverResponse.success === 1) {
                createDangerAlert("Acest cod a fost utilizat deja de catre tine");
                alertOut();
            }
            else if(serverResponse.success === 2) {
                successAlert("Codul introdus a fost adaugat cu succes");
                alertOut();
            } else {
                createDangerAlert("A aparut o eroare de la server. Te rog contacteaza-ne");
                alertOut();
            }
        }
    };

    myRequest.open("POST", "/settings/addCode?", true);
    myRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    myRequest.send("code=" + code);
}
