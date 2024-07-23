<!-- Yi-Rou Hung, u22561154 -->
<html>
<div class="navbar ">
  <img class="logo" src="img/logo.png" alt="logo" >
    <div class="topnav-right">
    <a href="index.php">Cars</a>
    <a href="Brands.php">Brand</a>
    <a href="FindCar.php">Find a Car</a>
    <a href="Compare.php">Compare</a>
    
</html>
<?php 
    session_start();
    if (isset($_SESSION['logged_in'])) {
        echo '<a href="php/logout.php">Logout</a>
        <b><p>Welcome, '.$_COOKIE['name'] . ' ' . $_COOKIE['surname'].'!</p></b><br>';
      } 
    else {
        echo '<a href="php/login.php">Login</a>
            <a href="php/signup.php">Sign Up</a>';
      }
    ?>
    </div>
<?php     
    include(dirname('config.php').DIRECTORY_SEPARATOR."config.php");

    if (isset($_SESSION['login_time'])) {
      $timeout_minutes = 10; 
      if (time() - $_SESSION['login_time'] > $timeout_minutes * 60) {
          setcookie('login_time', '', time() - 3600, '/');
          header("Location: logout.php");
      } else {
          setcookie('login_time', time(), time() + (86400 * 30), '/');
      }
  }
  
?>