//u22561154, Yi-rou Hung

//                                    +"<li class = 'content' >"
//                                     + "<img class = 'carImage' id = 'carimg"+ i +"' style='width:33%'>"   
//                                     + "<h2 class = 'carName'>"                                                                     
//                                     + obj.data[i].make + " " + obj.data[i].model + " " + obj.data[i].series +"</h2>" 
//                                     + "<p class = 'carDescription'>"
//                                     + "Years Manufactured: " + obj.data[i].year_from + " - " + obj.data[i].year_to + "<br>"
//                                     + "Body Type: " + obj.data[i].body_type + "<br>"
//                                     + "Trim: " + obj.data[i].trim + "<br>"
//                                     + "Number of Cylinders: " + obj.data[i].number_of_cylinders + "<br>"

// const carsApi = "https://wheatley.cs.up.ac.za/api/";
// const form = document.querySelector('form');
// const carMake1 = document.getElementById("make1");
// const carMake2 = document.getElementById("make1");
// const carModel1 = document.getElementById("model1");
// const carModel2 = document.getElementById("model2");
// const imgApi = "https://wheatley.cs.up.ac.za/api/getimage";
// const button1 = document.getElementById('submit1');

// function loadimgs1(brand, model)
// {
//   const imgs = new XMLHttpRequest();
//   imgs.onload = function() 
//   {
//     //status check
//     if (this.readyState == 4 && this.status == 200) 
//     {
//       document.getElementById("car-image1").setAttribute("src", this.responseText);
//     }
//   }
//   imgs.open("GET", imgApi + "?brand=" + brand + "&model=" + model, true);
//   imgs.send();
// }

// function loadimgs2(brand, model)
// {
//   const imgs = new XMLHttpRequest();
//   imgs.onload = function() 
//   {
//     //status check
//     if (this.readyState == 4 && this.status == 200) 
//     {
//       document.getElementById("car-image2").setAttribute("src", this.responseText);
//     }
//   }
//   imgs.open("GET", imgApi + "?brand=" + brand + "&model=" + model, true);
//   imgs.send();
// }



// //CAR 1
// if (button1) {
//   button1.addEventListener('submit', myFunction);
// }
// form.addEventListener('submit', (event) => {
//   event.preventDefault();
  

//   const carMake1Input = carMake1.value;
//   const carModel1Input = carModel1.value;
//   const carMake2Input = carMake1.value;
//   const carModel2Input = carModel1.value;

//   function search1()
// {
//   var foundCar = new XMLHttpRequest();
//   foundCar.onload = function() 
//   {
//     //status check 
//     if (this.readyState == 4 && this.status == 200) 
//     {
//       var car = JSON.parse(this.responseText);
//       // startLoading(); this for loading icon but its not working
//       for (let i = 0; i < 499; i++)
//       {
//         if(car.data[i].make == carMake1Input && car.data[i].model==carModel1Input){
//           document.getElementById("compare1").innerHTML += 
//           "<div class = 'car-section-new'>" +
//           "<img class = 'carImage' id = 'car-image"+ i +"' src = ''>"  +
//           "<div id = 'car-info'><h2 class = 'carName' id = 'car-title'>" +                                                                    
//           car.data[i].make + " " + car.data[i].model + " " + car.data[i].series +"</h2>" +
//           "<p class = 'carDescription' id = 'car-info'></p>" +
//           "Years Manufactured: " + car.data[i].year_from + " - " + car.data[i].year_to + "<br>" + 
//           "Body Type: " + car.data[i].body_type + "<br>" + 
//           "Trim: " + car.data[i].trim + "<br>" +
//           "Number of Cylinders: " + car.data[i].number_of_cylinders + "<br>" +
//           "Engine Type: "+ car.data[i].engine_type + "<br>" +
//           "Driven Wheels: "+ car.data[i].drive_wheels + "<br>" + 
//           "Transmission: "+ car.data[i].transmission + "<br>" +
//           "Max Speed: " + car.data[i].max_speed_km_per_h +"km/h<br>" +
//           "</p></div>";
//           loadimgs1(car.data[i].make, car.data[i].model);
//         }
//       }
//       if(document.getElementById("compare1").innerHTML === ''){
//         document.getElementById("compare1").innerHTML = "No car found";
//       }
//     }
//   }

