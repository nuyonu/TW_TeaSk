function verifyNew() {
    var newP = document.getElementById('newpassword').value;
    var newC = document.getElementById('confirmpasword').value;
    console.log(' ');
    console.log(newC);
    console.log(newP);
    console.log(newP.localeCompare(newC));
    if (newP.localeCompare(newC) != 0) {
        // document.getElementById('confirmpasword').
    }

}
function opentab(evt, idtab) {
    // Declare all variables
    let i, tabcontent, tablinks;

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("page1");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("buttonMenu");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(idtab).style.display = "flex";
    evt.currentTarget.className += " active";
}