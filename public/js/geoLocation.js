$(document).ready(function () {
    Livewire.emit("getLocation", "-6.9280808,110.7956878");

    // if (navigator.geolocation) {
    //     navigator.geolocation.getCurrentPosition(showPosition);
    // } else {
    //     document.getElementById("lokasi").innerHTML = "6.9280808,110.7956878";
    // }

    // function showPosition(position) {
    //     Livewire.emit(
    //         "getLocation",
    //         position.coords.latitude + "," + position.coords.longitude
    //     );
    // }
});
