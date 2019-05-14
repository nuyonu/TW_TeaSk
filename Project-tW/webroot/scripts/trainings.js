var showButtons = document.querySelectorAll(".training-table-show-button");

showButtons.forEach(function(elem) {
    elem.addEventListener("click", showDescription);
});

function showDescription(e) {
    let description = this.parentElement.nextElementSibling;

    if (description.style.display === "" || description.style.display === "none") {
        description.style.display = "block";
        this.innerHTML = "&#11165";
    } else {
        description.style.display = "none";
        this.innerHTML = "&#11167";
    }
}