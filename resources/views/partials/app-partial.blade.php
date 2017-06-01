@extends('layouts.app')

@section('MetaTags')

    <!--META tags-->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Facebook Open Graph tags to customize link previews.
    Learn more: https://developers.facebook.com/docs/sharing/webmasters -->
    <meta property="og:url"           content="http://www.beauty.dev" /> <!--TODO: Вписать корректный домен-->
    <meta property="og:type"          content="website" />              <!--TODO: Вписать корректный тип-->
    <meta property="og:title"         content="Your Website Title" />   <!--TODO: Вписать корректный заголовок-->
    <meta property="og:description"   content="Your description" />     <!--TODO: Вписать корректное описание-->
    <meta property="og:image"         content="http://www.beauty.dev/img/GREET-SLIDE-FON.png" /><!--TODO: Вписать корректный домен-->

@endsection

@section('Title')

    <!-- Page Titile -->
    <title>Белый сад</title>

@endsection

@section('Scripts')

    <!-- Laravel csrfToken -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>

    <!--Google map-->
    <script src="https://maps.googleapis.com/maps/api/js?key=&extension=.js"></script>
    <script src="https://cdn.mapkit.io/v1/infobox.js"></script>
    <script>
        google.maps.event.addDomListener(window, 'load', init);
        var map, markersArray = [];

        function bindInfoWindow(marker, map, location) {
            google.maps.event.addListener(marker, 'click', function() {
                function close(location) {
                    location.ib.close();
                    location.infoWindowVisible = false;
                    location.ib = null;
                }

                if (location.infoWindowVisible === true) {
                    close(location);
                } else {
                    markersArray.forEach(function(loc, index){
                        if (loc.ib && loc.ib !== null) {
                            close(loc);
                        }
                    });

                    var boxText = document.createElement('div');
                    boxText.style.cssText = 'background: #fff;';
                    boxText.classList.add('md-whiteframe-2dp');

                    function buildPieces(location, el, part, icon) {
                        if (location[part] === '') {
                            return '';
                        } else if (location.iw[part]) {
                            switch(el){
                                case 'photo':
                                    if (location.photo){
                                        return '<div class="iw-photo" style="background-image: url(' + location.photo + ');"></div>';
                                    } else {
                                        return '';
                                    }
                                    break;
                                case 'iw-toolbar':
                                    return '<div class="iw-toolbar"><h3 class="md-subhead">' + location.title + '</h3></div>';
                                    break;
                                case 'div':
                                    switch(part){
                                        case 'email':
                                            return '<div class="iw-details"><i class="material-icons" style="color:#4285f4;"><img src="//cdn.mapkit.io/v1/icons/' + icon + '.svg"/></i><span><a href="mailto:' + location.email + '" target="_blank">' + location.email + '</a></span></div>';
                                            break;
                                        case 'web':
                                            return '<div class="iw-details"><i class="material-icons" style="color:#4285f4;"><img src="//cdn.mapkit.io/v1/icons/' + icon + '.svg"/></i><span><a href="' + location.web + '" target="_blank">' + location.web_formatted + '</a></span></div>';
                                            break;
                                        case 'desc':
                                            return '<label class="iw-desc" for="cb_details"><input type="checkbox" id="cb_details"/><h3 class="iw-x-details">Details</h3><i class="material-icons toggle-open-details"><img src="//cdn.mapkit.io/v1/icons/' + icon + '.svg"/></i><p class="iw-x-details">' + location.desc + '</p></label>';
                                            break;
                                        default:
                                            return '<div class="iw-details"><i class="material-icons"><img src="//cdn.mapkit.io/v1/icons/' + icon + '.svg"/></i><span>' + location[part] + '</span></div>';
                                            break;
                                    }
                                    break;
                                case 'open_hours':
                                    var items = '';
                                    if (location.open_hours.length > 0){
                                        for (var i = 0; i < location.open_hours.length; ++i) {
                                            if (i !== 0){
                                                items += '<li><strong>' + location.open_hours[i].day + '</strong><strong>' + location.open_hours[i].hours +'</strong></li>';
                                            }
                                            var first = '<li><label for="cb_hours"><input type="checkbox" id="cb_hours"/><strong>' + location.open_hours[0].day + '</strong><strong>' + location.open_hours[0].hours +'</strong><i class="material-icons toggle-open-hours"><img src="//cdn.mapkit.io/v1/icons/keyboard_arrow_down.svg"/></i><ul>' + items + '</ul></label></li>';
                                        }
                                        return '<div class="iw-list"><i class="material-icons first-material-icons" style="color:#4285f4;"><img src="//cdn.mapkit.io/v1/icons/' + icon + '.svg"/></i><ul>' + first + '</ul></div>';
                                    } else {
                                        return '';
                                    }
                                    break;
                            }
                        } else {
                            return '';
                        }
                    }

                    boxText.innerHTML =
                        buildPieces(location, 'photo', 'photo', '') +
                        buildPieces(location, 'iw-toolbar', 'title', '') +
                        buildPieces(location, 'div', 'address', 'location_on') +
                        buildPieces(location, 'div', 'web', 'public') +
                        buildPieces(location, 'div', 'email', 'email') +
                        buildPieces(location, 'div', 'tel', 'phone') +
                        buildPieces(location, 'div', 'int_tel', 'phone') +
                        buildPieces(location, 'open_hours', 'open_hours', 'access_time') +
                        buildPieces(location, 'div', 'desc', 'keyboard_arrow_down');

                    var myOptions = {
                        alignBottom: true,
                        content: boxText,
                        disableAutoPan: true,
                        maxWidth: 0,
                        pixelOffset: new google.maps.Size(-140, -40),
                        zIndex: null,
                        boxStyle: {
                            opacity: 1,
                            width: '280px'
                        },
                        closeBoxMargin: '0px 0px 0px 0px',
                        infoBoxClearance: new google.maps.Size(1, 1),
                        isHidden: false,
                        pane: 'floatPane',
                        enableEventPropagation: false
                    };

                    location.ib = new InfoBox(myOptions);
                    location.ib.open(map, marker);
                    location.infoWindowVisible = true;
                }
            });
        }

        function init() {
            var mapOptions = {
                center: new google.maps.LatLng(48.46815594337974,35.05737772090153),
                zoom: 16,
                gestureHandling: 'auto',
                fullscreenControl: true,
                zoomControl: true,
                disableDoubleClickZoom: true,
                mapTypeControl: false,
                scaleControl: true,
                scrollwheel: false,
                streetViewControl: false,
                draggable : true,
                clickableIcons: false,
                mapTypeControlOptions: {
                    position: google.maps.ControlPosition.TOP_LEFT
                },
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                styles: [{"featureType":"landscape","stylers":[{"hue":"#F1FF00"},{"saturation":-27.4},{"lightness":9.4},{"gamma":1}]},{"featureType":"road.highway","stylers":[{"hue":"#0099FF"},{"saturation":-20},{"lightness":36.4},{"gamma":1}]},{"featureType":"road.arterial","stylers":[{"hue":"#00FF4F"},{"saturation":0},{"lightness":0},{"gamma":1}]},{"featureType":"road.local","stylers":[{"hue":"#FFB300"},{"saturation":-38},{"lightness":11.2},{"gamma":1}]},{"featureType":"water","stylers":[{"hue":"#00B6FF"},{"saturation":4.2},{"lightness":-63.4},{"gamma":1}]},{"featureType":"poi","stylers":[{"hue":"#9FFF00"},{"saturation":0},{"lightness":0},{"gamma":1}]}]
            }
            var mapElement = document.getElementById('mapkit-1595');
            var map = new google.maps.Map(mapElement, mapOptions);
            var locations = [
                {"title":"HDRM","address":"узвіз Крутогірний, 30, Дніпро́, Дніпропетровська область, Украина","desc":"","tel":"067 911 4420","int_tel":"+380 67 911 4420","email":"","web":"","web_formatted":"","open":"Open","time":"1327","lat":48.467700670506936,"lng":35.05699148280337,"vicinity":"узвіз Крутогірний, 30, Дніпро́","open_hours":[{"day":"понедельник","hours":"10–22","$$hashKey":"object:935"},{"day":"вторник","hours":"10–22","$$hashKey":"object:936"},{"day":"среда","hours":"10–22","$$hashKey":"object:937"},{"day":"четверг","hours":"10–22","$$hashKey":"object:938"},{"day":"пятница","hours":"10–22","$$hashKey":"object:939"},{"day":"суббота","hours":"10–22","$$hashKey":"object:940"},{"day":"воскресенье","hours":"закрыто","$$hashKey":"object:941"}],"iw":{"address":true,"desc":true,"email":true,"enable":true,"int_tel":true,"open":true,"open_hours":true,"photo":true,"tel":true,"title":true,"web":true}}
            ];

            var layer = new google.maps.BicyclingLayer();
            layer.setMap(map);

            for (i = 0; i < locations.length; i++) {
                marker = new google.maps.Marker({
                    icon: locations[i].marker,
                    position: new google.maps.LatLng(locations[i].lat, locations[i].lng),
                    map: map,
                    title: locations[i].title,
                    address: locations[i].address,
                    desc: locations[i].desc,
                    tel: locations[i].tel,
                    int_tel: locations[i].int_tel,
                    vicinity: locations[i].vicinity,
                    open: locations[i].open,
                    open_hours: locations[i].open_hours,
                    photo: locations[i].photo,
                    time: locations[i].time,
                    email: locations[i].email,
                    web: locations[i].web,
                    iw: locations[i].iw
                });
                markersArray.push(marker);

                if (locations[i].iw.enable === true){
                    bindInfoWindow(marker, map, locations[i]);
                }
            }

            google.maps.event.addDomListener(window, 'resize', function() {
                map.setCenter(mapOptions.center);
            });
        }
    </script>

@endsection

@section('VueJs')
    <!-- Vue Js Files -->
    <script src="/js/app.js" defer></script>
@endsection

@section('Styles')

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet" type="text/css">

    <!-- Google map-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
    <link href="https://cdn.mapkit.io/v1/infobox.css" rel="stylesheet" >
    <style>
        #mapkit-1595 {
            height: 100%;
            width: 100%;
        }
    </style>

    <style>

        html, body {
            width:      100%;
            height:     100%;
        }

    </style>

@endsection