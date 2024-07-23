<!-- Yi-Rou Hung, u22561154 -->
<!-- <!DOCTYPE html> -->
<?php
session_start();
?>
<html>
<head>
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
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>FindCar</title>
<style>
/* body {
  font-family: Arial, Helvetica, sans-serif;
  background-color: rgb(246, 231, 231);
} */
.navbar {
  overflow: hidden;
  top: 0;
}
</style>

</head>

<body>
    <?php include(dirname('php/header.php').DIRECTORY_SEPARATOR."header.php");?>

<!-- HTML FORM WITH FIELDSET -->
<form style="padding-inline: 150px;" id="myForm">
  <fieldset style="text-align: center; border-radius: 10px; border-width: 5px;">
    <legend><strong>Advanced Filter:</strong></legend>

    <!-- Fuel Type List -->
    <br><label for="fuel">Select Fuel Type: *</label><br><br>
    <select name="fuel" id="fuel" required>
      <option value="">None</option>
      <option value="Gasoline">Gasoline</option>
      <option value="Diesel">Diesel</option>
      <option value="Hybrid">Hybrid</option>
    </select>
    <br><br>

    <!-- Body Type -->
    <br><label for="BodyType">Select Body Type: *</label><br><br>
    <select name="BodyType" id="BodyType" required>
      <option value="">None</option>
      <option value="Coupe">Coupe</option>
      <option value="Sedan">Sedan</option>
      <option value="Wagon">Wagon</option>
      <option value="Liftback">Liftback</option>
    </select>
    <br><br>

    <!-- Transmission -->
    <p>Select Transmission type: *</p>
    <input type="radio" id="auto" name="TranType" value="Automatic" required="required" onclick="getTranValue()">
    <label for="Automatic">Automatic</label><br>
    <input type="radio" id="manual" name="TranType" value="Manual" onclick="getTranValue()">
    <label for="Manual">Manual</label><br><br>

    <!-- Seats -->
    <p>Select Number of Seat(s): *</p>
    <input type="radio" id="2" name="seat" value="2" required="required" onclick="getSeat()">
    <label for="2">2 seater</label><br>
    <input type="radio" id="4" name="seat" value="4" onclick="getSeat()">
    <label for="4">4 seater</label><br><br>

    <!-- Brand of Car -->
    <p>Select the Make:</p>
    <input type="checkbox" id="make1" name="make" value="Lamborghini" onclick="getMake()">
    <label for="make1">Lamborghini</label><br>
    <input type="checkbox" id="make2" name="make" value="Maserati" onclick="getMake()">
    <label for="make2">Maserati</label><br>
    <input type="checkbox" id="make3" name="make" value="BMW" onclick="getMake()">
    <label for="make3">BMW</label><br>
    <input type="checkbox" id="make4" name="make" value="Audi" onclick="getMake()">
    <label for="make4">Audi</label><br>
    <input type="checkbox" id="make5" name="make" value="Ferrari" onclick="getMake()">
    <label for="make5">Ferrari</label><br><br>

    <!-- Model of car -->
    <label for="model">Specific model:</label><br>
    <input type="text" id="model" name="model" value=""><br><br><br>
    <!-- <input type="submit" value="Submit"> -->
    <button id="submitBtn" type="submit">Submit</button>
    <button onclick="location.reload()">Refresh</button>
  </fieldset>
</form>

<!-- Portfolio Gallery Grid -->
<fieldset style="border-radius: 10px; border-width: 5px;">
<legend><strong>Result(s):</strong></legend>
<script type = "text/javascript" src="js/FindCar.js"></script>
<div id ="CarFind"></div>
<!-- END GRID -->
</fieldset>
<script type = "text/javascript" src = "js/theme.js"></script>
</body>
</html>
<?php include(dirname('php/footer.php').DIRECTORY_SEPARATOR."footer.php");?>