//   var infoSend = JSON.stringify
//   ({
//       "studentnum":"u22561154",
//       "apikey":"a9198b68355f78830054c31a39916b7f",
//       "type":"GetAllCars",
//       //remove whatever information you dont want to display
//       "return":"*",
//       "limit":1
//   })

//   foundCar.open("POST", carsApi, true);
//   foundCar.send(infoSend);
// }
// search1();
// // });



//   function search2()
//   {
//   var foundCar = new XMLHttpRequest();
//   foundCar.onload = function() 
//   {
//     //status check 
//     if (this.readyState == 4 && this.status == 200) 
//     {
//       var car = JSON.parse(this.responseText);

//       for (let i = 0; i < 499; i++)
//       {
//         if(car.data[i].make == carMake2Input && car.data[i].model==carModel2Input){
//             document.getElementById("compare2").innerHTML += 
//             "<div class = 'car-section-new'>" +
//             "<img class = 'carImage' id = 'car-image"+ i +"' src = ''>"  +
//             "<div id = 'car-info'><h2 class = 'carName' id = 'car-title'>" +                                                                    
//             car.data[i].make + " " + car.data[i].model + " " + car.data[i].series +"</h2>" +
//             "<p class = 'carDescription' id = 'car-info'></p>" +
//             "Years Manufactured: " + car.data[i].year_from + " - " + car.data[i].year_to + "<br>" + 
//             "Body Type: " + car.data[i].body_type + "<br>" + 
//             "Trim: " + car.data[i].trim + "<br>" +
//             "Number of Cylinders: " + car.data[i].number_of_cylinders + "<br>" +
//             "Engine Type: "+ car.data[i].engine_type + "<br>" +
//             "Driven Wheels: "+ car.data[i].drive_wheels + "<br>" + 
//             "Transmission: "+ car.data[i].transmission + "<br>" +
//             "Max Speed: " + car.data[i].max_speed_km_per_h +"km/h<br>" +
//             "</p></div>";
//             loadimgs2(car.data[i].make, car.data[i].model);
//           }
//       }
//       // if (document.getElementById("compare2").innerHTML === '')
//       // {
//       //   document.getElementById("compare2").innerHTML = "No car found";
//       // }
//     }
//   }

//   var infoSend = JSON.stringify
//   ({
//       "studentnum":"u22561154",
//       "apikey":"a9198b68355f78830054c31a39916b7f",
//       "type":"GetAllCars",
//       "return": ['id_trim', 'make', 'model', 'generation', 'year_from', 'year_to', 'series', 'trim', 'body_type', 'number_of_seats',
//       'length_mm', 'width_mm', 'height_mm', 'number_of_cylinders', 'engine_type', 'drive_wheels', 'transmission', 'max_speed_km_per_h'],
//       "limit":1
//   })

//   foundCar.open("POST", carsApi, true);
//   foundCar.send(infoSend);
// }
// search2();
// });


var carsApi = "https://wheatley.cs.up.ac.za/api/";
var imgApi = "https://wheatley.cs.up.ac.za/api/getimage";

const form = document.querySelector('form');
const make1Input = document.querySelector('#make1');
const model1Input = document.querySelector('#model1');
const make2Input = document.querySelector('#make2');
const model2Input = document.querySelector('#model2');

console.log(make1);
console.log(make2);

function loadimgs1(brand, model)
{
  const imgs = new XMLHttpRequest();
  imgs.onload = function() 
  {
    //status check
    if (this.readyState == 4 && this.status == 200) 
    {
      document.getElementById("compare1").setAttribute("src", this.responseText);
    }
  }
  if (document.getElementById("model1")==0){
  imgs.open("GET", imgApi + "?brand=" + brand, true);
  }
  else{
    imgs.open("GET", imgApi + "?brand=" + brand + "&model=" + model, true);
  }
  imgs.send();
}
function loadimgs2(brand, model)
{
  const imgs = new XMLHttpRequest();
  imgs.onload = function() 
  {
    //status check
    if (this.readyState == 4 && this.status == 200) 
    {
      document.getElementById("compare2").setAttribute("src", this.responseText);
    }
    else{
      console.log("error status");
    }
  }
  imgs.open("GET", imgApi + "?brand=" + brand + "&model=" + model, true);
  imgs.send();
}

