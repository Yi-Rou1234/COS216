<!-- Yi-Rou Hung, u22561154 -->
    <?php
      // Check if user is logged in
      if (isset($_SESSION['user_id'])) {
        // User is logged in, display their name and a logout button
        echo '<a class="button is-light" href="logout.php">Logout</a>
                <p>Welcome, '.$_SESSION['user_name'].'!</p>';
      } else {
        // User is not logged in, display login and register links
        echo '<a class="button is-primary" href="login.php">Login</a>
                <a class="button is-light" href="php/signup.php">Sign Up</a>';
      }
    ?>


