$(document).ready(function() {
    //Returns the number of minutes ahead or behind Greenwich Meridian
    var offset = new Date().getTimezoneOffset();

    //Returns the number of milliseconds since 1970/01/01:
    var timestamp = new Date().getTime();

    //Convert the time to: Universal Time Coordinated
    var utc_timestamp = timestamp + (60000 * offset);

    console.log(utc_timestamp);
    $('#time_zone_offset').val(offset);
    $('#utc_timestamp').val(utc_timestamp);
});