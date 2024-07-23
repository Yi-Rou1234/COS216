<!-- <!DOCTYPE html> -->
<?php include(dirname('php/header.php').DIRECTORY_SEPARATOR."header.php");?>
<html>
<head>
  <link rel="stylesheet" href="COS216/PA2/css/style.css">
<title>JDM Auto</title>
</head>

<body>
<style>
  body {
  background-image: url('COS216/PA3/img/car.webp');
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;
}
.navbar {
  overflow: hidden;
  /* background-color: #ee8fb0 */
  position:fixed;
  bottom: 0;
  width: 100%;
  font-family: Arial;
  display: flex;
  align-items: center;
  justify-content: center;
}

</style>

  <p style="background-image: url('COS216/PA3/img/car.webp');"></p>
  <h1 class="heading"> WELCOME </h1>
  <p style="color:aliceblue;text-align:center;font-size: 150%;">
  <i>The road will never be the same</i></p>
  <img class="center" src="COS216/PA3/img/logo.png" alt="JDM Auto" width="150" height="150">
  <div class="navbar ">
    <div class="navbar-inner">
    <a href="COS216/PA1/index.html" class="active">PA1</a>
    <a href="COS216/PA2/index.html" class="active">PA2</a>
    <a href="COS216/PA3/index.php" class='active'>PA3</a>
    <a href="COS216/PA4/index.php" class='active'>PA4</a>
    <a href="COS216/PA4/error.php">PA5</a>
    </div>
  </div>
  
</body>
</html>
<?php include(dirname('php/footer.php').DIRECTORY_SEPARATOR."footer.php");?>
