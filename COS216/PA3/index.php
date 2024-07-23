<!-- Yi-Rou Hung, u22561154 -->
<!-- <!DOCTYPE html> -->
<html>
<head>
  <link rel="stylesheet" href="css/style.css">
  <title>CarsIndex</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- PA2 -->
  <meta charset="UTF-8">
  <meta http.equi="X-UA-Compatiible" content="ie=edge">
<!-- PA2 -->
</head>

<body>
  <style>
  body {
  font-family: Arial, Helvetica, sans-serif;
  background-color: rgb(246, 231, 231);
}
.navbar {
  overflow: hidden;
  top: 0;
}

</style>
<?php include(dirname('php/header.php').DIRECTORY_SEPARATOR."header.php");?>

    <!-- <div class="search-container"> -->
      <form>
        <label for="make">Make:</label>
        <input type="text" id="make" name="make"><br><br>
        <label for="model">Model:</label>
        <input type="text" id="model" name="model"><br><br>
        <input type="submit" value="Search">
      </form>

  <!-- </div> -->

<div id="carSearch"></div>
<!-- THE CARS GALLERY -->
  <div class="main">

  <h1>JDM Auto</h1>
  <hr>
  <h2>Wide range of JDM car models for sale</h2>


         <!-- <b><p style="font-size: 12px;">Body Type :</p></b> -->
        <select class="bodyDropdown" id = "bodyDropdown" onchange="FilterBody()">
        <option>choose a body type: </option>
        <option value="Coupe">Coupe</option>
        <option value="Minivan">Minivan</option>
        <option value="Roadster">Roadster</option>
        </select>
        <button onclick="location.reload()">Refresh</button><br><br>

        <!-- <b><p style="font-size: 12px;">Engine Type :</p></b> -->
        <select id = "mydropdown" onchange="FilterEngine()">
        <option>choose a engine type: </option>
        <option value="Gasoline">Gasoline</option>
        <option value="Diesel">Diesel</option>
        <option value="Hybrid">Hybrid</option>
        </select>
        <button onclick="location.reload()">Refresh</button><br><br>

      <!-- <br><br><b><p style="font-size: 12px;">SORT ASC:</p></b> -->
      <select id = "dropdown" onchange="mySort()">
      <option>choose a sort: </option>
      <option value="make">make</option>
      <option value="year_from">year_from</option>
      <option value="max_speed_km_per_h">max_speed_km_per_h</option>
      </select>
      <button onclick="location.reload()">Refresh</button>

      <div id="FilterBody"></div>
      <div id="FilterMake"></div>
      <div id="FilterEngine"></div> 
      <div id="found"></div>
      <div id="Sort"></div> 
      <div id="carblock"></div> 

      <script type = "text/javascript" src="js/carSearch.js"></script>
      <script type = "text/javascript" src="js/code.js"></script>
      <script type = "text/javascript" src="js/sort.js"></script>
      <script type = "text/javascript" src="js/filterEngine.js"></script>
      <script type = "text/javascript" src="js/filterBody.js"></script>

      </div>
<!-- END GRID -->

<br>
<div class="content">
  <h3>Additional Information</h3>
  <p>Get in touch with us at UP's car seller!</p>
  <p>Instagram page : @JDM Auto</p>
  <p>Contact us : +27 (82) 293 3859</p>
  <p>Email us : JDMAutoCenturion@up.ac.za</p>
  <p>#JDM #SportCar #Drift #Car4Speed</p>
  <p>-------------------------------------------------------------------------------------------------------------------------------------------------------------------</p>
  <p>Copyright @ 2023 JDM Auto | All rights reservec.</p>
</div>
<!-- END MAIN -->

</body>
</html>
<?php include(dirname('php/footer.php').DIRECTORY_SEPARATOR."footer.php");?>
