//u22561154, Yi-rou Hung


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

  document.getElementById("carblock").innerHTML = "";
  document.getElementById("FilterEngine").innerHTML = "";

function FilterEngine(){
    // Get the dropdown element
    // var mydropdown = document.querySelector('.mydropdown');
    var mydropdown = document.getElementById("mydropdown");
    var selectOption = mydropdown.value ;


    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        if (this.readyState == 4 && this.status == 200) {
            var obj = JSON.parse(this.responseText);
            var inner = document.getElementById("FilterEngine");
            
            inner.innerHTML = "";
            for(let i = 1; i <= 10; i++){
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
            // "</li></li>";
        }
        
    }
  

var opt = JSON.stringify({
    "studentnum":"u22561154",
    "type":"GetAllCars",
    "limit":10,
    "apikey":"a9198b68355f78830054c31a39916b7f",
    "search": {
        "engine_type" : selectOption},
    "order": "ASC",
    "return": "*"
})
  
    xhttp.open("POST", "https://wheatley.cs.up.ac.za/api/", true);
    xhttp.send(opt);

}
// FilterEngine();
