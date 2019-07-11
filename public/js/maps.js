var maps = {
    velovApiKey : 'https://api.jcdecaux.com/vls/v1/stations?contract=Lyon&apiKey=edd4bb1e7bda612cd24c020dd12906efb3bed337',
    map: null,

    initMap: function(){
        maps.map = new google.maps.Map(document.getElementById('map'), {
            center: {
                lat: 45.763355,
                lng: 4.828675,
            },
            zoom: 18,
        });
        var markerBar = new google.maps.Marker({position: {lat: 45.763355, lng: 4.828575}, map: maps.map, title: 'Overcraft Café', icon: new google.maps.MarkerImage('public/img/home/bar.png')});
        maps.velovApi();
    },

    velovApi: function(){
        ajaxGet(maps.velovApiKey, function(response){
            var stations = JSON.parse(response);
            var station = stations[300];
            var marker = new google.maps.Marker({
                map: maps.map,
                position: station.position,
                name: station.name,
                icon: new google.maps.MarkerImage('public/img/home/velov.png'),
                title: 'Vélov',
            });

            marker.addListener('click', function(){
                $('#info-station').css('display', 'block');
                $('#info-bus').css('display', 'none');
                document.getElementById('name-station').innerHTML = '<strong>Station VéloV :</strong>&nbsp;&nbsp; ' + station.name;
                document.getElementById('place-station').innerHTML = '<strong>Nombre de vélos disponibles :</strong>&nbsp;&nbsp; ' + station.available_bikes;
            });
            var markerBus = new google.maps.Marker({position: {lat: 45.763348, lng: 4.829109}, map: maps.map, title: 'Bus', icon: new google.maps.MarkerImage('public/img/home/bus.png')});
            markerBus.addListener('click', function(){
                $('#info-bus').css('display', 'block');
                $('#info-station').css('display', 'none');
            });

            maps.map.addListener('click', function(){
                $('#info-bus').css('display', 'none');
                $('#info-station').css('display', 'none');
            });
        });
    }
}

$(document).ready(function() {
    maps.initMap();
 });