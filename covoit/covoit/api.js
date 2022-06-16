
function coordonnees(address){
  var address_coord = address.replace(",", "%2C");
  address_coord = address_coord.replace(/ /g, "%20");
  
  var contenu = [];
  var requestOptions = {
    method: 'GET',
    async: 'false',
  };
  
  fetch("https://api.geoapify.com/v1/geocode/search?text="+address_coord+"%2C%20France&apiKey=d2b37dc55f884f6e87846d186b1467a2", requestOptions)
      .then(response => response.json())
      .then(function(result){
          contenu[0] = result.features[0].bbox[1];
          contenu[1] = result.features[0].bbox[2];
      } )
      .catch(error => console.log('error', error));
  return contenu;
  
}


  function distance(address1, address2){
    console.log(address1);
    console.log(address2);
    var long1 = address1[0];
    var lat1 = address1[1];
    var long2 = address2[0];
    var lat2 = address2[1];
    var duree;
    const data = null;
    const xhr = new XMLHttpRequest();
    xhr.withCredentials = true;
  
    xhr.addEventListener("readystatechange", function () {
        if (this.readyState === this.DONE) {
          console.log(this.responseText);
          const json = this.response;
          const obj = JSON.parse(json);
          duree = obj.durations[0][0];
        }
      }
    );
  
    xhr.open("GET", "https://trueway-matrix.p.rapidapi.com/CalculateDrivingMatrix?origins="+long1+"%2C"+lat1+"&destinations="+long2+"%2C"+lat2+"&avoid_highways=false&avoid_tolls=false&avoid_ferries=false", false);
    xhr.setRequestHeader("X-RapidAPI-Key", "7903051bc6msh318f22cf98472a8p15a26cjsn9e76ef47b9ba");
    xhr.setRequestHeader("X-RapidAPI-Host", "trueway-matrix.p.rapidapi.com");
  
    xhr.send(data);
    return duree;
  }
  
  
  
  