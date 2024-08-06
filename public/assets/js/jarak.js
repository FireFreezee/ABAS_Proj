function jarak() {
    var lokasi = document.getElementById('lokasi');
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
    }



    function successCallback(position) {
        console.log('User coordinates:', position.coords.latitude, position.coords.longitude);
        var lat_user = position.coords.latitude;
        var long_user = position.coords.longitude;
        // Output the server values to verify
        var lokasi_sekolah = lokasiSekolah;
        var radius = radiusSekolah;
        console.log('lokasi_sekolah:', lokasi_sekolah);
        console.log('radius:', radius);
        // Example coordinates for testing
        var lok = lokasi_sekolah.split(",");
        var lat_sekolah = lok[0];
        var long_sekolah = lok[1];

        var userLatLng = L.latLng(lat_user, long_user);
        var schoolLatLng = L.latLng(lat_sekolah, long_sekolah);

        var distance = userLatLng.distanceTo(schoolLatLng).toFixed(0);
        var distanceInKm = (distance / 1000).toFixed(2);

        document.getElementById('distance').innerText = distance + ' m';

        console.log('Distance (meters):', distance);
        console.log('Distance (km):', distanceInKm);
    }

    function errorCallback(error) {
        console.error("Error retrieving location:", error);
    }

    // Request the user's location
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
    } else {
        alert("Geolocation is not supported by this browser.");
    }
}setInterval(jarak, 1000)