<!-- Yi-Rou Hung, u22561154 -->
<html>
<!-- <div class="navbar ">
    <a href="index.php">Cars</a>
    <a href="Brands.php">Brand</a>
    <a href="FindCar.php">Find a Car</a>
    <a href="Compare.php">Compare</a>
</div> -->
<div class="navbar ">
  <img class="logo" src="img/logo.png" alt="logo" >
    <div class="topnav-right">
    <a href="index.php">Cars</a>
    <a href="Brands.php">Brand</a>
    <a href="FindCar.php">Find a Car</a>
    <a href="Compare.php">Compare</a>
    <?php 
    if (isset($_SESSION['user_id'])) {
        // User is logged in, display their name and a logout button
        echo '<a class="button is-light" href="logout.php">Logout</a>
            <p>Welcome, '.$_SESSION['user_name'].'!</p>';
      } 
    else {
        // User is not logged in, display login and register links
        echo '<a class="button is-primary" href="php/login.php">Login</a>
            <a class="button is-light" href="php/signup.php">Sign Up</a>';
      }
    ?>
    </div>
</html>

<?php     
    include(dirname('config.php').DIRECTORY_SEPARATOR."config.php");
?>