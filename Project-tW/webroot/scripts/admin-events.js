var deleteButton = document.getElementById("delete-button");
deleteButton.disabled = true;

var checkboxes = document.getElementsByClassName("check-for-delete");

function totalChecks() {
    var total = 0;

    for (var i = 0; i < checkboxes.length; ++i)
        if (checkboxes[i].checked)
            total++;
    return total;
}

function renameButton()
{
    var checks = totalChecks();

    console.log(checks);

    if (checks > 1) {
        deleteButton.innerHTML = "Elimină " + checks + " evenimente";
        deleteButton.disabled = false;
    }
    else if (checks === 1) {
        deleteButton.innerHTML = "Elimină evenimentul";
        deleteButton.disabled = false;
    }
    else {
        deleteButton.innerHTML = "Elimină evenimente";
        deleteButton.disabled = true;
    }
}