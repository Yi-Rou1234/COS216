<!-- Yi-Rou Hung, u22561154 -->
<!-- <!DOCTYPE html> -->
<?php
session_start();
?>
<?php include(dirname('php/header.php').DIRECTORY_SEPARATOR."header.php");?>
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
      $theme = 'light';
    }
    echo '<link id="theme-style" rel="stylesheet" type="text/css" href="css/'.$theme.'.css">';
  ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <style>
body {
    background-image: url('img/error.png');
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: cover;
}
.button {
  position: relative;
  float: right;
  margin-right: 250px;
  top : 580px;
  background-color: #727272;
  border: none;
  font-size: 23px;
  color: #FFFFFF;
  padding: 12px;
  width: 170px;
  height: 50px;
  text-align: center;
  -webkit-transition-duration: 0.4s; /* Safari */
  transition-duration: 0.4s;
  text-decoration: none;
  overflow: auto;
  cursor: pointer;
}

.button:after {
  content: "";
  background: #595959d9;
  display: block;
  position: absolute;
  padding-top: 300%;
  padding-left: 350%;
  margin-left: -20px!important;
  margin-top: -120%;
  opacity: 0;
  transition: all 0.8s
}

.button:active:after {
  padding: 0;
  margin: 0;
  opacity: 1;
  transition: 0s
}
</style>

    <p style="background-image: url('img/error.png');"></p>
    <button class="button" onclick="history.back()" > Back Home</button>

</body>

</html>
<?php include(dirname('php/footer.php').DIRECTORY_SEPARATOR."footer.php");?>