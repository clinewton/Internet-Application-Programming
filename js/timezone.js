$(document).ready(function() {

    //API to get the current time based on the IP address of the client
    //The API uses the IP address to get the current time according to their geolocation
    var endpoint = 'https://api.ipgeolocation.io/timezone?apiKey=63a8faaeb54f4d92b2d0694374609a94';

    function getUserTime(utc_timestamp, offset) {
        $('#time_zone_offset').val(offset);
        $('#utc_timestamp').val(utc_timestamp);
    }

    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var response = JSON.parse(this.responseText);

            //If connection is successfull and a response is obtained
            if (response) {
                timestamp = response.date_time_unix * 1000; //in milliseconds
                offset = response.timezone_offset * 60 * 60 * 1000; //in milliseconds

                //Get UTC Timestamp(GMT Timestamp) based on the value of the offset
                if (offset > 0) {
                    utc_timestamp = timestamp - offset;
                    getUserTime(utc_timestamp, offset);
                } else {
                    utc_timestamp = timestamp + offset;
                    getUserTime(utc_timestamp, offset);
                }
            } else {
                //If connection is unsuccessfull, use the client's set Date/Time    
                offset = new Date().getTimezoneOffset();
                timestamp = new Date().getTime();
                utc_timestamp = timestamp + (60000 * offset);
                getUserTime(utc_timestamp, offset);
            }
        }
    };

    xhr.open('GET', endpoint, true);
    xhr.send();
});