var dayOfWeek;

$(document).ready(function() {

    $.datepicker.regional['fr'] = {
        closeText: 'Fermer',
        prevText: 'Précédent',
        nextText: 'Suivant',
        currentText: 'Courant',
        monthNames: ['Janvier','Février','Mars','Avril','Mai','Juin',
            'Juillet','Août','Septembre','Octobre','Novembre','Décembre'],
        monthNamesShort: ['Jan','Fév','Mar','Avr','Mai','Jun',
            'Jul','Aoû','Sep','Oct','Nov','Déc'],
        dayNames: ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'],
        dayNamesShort: ['Dim','Lun','Mar','Mer','Jeu','Ven','Sam'],
        dayNamesMin: ['Di','Lu','Ma','Me','Je','Ve','Sa'],
        weekHeader: 'Sm',
        //dateFormat: 'dd/mm/yy',
        dateFormat: 'dd/mm/yy',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    };

    var weekday=new Array(7);
    weekday[0]="Lundi";
    weekday[1]="Mardi";
    weekday[2]="Mercredi";
    weekday[3]="Jeudi";
    weekday[4]="Vendredi";
    weekday[5]="Samedi";
    weekday[6]="Dimanche";

    $.datepicker.setDefaults($.datepicker.regional['fr']);

    $( "#date_course" ).datepicker({
        showOn: "button",
        buttonImage: "wp-content/themes/taxiradio/images/calendrier.png",
        buttonImageOnly: true,
        onSelect: function(dateText, inst) {
            var date = $(this).datepicker('getDate');
            dayOfWeek = weekday[date.getUTCDay()];
        }
    });

    setTimeout(function(){initialize();},700);
});

var map;
var autocomplete = new google.maps.places.Autocomplete();
var autocomplete2 = new google.maps.places.Autocomplete();

var distance;

var rendererOptions = {
    draggable: true
};
var directionsDisplay = new google.maps.DirectionsRenderer(rendererOptions);
var directionsService = new google.maps.DirectionsService();

function initialize() {
    var mapOptions = {
        center: new google.maps.LatLng(49.022981, 2.363137),
        zoom: 11,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    map = new google.maps.Map(document.getElementById('map-calcule'), mapOptions);

    var input = /** @type {HTMLInputElement} */(document.getElementById('depart'));
    autocomplete = new google.maps.places.Autocomplete(input);

    var input2 = /** @type {HTMLInputElement} */(document.getElementById('arrivee'));
    autocomplete2 = new google.maps.places.Autocomplete(input2);

    var infowindow = new google.maps.InfoWindow();
    var marker = new google.maps.Marker({
        map: map
    });

    google.maps.event.addListener(autocomplete, 'place_changed', function() {

        var place = autocomplete.getPlace();

        if (!place.geometry) {
            // Inform the user that the place was not found and return.
            input.className = 'notfound';
            return;
        }

        // If the place has a geometry, then present it on a map.
        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);  // Why 17? Because it looks good.
        }


        marker = null;
        marker2 = null;
        marker.setIcon({
            url: place.icon,
            size: new google.maps.Size(71, 71),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(17, 34),
            scaledSize: new google.maps.Size(35, 35)
        });

        marker.setPosition(place.geometry.location);
        marker.setVisible(true);

        var address = '';
        if (place.address_components) {
            address = [
                (place.address_components[0] && place.address_components[0].short_name || ''),
                (place.address_components[1] && place.address_components[1].short_name || ''),
                (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
        }

        infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
        infowindow.open(map, marker);

    });

    var infowindow2 = new google.maps.InfoWindow();
    var marker2 = new google.maps.Marker({
        map: map
    });

    google.maps.event.addListener(autocomplete2, 'place_changed', function() {

        var place2 = autocomplete2.getPlace();

        if (!place2.geometry) {
            // Inform the user that the place was not found and return.
            input.className = 'notfound';
            return;
        }

        // If the place has a geometry, then present it on a map.
        if (place2.geometry.viewport) {
            map.fitBounds(place2.geometry.viewport);
        } else {
            map.setCenter(place2.geometry.location);
            map.setZoom(17);  // Why 17? Because it looks good.
        }

        marker2.setIcon({
            url: place2.icon,
            size: new google.maps.Size(71, 71),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(17, 34),
            scaledSize: new google.maps.Size(35, 35)
        });

        marker2.setPosition(place2.geometry.location);
        marker2.setVisible(true);

        var address2 = '';
        if (place2.address_components) {
            address2 = [
                (place2.address_components[0] && place2.address_components[0].short_name || ''),
                (place2.address_components[1] && place2.address_components[1].short_name || ''),
                (place2.address_components[2] && place2.address_components[2].short_name || '')
            ].join(' ');
        }

        infowindow2.setContent('<div><strong>' + place2.name + '</strong><br>' + address2);
        infowindow2.open(map, marker2);

    });

}

function validForm(){

    valid = 1;

    if($('input[type=radio][name=heure]:checked').length != 1){
        valid = 0;
    }

    /*if($("#date_course").val() == 0){
     valid = 0;
     }*/

    if(valid == 0){
        alert("tous les champs ne sont pas remplis !");
        return false;
    }else{
        return true;
    }

}

function calcPrix(){

    if(validForm()){

        var start = autocomplete.getPlace();
        var end = autocomplete2.getPlace();

        calcRoute(start.geometry.location, end.geometry.location);

    }

}

function calcRoute(start, end) {
    var request = {
        origin:start,
        destination:end,
        travelMode: google.maps.TravelMode.DRIVING
    };
    directionsService.route(request, function(result, status) {
        if (status == google.maps.DirectionsStatus.OK) {
            directionsDisplay.setDirections(result);
            directionsDisplay.setMap(map);
            distance = computeTotalDistance(directionsDisplay.directions);
            //On calcule le prix
            calcTotal(distance);
        }
    });
}

function calcTotal(distance){

    //On récupère le tarif
    if($('input[type=radio][name=heure]:checked').attr('value') == '1'){

        //taux_horraire = 1.50;
        taux_horraire = 1.80;
        distance = distance * 1.20;
        prix_depart = 7;

    }else{
        //taux_horraire = 2.55;
        taux_horraire = 2.55;
        distance = distance * 1.20;
        prix_depart = 5;
    }

    if(dayOfWeek == 'Dimanche'){
        //taux_horraire = 2.55;
        taux_horraire = 2.55;
        distance = distance * 1.20;
        prix_depart = 5;
    }

    prix = (distance * taux_horraire) + prix_depart;

    $("#output").val(prix.toFixed(1) + "0 €");

    $("#output").css('display', 'block');

}

function computeTotalDistance(result) {
    var total = 0;
    var myroute = result.routes[0];
    for (var i = 0; i < myroute.legs.length; i++) {
        total += myroute.legs[i].distance.value;
    }
    total = total / 1000;
    return total;
}