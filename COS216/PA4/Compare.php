<!-- Yi-Rou Hung, u22561154 -->
<!-- <!DOCTYPE html>  -->
<?php
session_start();
?>
<html>
    
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <?php
    if (isset($_SESSION['logged_in']))
    {
      if(isset($_COOKIE['theme'])) 
      {
        $theme = $_COOKIE['theme'];
      } 
      else 
      {
        $theme = 'light';
      }
    }
    else
    {
      $theme = 'dark';
    }
    echo '<link id="theme-style" rel="stylesheet" type="text/css" href="css/'.$theme.'.css">';
  ?>
  <title>CompareCar</title>
<style>
/* body {
  font-family: Arial, Helvetica, sans-serif;
  background-color: rgb(246, 231, 231);
} */
.navbar {
  overflow: hidden;
  top: 0;
}
.column {
  float:left;
  width: 50%;
}
</style>
</head>

<body>
    <?php include(dirname('php/header.php').DIRECTORY_SEPARATOR."header.php");?>

<!-- Compare the cars with SearchBar -->
<h1>CARS COMPARISON</h1>

<!-- <p><b>Enter the two cars you would like to compare:</b></p>
<form class="example" style="margin:left;max-width:200px;" >
<input type="text" placeholder="Car 1 Brand.." name="make1" id="make"><br>
<input type="text" placeholder="Car 1 Model.." name="model1" id="model">

<p><b>Compares with..</b></p>
<form class="example" style="margin:left;max-width:200px">
  <input type="text" placeholder="Car 2 Brand.." name="make2" id="make"><br>
  <input type="text" placeholder="Car 2 Model.." name="model2" id="model">
  <button type="submit" id="comparebutton"><i class="fa fa-search"></i></button> -->
  <!-- <button type="submit" id="comparebutton">Compare</button> -->
<!-- </form>
</form><br><br> -->


<!-- <div id="compare2"></div>

<fieldset>
  <legend><strong>Comaprison result:</strong></legend><br>
  <div class="row">
    <div class="column">
      <div class="content">
        <div class = "carimgs">
        <img id="car-image1"></div>
        <h3>Comaprison 1 Specifications:</h3>
        <p>About :  Brand - Nissan</p>
        <p>         Price - R 249,900.00</p>
        <p>         Model - 2008 Nissan 350z Rocket Bunny HR</p>
        <p>         Status - In Production</p>
        <p>Engine : Transmission Type - Automatic</p>
        <p>         Power Maximum Total - N/A</p>
        <p>         Power Max RPM - 7000 rpm max</p>
        <p>         Engine - 2.5L VQ35DE engine</p>
        <p>         Engine Capacity - 3498 cc</p>
        <p>         Fuel Tank Capacity - 75L</p>
        <p>Performance : Top Speed - 250 km/h (155mph)</p>
        <div id="compare1"></div>
      </div>
    </div>
      <div class="column">
        <div class="content">
          <img src="img/SubaruWRX.jpeg" alt="Error" style="width:100%">
        <h3>Comaprison 2 Specifications:</h3>
        <p>About : Brand - Subaru</p>
        <p>        Price - R580,000.00</p>
        <p>        Model - Subaru WRX STI</p>
        <p>        Status - In Production</p>
        <p>Engine : Transmission Type - Manual</p>
        <p>         Power Maximum Total - 6000kW/rpm</p>
        <p>         Power Max RPM - 4000 rpm</p>
        <p>         Engine - 2.5L turbocharged I4 engine</p>
        <p>         Engine Capacity - 2457 cc</p>
        <p>         Fuel Tank Capacity - 60L</p>
        <p>Performance : Top Speed - 255 km/h</p>
        </div>
      </div>
</fieldset> -->
<fieldset>
  <legend><strong>Comaprison result:</strong></legend><br>
    <form id ="form" style="text-align: center;">
      <label for="car1">Car 1:</label>
      <label for="make">Brand:</label>
      <input type="text" id="make1" name="make"><br><br>
      <label for="model">Car 2 Model:</label>
      <input type="text" id="model1" name="model"><br><br>
      <br>
      <label for="car1">Car 2:</label>
      <label for="make">Brand:</label>
      <input type="text" id="make2" name="make"><br><br>
      <label for="model">Car 2 Model:</label>
      <input type="text" id="model2" name="model"><br><br>
      <button type="submit" id="comparebutton" style="width: 120px; height: 47x;">Compare</button>
    </form><br>
<!-- Car spec comparison -->
<div class="car-compare">
  <table>
    <tr>
      <th>Car comparison</th>
      <th>Car 1 Specifications :</th>
      <th>Car 2 Specifications :</th>
      <div class = "carimgs">
        <img id="compare1">
        <img id="compare2">
    </div>

    </tr>
    <tr>
      <td>Make:</td>
      <td id="car-1-make"></td>
      <td id="car-2-make"></td>
    </tr>
    <tr>
      <td>Model:</td>
      <td id="car-1-model"></td>
      <td id="car-2-model"></td>
    </tr>
    <tr>
      <td>Year:</td>
      <td id="car-1-year"></td>
      <td id="car-2-year"></td>
    </tr>
    <tr>
      <td>Generation:</td>
      <td id="car-1-Generation"></td>
      <td id="car-2-Generation"></td>
    </tr>
    <tr>
      <td>Series:</td>
      <td id="car-1-series"></td>
      <td id="car-2-series"></td>
    </tr>
    <tr>
      <td>Trim:</td>
      <td id="car-1-trim"></td>
      <td id="car-2-trim"></td>
    </tr>
    <tr>
      <td>Body type:</td>
      <td id="car-1-Body-type"></td>
      <td id="car-2-Body-type"></td>
    </tr>
    <tr>
      <td>Number of seats:</td>
      <td id="car-1-number_of_seats"></td>
      <td id="car-2-number_of_seats"></td>
    </tr>
    <tr>
      <td>Engine type:</td>
      <td id="car-1-engine"></td>
      <td id="car-2-engine"></td>
    </tr>
    <tr>
      <td>Drive wheels:</td>
      <td id="car-1-DW"></td>
      <td id="car-2-DW"></td>
    </tr>
    <tr>
      <td>Transmission:</td>
      <td id="car-1-transmission"></td>
      <td id="car-2-transmission"></td>
    </tr>
    <tr>
      <td>Max speed(km/h):</td>
      <td id="car-1-MS"></td>
      <td id="car-2-MS"></td>
    </tr>
  </table>
</div>
<div id="found"></div>
<script type = "text/javascript" src = "compare.js"></script>
</fieldset>
<script type = "text/javascript" src = "js/theme.js"></script>
</body>
</html>
<?php include(dirname('php/footer.php').DIRECTORY_SEPARATOR."footer.php");?>