function getLocation() {

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        window.alert('Browser-ul nu suporta geolocatia');
    }
}

function showPosition(position) {
    document.getElementById("lat").value = position.coords.latitude;
    document.getElementById("long").value = position.coords.longitude;

    console.log("ok");
    fetch('https://nominatim.openstreetmap.org/reverse?format=json&lat=' + position.coords.latitude + '&lon=' + position.coords.longitude)
        .then(function (response) {
            return response.json();
        })
        .then(function (myJson) {
            answer = JSON.stringify(myJson);
            obj = JSON.parse(answer);
            document.getElementById("place").value = obj.display_name;
            document.getElementById("lat").value = position.coords.latitude;
            document.getElementById("long").value = position.coords.longitude;
        });
}