<?php
   session_start();

   $_SESSION['logged_in'] = false;
   session_unset();

   if(session_destroy()) 
   {
      header("Location: ../index.php");
   }
   echo "<div id = 'special'>Logged out</div>";
   
   setcookie('api_key', '', time() - 3600, '/');
   setcookie('name', '', time() - 3600, '/');
   setcookie('surname', '', time() - 3600, '/');
   setcookie('log', '', time() - 3600, '/');
   setcookie('theme', '', time() - 3600, '/');
   
   // header("Location: ../index.php");
?>