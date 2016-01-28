window.addEventListener('load', function () {

    var latitude;
    var longitude;
/*
    navigator.geolocation.getCurrentPosition(showPosition();*/
    showPosition();


    function showPosition(pos){
    /*    latitude = pos.coords.latitude;
        longitude = pos.coords.longitude;*/
        latitude = 49.023035;
        longitude = 2.363160;


        //options
        var options = {
            center:new google.maps.LatLng(latitude,longitude),
            zoom:15,
            zoomControl: false,
            scaleControl: false,
            scrollwheel: false,
            disableDoubleClickZoom: true,
            mapTypeId:google.maps.MapTypeId.ROADMAP
        };

        var maCarte=new google.maps.Map(document.getElementById("map_taxi"),options);

        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(latitude,longitude),
            map: maCarte,
            title: 'taxi'
        });

    }



});
