<!-- Yi-Rou Hung, u22561154 -->
<footer>
<div class="footer-content">
</div>
<div class="content">
<?php
  if ($_SESSION['logged_in']) 
  {
    echo 
    "<button id='themebutton' onclick=setTheme('light')><a href = 'php/savetheme.php'>Light</a></button>
    <button id='themebutton' onclick=setTheme('dark')><a href = 'php/savetheme.php'>Dark</a></button>";
  }
?>


  <h3>JDM Auto</h3>
  <p>The Road will never be the same</p>
</div>
</footer>
