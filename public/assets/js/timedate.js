// jam

function clock() {
    var dateTime = new Date();
    var jm = dateTime.getHours();
    var mnt = dateTime.getMinutes();
    var dtk = dateTime.getSeconds();

    Number.prototype.pad = function (digits) {
        for (var n = this.toString(); n.length < digits; n = 0 + n);
        return n;
    }

    document.getElementById('jam').innerHTML = jm.pad(2);
    document.getElementById('menit').innerHTML = mnt.pad(2);
    document.getElementById('detik').innerHTML = dtk.pad(2);

}
setInterval(clock, 10);

// hari
function date() {
    var monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September",
        "Oktober", "November", "Desember"
    ];
    var dayNames = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
    var today = new Date();
    document.getElementById('date').innerHTML = (dayNames[today.getDay()] + ", " + today.getDate() + ' ' +
        monthNames[today.getMonth()] + ' ' + today.getFullYear());
}
setInterval(date, 1)

// disable tombol absen
$(document).ready(function () {
    // Define the times for `jam_absen` and `batas_absen_pulang` from the server-side variables
    const jamAbsen = jam_absen;
    const batasAbsenPulang = batas_absen_pulang;

    const [jamHours, jamMinutes] = jamAbsen.split(':').map(Number);
    const [batasHours, batasMinutes] = batasAbsenPulang.split(':').map(Number);

    function checkTimeAndRefresh() {
        const currentTime = new Date();

        // Create Date objects for `jam_absen` and `batas_absen_pulang`
        const absenTime = new Date();
        absenTime.setHours(jamHours);
        absenTime.setMinutes(jamMinutes);
        absenTime.setSeconds(0);

        const batasTime = new Date();
        batasTime.setHours(batasHours);
        batasTime.setMinutes(batasMinutes);
        batasTime.setSeconds(0);

        // Check if the current time is past `jam_absen`
        if (currentTime > absenTime) {
            if (!localStorage.getItem('pageRefreshed')) {
                localStorage.setItem('pageRefreshed', 'true');
                setTimeout(() => location.reload(), 1000); // Refresh after 1 second
            }
        } else {
            localStorage.removeItem('pageRefreshed');
        }

        // Check if the current time is past `batas_absen_pulang`
        if (currentTime >= batasTime) {
            if (!localStorage.getItem('batasRefreshed')) {
                localStorage.setItem('batasRefreshed', 'true');
                setTimeout(() => location.reload(), 1000); // Refresh after 1 second
            }
        } else {
            localStorage.removeItem('batasRefreshed');
        }
    }

    // Check the time immediately
    checkTimeAndRefresh();

    // Set an interval to check every 5 seconds
    setInterval(checkTimeAndRefresh, 5000); // Check every 5 seconds
});
