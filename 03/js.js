$(document).ready(function() {
    var Data = {};
    $.getJSON("https://ipapi.co/json/", function(d) {
        Data["ip"] = d.ip;
        //Data["city"] = d.city;
        Data["all_data"] = JSON.stringify(d); //JSON.stringify(d);
    });

    window.onload = function() {

        //Тип устройства
        if (device.desktop()) Data["device"] = 'ПК';
        if (device.tablet()) Data["device"] = 'Планшет';
        if (device.mobile()) Data["device"] = 'Смартфон';

        //Ориентация экрана
        //    if (device.landscape()) alert('Альбомная (в ширину)');
        //    if (device.portrait()) alert('Портретная (в высоту)');

        Data["y_city"] = ymaps.geolocation.city;
        Data["y_region"] = ymaps.geolocation.region;
        Data["y_country"] = ymaps.geolocation.country;

        $("#ip").text(Data["ip"]);
        $("#city").text(Data["city"]);

        $("#user-city").text(Data["y_city"]);
        $("#user-region").text(Data["y_region"]);
        $("#user-country").text(Data["y_country"]);

        $("#device").text(Data["device"]);

        $.post("ajax.php", Data,
            function(result) {
                $("#result").text(result);
            }
        );

    }

})