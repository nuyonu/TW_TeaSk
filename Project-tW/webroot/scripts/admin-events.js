// Get the modal
let modal = document.getElementById('Add-Modal');

// Get the button that opens the modal
let btn = document.getElementById("add-button");

// Get the <span> element that closes the modal
let span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal
btn.onclick = function () {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function () {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

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
    if(input.value < 0)
        document.getElementById(input.id).value = 0;
}

