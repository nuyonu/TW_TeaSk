function openForm(formName)
{
    document.getElementById(formName).style.display = "block";
}

function closeCurrentForm(formName)
{
    document.getElementById(formName).style.display = "none";
}

var clicked = false;

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