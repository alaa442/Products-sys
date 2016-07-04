
  var markerArr = new Array();

  function clearOverlays() {
    if (markerArr) {
      for (i in markerArr) {
        markerArr[i].setVisible(false)
      }
    console.log("clear");
    }
  }

function ajaxCall() {
  alert("hi");
  var marker,i;
   $.ajax({
        type: "GET",
        url : '{{ url("api/map") }}',
        success: function(response) {
           // console.log(response); 
          var jArray = JSON.parse(response);
          // console.log(jArray.locations[0].Lat);
          var infowindow = new google.maps.InfoWindow();
          for (i = 0; i < jArray.locations.length; i++) { 
              if (jArray.locations[i].Status == 0) {
                  marker = new google.maps.Marker({
                      position: new google.maps.LatLng(jArray.locations[i].Lat, jArray.locations[i].Long),
                      map: map
                  });
              }

              else if (jArray.locations[i].Status == 1){
                 marker = new google.maps.Marker({
                         position: new google.maps.LatLng(jArray.locations[i].Lat, jArray.locations[i].Long),
                        map: map,
                       icon: 'http://maps.google.com/mapfiles/ms/icons/green-dot.png'
                    });
              }
        var geocoder = new google.maps.Geocoder();
        var latitude = jArray.locations[i].Lat;
        var longitude = jArray.locations[i].Long;
        var address_arr = new Array();
        var latLng = new google.maps.LatLng(latitude,longitude);
        geocoder.geocode({       
            latLng: latLng     
          }, 
        function(responses) 
            {     
              if (responses && responses.length > 0) {    
                  address_arr.push(responses[0].formatted_address); 
              } 
              else{     
                  address_arr[i] = 'Not getting address for given latitude and longitude';  
              }   
            }
        );
    google.maps.event.addListener(marker, 'click', (function(marker, i) {
          return function() {           
            infowindow.setContent('Name '+jArray.locations[i].user_id+'<br/> Address '+address_arr[i] +' <br/> Contractor Name '+ jArray.locations[i].Contractor_Name+'<br/>Code '+jArray.locations[i].Contractor_Code);
            infowindow.open(map, marker);
          }
        })(marker, i));

    markerArr[i]=marker;
    }
  console.log(markerArr);
}}).always(function() {
      setTimeout(clearOverlays, 9999); // 9.99 seconds
      setTimeout(ajaxCall, 10000); // 10 seconds
   });
}

var name;
var date;

function FilterValue() {
    alert("hi");
    var selectedIndex = document.getElementById('username').selectedIndex;
    name = document.getElementById('username')[selectedIndex].value;
    date = document.getElementById('date').value;
    $.ajax({
          type: "GET",
          url : 'api/gps/filter/name/'+name+'/date/'+date,
          success: function(response,xhr) {
            console.log(xhr.status);
          },
           error: function() {
            alert("error"); 
          }}
       );
}