form.addEventListener('submit', (event) => {
  event.preventDefault();
  
  const make1 = make1Input.value;
  const model1 = model1Input.value;
  const make2 = make2Input.value;
  const model2 = model2Input.value;
  function search()
  {
  var foundCar = new XMLHttpRequest();
  foundCar.onload = function() 
  {
    //status check 
    if (this.readyState == 4 && this.status == 200) 
    {
      var car = JSON.parse(this.responseText);

      for (let i = 0; i < 499; i++)
      {
        if (car.data[i].make == make1 && car.data[i].model==model1)
        {
            document.getElementById("car-1-make").innerHTML = car.data[i].make;
            document.getElementById("car-1-model").innerHTML = car.data[i].model;
            document.getElementById("car-1-year").innerHTML = car.data[i].year_from + "-" + car.data[i].year_to;
            document.getElementById("car-1-Generation").innerHTML = car.data[i].generation;
            document.getElementById("car-1-series").innerHTML = car.data[i].series;
            document.getElementById("car-1-trim").innerHTML = car.data[i].trim;
            document.getElementById("car-1-Body-type").innerHTML = car.data[i].body_type;
            document.getElementById("car-1-number_of_seats").innerHTML = car.data[i].number_of_seats;
            document.getElementById("car-1-engine").innerHTML = car.data[i].engine_type;
            document.getElementById("car-1-DW").innerHTML = car.data[i].drive_wheels;
            document.getElementById("car-1-transmission").innerHTML = car.data[i].transmission;
            document.getElementById("car-1-MS").innerHTML = car.data[i].max_speed_km_per_h;
            document.getElementById("carimgs1").innerHTML = "<img id='compare1' src=''>";
            document.getElementById("carimgs1").innerHTML += "<p>Car 1:</p>";
            document.getElementById("carimgs1").innerHTML += "<p>" + car.data[i].make + " " + car.data[i].model + "</p>";

            loadimgs1(car.data[i].make, car.data[i].model);
        }
        if (car.data[i].make == make2 && car.data[i].model==model2)
        {
            document.getElementById("car-2-make").innerHTML = car.data[i].make;
            document.getElementById("car-2-model").innerHTML = car.data[i].model;
            document.getElementById("car-2-year").innerHTML = car.data[i].year_from + "-" + car.data[i].year_to;
            document.getElementById("car-2-Generation").innerHTML = car.data[i].generation;
            document.getElementById("car-2-series").innerHTML = car.data[i].series;
            document.getElementById("car-2-trim").innerHTML = car.data[i].trim;
            document.getElementById("car-2-Body-type").innerHTML = car.data[i].body_type;
            document.getElementById("car-2-number_of_seats").innerHTML = car.data[i].number_of_seats;
            document.getElementById("car-2-engine").innerHTML = car.data[i].engine_type;
            document.getElementById("car-2-DW").innerHTML = car.data[i].drive_wheels;
            document.getElementById("car-2-transmission").innerHTML = car.data[i].transmission;
            document.getElementById("car-2-MS").innerHTML = car.data[i].max_speed_km_per_h;
            document.getElementById("carimgs2").innerHTML += "<p>Car 2:</p>";
            document.getElementById("carimgs2").innerHTML += "<p>" + car.data[i].make + " " + car.data[i].model + "</p>";

            loadimgs2(car.data[i].make, car.data[i].model);
        }
      }
      if (document.getElementById("found").innerHTML === '')
      {
        document.getElementById("found").innerHTML = "No car found";
      }
    }
  }

  var infoSend = JSON.stringify
  ({
      "studentnum":"u22561154",
      "apikey":"a9198b68355f78830054c31a39916b7f",
      "type":"GetAllCars",
      "return": ['id_trim', 'make', 'model', 'generation', 'year_from', 'year_to', 'series', 'trim', 'body_type', 'number_of_seats',
       'engine_type', 'drive_wheels', 'transmission', 'max_speed_km_per_h'],
      "limit":500
  })

  foundCar.open("POST", carsApi, true);
  foundCar.send(infoSend);
}
search();
});