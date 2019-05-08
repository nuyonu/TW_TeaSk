let accordion = document.getElementsByClassName("button-display-answer");
let index;

for (index = 0; index < accordion.length; index++) {
    accordion[index].addEventListener("click", function () {
        this.classList.toggle("activeButton");
        let panel = this.nextElementSibling;
        if (panel.style.display === "block") {
            panel.style.display = "none";
        } else {
            panel.style.display = "block";
        }
    });
}