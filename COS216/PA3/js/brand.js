//u22561154, Yi-Rou Hung

const makesApi = "https://wheatley.cs.up.ac.za/api/";

function loadMakes()
{
    const makes = new XMLHttpRequest();
    makes.onload = function()
    {
        if (this.readyState == 4 && this.status == 200)
        {
            const makes = JSON.parse(this.responseText);
            // document.getElementById("makes").innerHTML ="<table><tr>";
            document.getElementById("makes").innerHTML = "";

            for (let i = 0; i < makes.data.length; i++)
            {
                // if (i%4 == 0){
                //     document.getElementById("makes").innerHTML +=
                //     "<td>"+ "<img id = 'brandimg"+ i +"' style='width:40%'>"
                //     +makes.data[i]+"</td></tr><tr>";       
                // }
                // else{
                //     document.getElementById("makes").innerHTML +=
                //    "<td>"+ "<img class = 'brandImage' id = 'brandimg"+ i +"' style='width:40%'>"
                //    +makes.data[i]+"</td>";
                // }
                document.getElementById("makes").innerHTML +=
                "<li class = 'col' style= 'align-items: center'>"
                +"<li class = 'content' >"
                +"<img id = 'brandimg"+ i +"' style='width:40%'><br>"
                +"<b>"+makes.data[i]+"</b>"
                +"</li></li>";
                loadBrand(makes.data[i], i);
            }
            // document.getElementById("makes").innerHTML +="</tr></table>";

        }
    }
    var makesSend = JSON.stringify
    ({
        "studentnum":"u22614495",
        "apikey":"a9198b68355f78830054c31a39916b7f",
        "type":"GetAllMakes",
        "limit":100
    })
    
    makes.open("POST", makesApi, true);
    makes.send(makesSend);
}
loadMakes();

function loadBrand(brand, id){
  const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
      if (this.readyState == 4 && this.status == 200) {
          document.getElementById("brandimg"+id).setAttribute("src", this.responseText);
      }
  }
  
  xhttp.open("GET", "https://wheatley.cs.up.ac.za/api/getimage?brand="+brand, true);
  xhttp.send();
}
