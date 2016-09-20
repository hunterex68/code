
function initialize(latitude,longitude) {
    if(!latitude || !longitude)
    {
        var lat = $('#lat').val();
        var lon = $('#lon').val();
        if(!lat || !lon)
        {
            lng = 55.7509467;
            ltd = 37.5835613;
        }
        else
        {
            ltd=lat;
            lng=lon;
        }
    }
    else
    {
        ltd = latitude;
        lng = longitude;
    }
    console.log(ltd,lng);
    var ld = new google.maps.LatLng(ltd,lng);
    var mapProp = {
        center:ld,
        zoom:15,
        mapTypeId:google.maps.MapTypeId.ROADMAP
    };
    var map=new google.maps.Map(document.getElementById("map"),mapProp);
    getAddress();
    var geocoder = new google.maps.Geocoder();
    var marker = new google.maps.Marker({
        position: ld,
        draggable: true,
        map: map,
        title:""
    });
    google.maps.event.addListener(marker, "dragend", function(event)
    {
        var point = marker.getPosition();// íîâûå êîîðäèíàòû ìàðêåðà: point.lat() è point.lng()
        $('#lat').val(point.lat());
        $('#lon').val(point.lng());
        getAddress();
    });


    google.maps.event.addListener(map, 'click', function(event) {
        placeMarker(event.latLng);


        if(marker)
        {
            marker.setPosition(event.latLng);
            var point = marker.getPosition();// íîâûå êîîðäèíàòû ìàðêåðà: point.lat() è point.lng()
            $('#lat').val(point.lat());
            $('#lon').val(point.lng());
            getAddress();
        }
        else
        {
            marker = new google.maps.Marker({
                position: event.latLng,
                map: map
            });


        }

        geocoder.geocode({'latLng': event.latLng}, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK){
                console.log(results[0].formatted_address); //àäðåñ íîâîé òî÷êè
            }
        });
    });


}
function placeMarker(location) {





    /* marker = new google.maps.Marker({
     position: location,
     map: map
     animation: google.maps.Animation.DROP,

     });

     if (oldMarker != undefined){
     oldMarker.setMap(null);
     }
     oldMarker = marker;
     map.setCenter(location);*/


}
function getAddress()
{
    var query='https://maps.googleapis.com/maps/api/geocode/json';
    var _latlng=$('#lat').val()+","+$('#lon').val();

    $.get(
        query,
        {
            latlng:_latlng,
            language:"ru"
        },
        function(data)
        {

            if(data.status=='OK')
            {
                $('#address').val(data.results[0].formatted_address);
            }
            else
            {
                alert(data.status);
            }
        },'json');
}
function findposition()
{
    var query = "http://maps.googleapis.com/maps/api/geocode/json";
    var addr = $('#address').val();
console.log(addr);


    if(addr!='')
    {
        /*' var regV = /ñî÷è/gi;     // øàáëîí
         var result = addr.match(regV);  // ïîèñê øàáëîíà â þðë
         if (result) */
        $.get(
            query,
            {
                sensor:"true",
                language:'ru',
                address:addr
            },
            function(data)
            {
                if(data.results.length>0 && data.results[0].geometry.location!='undefined')
                {
                    $('#lat').val(data.results[0].geometry.location.lat);
                    $('#lon').val(data.results[0].geometry.location.lng);
                    getAddress();
                    initialize(data.results[0].geometry.location.lat,data.results[0].geometry.location.lng);
                }
                else
                {
                    alert(data.status);
                }
            },'json');
    }
}

initialize();