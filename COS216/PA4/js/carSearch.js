//u22561154, Yi-rou Hung

// document.addEventListener('DOMContentLoaded', function() {
// const form = document.querySelector('form');
//     form.addEventListener('submit', (event) => {
//     event.preventDefault();

// function loadImages(brand, model, id){
//     const xhttp = new XMLHttpRequest();
//     xhttp.onreadystatechange = function() {
//         if (this.readyState == 4 && this.status == 200) {
//             document.getElementById("carimg"+id).setAttribute("src", this.responseText);
//         }
//     }
    
//     xhttp.open("GET", "https://wheatley.cs.up.ac.za/api/getimage?brand="+brand+"&model="+model, true);
//     xhttp.send();
//   }

// function carSearch() {
//     const searchInput = document.getElementById('carSearch').value;

//     const xhttp = new XMLHttpRequest();
//     xhttp.onreadystatechange = function() {
//         if (this.readyState == 4 && this.status == 200) {
//             var obj = JSON.parse(this.responseText);
//             var inner = document.getElementById("carSearch");
            
//             inner.innerHTML = "";
//             for(let i = 0; i <= 499; i++){
//                 inner.innerHTML += "<li class = 'col' >"
//                                    +"<li class = 'content' >"
//                                     + "<img class = 'carImage' id = 'carimg"+ i +"' style='width:33%'>"   
//                                     + "<h2 class = 'carName'>"                                                                     
//                                     + obj.data[i].make + " " + obj.data[i].model + " " + obj.data[i].series +"</h2>" 
//                                     + "<p class = 'carDescription'>"
//                                     + "Years Manufactured: " + obj.data[i].year_from + " - " + obj.data[i].year_to + "<br>"
//                                     + "Body Type: " + obj.data[i].body_type + "<br>"
//                                     + "Trim: " + obj.data[i].trim + "<br>"
//                                     + "Number of Cylinders: " + obj.data[i].number_of_cylinders + "<br>"
//                                     + "Engine Type: "+ obj.data[i].engine_type + "<br>"
//                                     + "Driven Wheels: "+ obj.data[i].drive_wheels + "<br>"
//                                     + "Transmission: "+ obj.data[i].transmission + "<br>"
//                                     + "Max Speed: " + obj.data[i].max_speed_km_per_h +"km/h<br>"
//                                     + "</p></li></li>";
                
//                 loadImages(obj.data[i].make, obj.data[i].model, i);
//             }
//             "</li></li>";
//             if(document.getElementById("carSearch").innerHTML === ''){
//             console.log("Error loading");}
//         }
        
//     }
  

// var opt = JSON.stringify({
//     "studentnum":"u22561154",
//     "type":"GetAllCars",
//     "limit":20,
//     "apikey":"a9198b68355f78830054c31a39916b7f",
//     "search": {
//         "make" : searchInput},
//     "return": "*"
// })
  
//     xhttp.open("POST", "https://wheatley.cs.up.ac.za/api/", true);
//     xhttp.send(opt);

// } 
// carSearch();
// });
// });

const carsApi = "https://wheatley.cs.up.ac.za/u22561154/api.php";
const form = document.querySelector('form');
const makeInput = document.querySelector('#make');
const modelInput = document.querySelector('#model');
const imgApi = "https://wheatley.cs.up.ac.za/api/getimage";
const button = document.getElementById('submit-btn');

function loadimgs(brand, model, no)
{
  const imgs = new XMLHttpRequest();
  imgs.onload = function() 
  {
    //status check
    if (this.readyState == 4 && this.status == 200) 
    {
      document.getElementById("car-image" + no).setAttribute("src", this.responseText);
    }
  }
  imgs.open("GET", imgApi + "?brand=" + brand + "&model=" + model, true);
  imgs.send();
}

if (button) {
  button.addEventListener('submit', myFunction);
}
form.addEventListener('submit', (event) => {
  event.preventDefault();
  
  document.getElementById("carblock").innerHTML = "";
  document.getElementById("found").innerHTML = "";

  const make = makeInput.value;
  const model = modelInput.value;


  function search()
{
  var foundCar = new XMLHttpRequest();
  foundCar.onload = function() 
  {
    //status check 
    if (this.readyState == 4 && this.status == 200) 
    {
      var car = JSON.parse(this.responseText);
      // startLoading(); this for loading icon but its not working
      for (let i = 0; i < 499; i++)
      {
        if(car.data[i].make == make && car.data[i].model==model){
          document.getElementById("found").innerHTML += 
          "<div class = 'car-section-new'>" +
          "<img class = 'carImage' id = 'car-image"+ i +"' src = ''>"  +
          "<div id = 'car-info'><h2 class = 'carName' id = 'car-title'>" +                                                                    
          car.data[i].make + " " + car.data[i].model + " " + car.data[i].series +"</h2>" +
          "<p class = 'carDescription' id = 'car-info'></p>" +
          "Years Manufactured: " + car.data[i].year_from + " - " + car.data[i].year_to + "<br>" + 
          "Body Type: " + car.data[i].body_type + "<br>" + 
          "Trim: " + car.data[i].trim + "<br>" +
          "Number of Cylinders: " + car.data[i].number_of_cylinders + "<br>" +
          "Engine Type: "+ car.data[i].engine_type + "<br>" +
          "Driven Wheels: "+ car.data[i].drive_wheels + "<br>" + 
          "Transmission: "+ car.data[i].transmission + "<br>" +
          "Max Speed: " + car.data[i].max_speed_km_per_h +"km/h<br>" +
          "</p></div>";
          loadimgs(car.data[i].make, car.data[i].model, i);
        }
      }
      if(document.getElementById("found").innerHTML === ''){
        document.getElementById("found").innerHTML = "No car found";
      }
    }
  }

  var infoSend = JSON.stringify
  ({
      "studentnum":"u22561154",
      "apikey":"33897045fb42b6c7",
      "type":"GetAllCars",
      "return": ['id_trim', 'make', 'model', 'generation', 'year_from', 'year_to', 'series', 'trim', 'body_type', 'number_of_seats',
      'length_mm', 'width_mm', 'height_mm', 'number_of_cylinders', 'engine_type', 'drive_wheels', 'transmission', 'max_speed_km_per_h'],
      "limit":500
  })

  foundCar.open("POST", carsApi, true);
  foundCar.send(infoSend);
}
search();
});