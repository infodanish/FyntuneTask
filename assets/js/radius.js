jQuery(function(){
	

  var map;
var Circles = [
    {
        lat: 19.019724,
        lon: 72.843229, 
        circle_options: {
            radius: 230,
            editable: true
        },
        stroke_options: {
            strokeColor: '#2e6da4',
            strokeWeight: 1.5,
            fillColor: '#337ab7',
            fillOpacity: 0.4
        },
        title: 'Editable circle',
        html: 'Change my size',
        visible: false,
        type: 'circle',
    },
    {
        lat: 19.028605,
        lon: 72.853501,
		
        title: 'A1',
        html: 'A1',
    },
    {
        lat: 19.029133,
        lon: 72.843502, 
        title: 'A2',
        html: 'A2',
    },
    {
        lat: 19.019558,
        lon: 72.856205, 
        title: 'A3',
        html: 'A3',
    },
    {
        lat: 19.009252,
        lon: 72.852772, 
        title: 'A4',
        html: 'A4',
    },
    {
        lat: 19.000407,
        lon: 72.840798, 
        title: 'A5',
        html: 'A5',
    },
    {
        lat: 19.006636,
        lon: 72.834265, 
        title: 'A6',
        html: 'A6',
    }
];
  
 map = new Maplace({
    locations: Circles,
    map_div: '#gmap',
    start: 0,
   
    generate_controls: false,
    shared: {
        zoom: 16,
        html: '%index'
    },
    circleRadiusChanged: function(index, point, marker) {
      
    var modifiedLocations =   [{
        lat: 51.51328,
        lon: -0.09021,
        circle_options: {
            radius: marker.getRadius(),
            editable: true
        },
        stroke_options: {
            strokeColor: '#2e6da4',
            strokeWeight: 1.5,
            fillColor: '#337ab7',
            fillOpacity: 0.4
        },
        title: 'Editable circle',
        html: 'Change my size',
        visible: false,
        type: 'circle',
    }];
      
      jQuery('#radiusInfo').text('radius: ' + marker.getRadius() + 'mt.');
      for(var i=1; i<Circles.length; i++) {
        var contains = calcDistance(Circles[i].lat,Circles[i].lon) <= marker.getRadius();
        if(contains) {
          modifiedLocations.push(Circles[i]);
        }
      }
      map.SetLocations(modifiedLocations).Load();
    }
  }).Load();  
});

function calcDistance(lat, lon){
  var p1 = new google.maps.LatLng(19.077006,72.876367);
  var p2 = new google.maps.LatLng(lat, lon);
  return (google.maps.geometry.spherical.computeDistanceBetween(p1, p2));
}