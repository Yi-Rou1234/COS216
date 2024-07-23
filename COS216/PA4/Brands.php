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
  <title>Brands</title>
<style>
/* Font for the Heading */
/* body {
  font-family:Georgia, 'Times New Roman', Times, serif;
  background-color: rgb(246, 231, 231);
  
} */
.navbar {
  overflow: hidden;
  top: 10;
}

</style>
<!-- <div class="navbar ">
  <img class="logo" src="img/logo.png" alt="logo" >
    <div class="topnav-right">
    <a href="index.php">Cars</a>
    <a href="#Brand" class="active">Brand</a>
    <a href="FindCar.php">Find a Car</a>
    <a href="Compare.php">Compare</a> -->
    <?php include(dirname('php/header.php').DIRECTORY_SEPARATOR."header.php");?>
    <!-- </div>
</div> -->
  <h1>JDM Auto</h1>
</head>


<body>
  <div class="brand" id ="makes" style="width:40%; align-items: center;">
    <script type = "text/javascript" src = "js/brand.js"></script>
  </div>
  <script type = "text/javascript" src = "js/theme.js"></script>
</body>


</html>
<?php include(dirname('php/footer.php').DIRECTORY_SEPARATOR."footer.php");?>