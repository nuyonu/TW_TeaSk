function openForm(formName)
{
    document.getElementById(formName).style.display = "block";
}

function closeCurrentForm(formName)
{
    document.getElementById(formName).style.display = "none";
}

let clicked = false;

function openButtonForm(formName)
{
    if(clicked)
    {
        closeCurrentForm(formName);
    }
    else
    {
        openForm(formName);
    }

    clicked = !clicked;
}

let accordion = document.getElementsByClassName("button-more-details");
let index;

for (index = 0; index < accordion.length; index++) {
    accordion[index].addEventListener("click", function () {
        var panel = this.parentElement.parentElement.parentElement.nextElementSibling;

        if (panel.style.display === "block") {
            panel.style.display = "none";
        } else {
            panel.style.display = "block";
        }
    });
}
