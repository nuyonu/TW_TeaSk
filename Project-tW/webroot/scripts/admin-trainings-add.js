function addFormSubmit() {
    document.getElementById('add-form').submit();
}

let currentDate = new Date();

document.getElementById("start-date").valueAsDate = currentDate;
document.getElementById("end-date").valueAsDate = currentDate;

function setCurrentDate(id_name) {
    document.getElementById(id_name).valueAsDate = currentDate;
}

function checkDate(inputDateObject) {
    let inputFromUser = Date.parse(inputDateObject.value);
    //in cazul in care incearca sa elimine data si sa fie null
    if (isNaN(inputFromUser))
        setCurrentDate(inputDateObject.id);
    else if (new Date(inputDateObject.value).getTime() < new Date().getTime())
        setCurrentDate(inputDateObject.id);
    //Seteaza data de terminare la fel ca cea de inceput, daca data de inceput este mai mare ca cea de terminare
    if (new Date(document.getElementById("end-date").value).getTime() < new Date(inputDateObject.value).getTime())
        document.getElementById("end-date").valueAsDate = new Date(inputDateObject.value);
}

document.getElementById('start-time').value = new Date().getHours() + ":" + new Date().getMinutes();
document.getElementById('end-time').value = new Date(new Date().setHours(new Date().getHours() + 2)).getHours() + ":"
    + new Date().getMinutes();
document.getElementById("price").value = 0;
document.getElementById("seats").value = 0;

function checkNotNull(input) {
    if (input.value < 0)
        document.getElementById(input.id).value = 0;
}

function lengthBetween(text, left, right) {
    let lengthOfText = text.length;
    return lengthOfText >= left && lengthOfText <= right;
}

function createDangerAlert(text) {
    let div = document.createElement("div");
    div.className = "alert alert-danger";
    div.innerHTML = text;
    div.style.display = "inline";
    document.getElementById("inputs").prepend(div);
}


//Pentru ca titlul sa nu fie null sau sa nu fie unul existent
function titleCheck(title) {
    if (lengthBetween(title.value, 6, 100)) {
        return true;
    } else {
        createDangerAlert("Titlul trebuie sa fie cuprins intre 6 si 100 de caractere.");
        alertOut();
        return false;
    }
}

function organizerCheck(element) {
    if (!lengthBetween(element.value, 2, 100)) {
        createDangerAlert("Numele organizatorului de eveniment trebuie sa fie cuprins intre 2 si 100 de caractere.");
        alertOut();
        return false;
    }
    return true;
}

function locationCheck(element) {
    if (!lengthBetween(element.value, 2, 100)) {
        createDangerAlert("Locatia training-ului trebuie sa fie cuprinsa intre 2 si 100 de caractere.");
        alertOut();
        return false;
    }
    return true;
}

function domainCheck(element) {
    if (!lengthBetween(element.value, 2, 100)) {
        createDangerAlert("Domeniul trebuie sa fie cuprins intre 2 si 100 de caractere.");
        alertOut();
        return false;
    }
    return true;
}

function specificationsCheck(element) {
    if (!lengthBetween(element.value, 2, 100)) {
        createDangerAlert("Specificatiile trebuie sa fie cuprinse intre 2 si 100 de caractere.");
        alertOut();
        return false;
    }
    return true;
}

function descriptionCheck(element) {
    let characters = element.value.length;
    if (!lengthBetween(element.value, 50, 1000)) {
        createDangerAlert("Descrierea trebuie sa fie cuprinsa intre 50 si 1000 de caractere. Ai introdus: " + characters + " caractere");
        alertOut();
        return false;
    }
    return true;
}

function priceCheck(price) {
    if (isNaN(price.value)) {
        createDangerAlert("Nu ai voie sa introduci text in locul pretului");
        alertOut();
        return false;
    }
    if (price.value < 0) {
        createDangerAlert("Nu ai voie sa introduci un pret negativ");
        alertOut();
        return false;
    }
    if (price.value > 1000000) {
        createDangerAlert("Nu ai voie sa introduci un pret mai mare de 1.000.000");
        alertOut();
        return false;
    }
    return true;
}

function difficultyCheck(difficulty) {
    console.log(difficulty.value);
    if (isNaN(difficulty.value)) {
        createDangerAlert("Nu ai voie sa introduci text in locul dificultății.");
        alertOut();
        return false;
    }
    return (difficulty.value === "0" || difficulty.value === "1" || difficulty.value === "2");
}

function beginDateCheck(beginDate) {
    let inputFromUser = Date.parse(beginDate.value);
    console.log(beginDate.value);
    if (isNaN(inputFromUser)) {
        createDangerAlert("Data de început nu este validă.");
        alertOut();
        return false;
    }
    let oldDate = new Date();
    oldDate.setDate(oldDate.getDate() - 1);
    if (new Date(inputFromUser).getTime() <= oldDate.getTime()) {
        console.log(new Date(inputFromUser).getTime());
        console.log(new Date().getTime());
        createDangerAlert("Data de început nu este validă. Este mai veche decât data curentă.");
        alertOut();
        return false;
    }
    return true;
}

function beginTimeCheck(beginTime) {
    console.log(beginTime.value);
    if (beginTime.value === '' || beginTime.value === null) {
        createDangerAlert("Ora de început nu este validă.");
        alertOut();
        return false;
    }
    if (beginTime.value.match(/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/) == null) {
        createDangerAlert("Ora de început nu este validă.");
        alertOut();
        return false;
    }
    return true;
}

function checkAllFields() {
    let title = document.getElementById("title");
    let organizer = document.getElementById("organizer");
    let domain = document.getElementById("domain");
    let specs = document.getElementById("specifications");
    let location = document.getElementById("location");
    let description = document.getElementById("description");
    let price = document.getElementById("price");
    let difficulty = document.getElementById("difficulty");
    let beginDate = document.getElementById("start-date");
    let beginTime = document.getElementById("start-time");

    if (titleCheck(title) &&
        organizerCheck(organizer) &&
        domainCheck(domain) &&
        locationCheck(location) &&
        specificationsCheck(specs) &&
        descriptionCheck(description) &&
        priceCheck(price) &&
        difficultyCheck(difficulty) &&
        beginDateCheck(beginDate) &&
        beginTimeCheck(beginTime))
    {
        addFormSubmit();
    }
}