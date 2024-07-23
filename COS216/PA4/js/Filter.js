function saveFilter()
{
    var url = "https://wheatley.cs.up.ac.za/u22561154/COS216/PA4/php/setting.php";

    let req = new XMLHttpRequest();
    let body_type = document.getElementById('bodyDropdown').value;
    let Engine = document.getElementById('mydropdown').value;
    let sort = document.getElementById('dropdown').value;

    var preferences = [body_type,Engine,sort];
    var body = JSON.stringify({
      "api_key": "33897045fb42b6c7",
      "preferences": preferences
    });
    console.log(body);

    req.open("POST", url, true);
    req.setRequestHeader("Content-type", "application/json");
    req.onreadystatechange = function () {
      if (req.readyState == 4 && req.status == 200) 
      {
        let Q1 = JSON.parse(req.responseText);
        console.log(Q1);
        location.reload();
      }
      else
      {
        console.log("Error:"+req.responseText.message);
      }
    };
    req.send(body);
}