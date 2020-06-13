//Global Variables
var map;
var geocoder;
var infowind;
var latitude;
var longitude;
var address;
var directionsService;
var directionsDisplay;

//Function from API call...chanhed from initMap() to loadMap
function loadMap()
{
  directionsService = new google.maps.DirectionsService();
  directionsDisplay = new google.maps.DirectionsRenderer();
  geocoder = new google.maps.Geocoder();      //geocoder call
  var location = JSON.parse(document.getElementById('loc').innerHTML);  ////parses the value stored in $location whose id=loc and store it in variable loc
  getAddress(location);

  var get = JSON.parse(document.getElementById('all').innerHTML);
  showCoustomer(get);

   address = new google.maps.LatLng(latitude,longitude);
    var mapOptions = {
      zoom: 14,
      center: address
    };

  infowind = new google.maps.InfoWindow();  //Will provide info when marker is clicked or mouseover


  map = new google.maps.Map(document.getElementById('map'), mapOptions);

  var marker = new google.maps.Marker({
    position: address,
    map: map,
    label:'A'
  });


  marker.addListener('mouseover',function(){

    infowind.setContent("Your Address");
    infowind.open(map,marker);
  });




  var sdata = JSON.parse(document.getElementById('data').innerHTML);  //parses the value stored in $store whose id=data and store it in variable sdata

  codeAddress(sdata);                         //This function will return the latitude and longitude of address from $store

  var allData = JSON.parse(document.getElementById('allData').innerHTML);  //parses the value stored in $allData whose id=allData and store it in variable allDdata
  showAllStores(allData);                      //This function will show all the stores in the map.



}

function getAddress(location)
{
  Array.prototype.forEach.call(location,function(data){
    var address = data.address;
    geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == 'OK') {
        map.setCenter(results[0].geometry.location);
        var points = {};
        points.id = data.id;
        points.lat = map.getCenter().lat();
        points.lng = map.getCenter().lng();
        console.log(latitude);
        console.log(longitude);
        updateCoustomerWithLatLng(points);
      }
      else {
        alert('Geocode was not successful for the following reason: ' + status);
      }
    });
  });
}


function updateCoustomerWithLatLng(points)
{
  console.log(points);
  $.ajax({
    url: "update.php",
    method: "post",
    data: points,
    success: function(res){
      console.log(res);
    }
  });
}



function showCoustomer(get)
{

  Array.prototype.forEach.call(get,function(data){    //loop to fetch all data

    latitude = data.lat;
    longitude = data.lng;
    console.log(latitude);
    console.log(longitude);

  });
}




function codeAddress(sdata)
{
  Array.prototype.forEach.call(sdata,function(data){  //loop to fetch all data
    var address = data.name + ' ' + data.address;
    geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == 'OK') {
        map.setCenter(results[0].geometry.location);
        var points = {};
        points.id = data.id;
        points.lat = map.getCenter().lat();
        points.lng = map.getCenter().lng();
        updateStoreWithLatLng(points);
        console.log(results[0].geometry.location);
      } else {
        alert('Geocode was not successful for the following reason: ' + status);
      }
    });
  });
}

function updateStoreWithLatLng(points)
{
  console.log(points);
  $.ajax({
    url: "action.php",
    method: "post",
    data: points,
    success: function(res){
      console.log(res);
    }
  });
}


function showAllStores(allData)                //This function will show all the stores in the map.
{
  var infowind = new google.maps.InfoWindow();
  Array.prototype.forEach.call(allData,function(data){    //loop to fetch all data
    var content = document.createElement('div');
    var strong = document.createElement('strong');
    strong.textContent = data.name;
    content.appendChild(strong);

    var marker = new google.maps.Marker({
      position: new google.maps.LatLng(data.lat,data.lng),
      map: map
    });



    marker.addListener('mouseover',function(){

      infowind.setContent(content);
      infowind.open(map,marker);
    });

    marker.addListener('click',function(){
      directionsDisplay.setMap(map);
      var dest = new google.maps.LatLng(data.lat,data.lng);
      calculateRoute();
      function calculateRoute()
      {
        var request = {
          origin: address,
          destination: dest,
          travelMode: 'DRIVING'
        };

        directionsService.route(request, function(result,status){
          directionsDisplay.setDirections(result);
        });
      }

    });

  });
}
