//u22561154, Yi-rou Hung

var form = document.getElementById("myForm");

//TRANSMISSION
function getTranValue() {
    var transmission = document.querySelector('input[name="TranType"]:checked').value;
    console.log(transmission);
  }
//SEAT
function getSeat() {
    var seat = document.querySelector('input[name="seat"]:checked').value;
    console.log(seat);
  }
//MAKE
function getMake() {
    var make = [];
    var doc = document.querySelectorAll('input[name="make"]:checked');
    for (var i = 0; i < doc.length; i++) {
      make.push(doc[i].value);
    }
    console.log(make);
  }


function loadImages(brand, model, id){
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("carimg"+id).setAttribute("src", this.responseText);
        }
    }
    
    xhttp.open("GET", "https://wheatley.cs.up.ac.za/api/getimage?brand="+brand+"&model="+model, true);
    xhttp.send();
  }

form.addEventListener('submit', (event) => {
event.preventDefault();
// document.getElementById("carblock").innerHTML = "";
// document.getElementById("CarFind").innerHTML = "";

function FindCar(){
// FUEL
var fuel = document.getElementById("fuel").value;
console.log(fuel);
//BODY TYPE
var bodyType = document.getElementById("BodyType").value;
console.log(bodyType);
//MODEL
    // document.querySelector('form').addEventListener('submit', function(event) {
    // event.preventDefault(); // Prevent form submission
    // var nameValue = document.getElementById("name").value;
    // console.log(nameValue);
    // });


    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        if (this.readyState == 4 && this.status == 200) {
            var obj = JSON.parse(this.responseText);
            var inner = document.getElementById("CarFind");
            
            inner.innerHTML = "";
            for(let i = 0; i <= 499; i++){
                inner.innerHTML += "<li class = 'col' >"
                                   +"<li class = 'content' >"
                                    + "<img class = 'carImage' id = 'carimg"+ i +"' style='width:33%'>"   
                                    + "<h2 class = 'carName'>"                                                                     
                                    + obj.data[i].make + " " + obj.data[i].model + " " + obj.data[i].series +"</h2>" 
                                    + "<p class = 'carDescription'>"
                                    + "Years Manufactured: " + obj.data[i].year_from + " - " + obj.data[i].year_to + "<br>"
                                    + "Body Type: " + obj.data[i].body_type + "<br>"
                                    + "Trim: " + obj.data[i].trim + "<br>"
                                    + "Number of Cylinders: " + obj.data[i].number_of_cylinders + "<br>"
                                    + "Engine Type: "+ obj.data[i].engine_type + "<br>"
                                    + "Driven Wheels: "+ obj.data[i].drive_wheels + "<br>"
                                    + "Transmission: "+ obj.data[i].transmission + "<br>"
                                    + "Max Speed: " + obj.data[i].max_speed_km_per_h +"km/h<br>"
                                    + "</p></li></li>";
                
                loadImages(obj.data[i].make, obj.data[i].model, i);
            }
            "</li></li>";
            if (document.getElementById("found").innerHTML === '')
            {
            document.getElementById("found").innerHTML = "No car found";
            }
        }
        
    }
  

var opt = JSON.stringify({
    "studentnum":"u22561154",
    "type":"GetAllCars",
    "limit":8,
    "apikey":"a9198b68355f78830054c31a39916b7f",
    "search":{
        "body_type" : bodyType,
        "engine_type": fuel,
        // "transmission":getTranValue(),
        // "number_of_seats": getSeat(),
        // "make": getMake()
    },
    "fuzzy": true,
    "return":"*"
})
  
    xhttp.open("POST", "https://wheatley.cs.up.ac.za/api/", true);
    xhttp.send(opt);

}
FindCar();
});