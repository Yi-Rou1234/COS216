<!-- Yi-Rou Hung, u22561154 -->
<html>
<head>
    <link rel="stylesheet" href="../css/light.css">
    <div class="navbar ">
    <img class="logo" src="../img/logo.png" alt="logo">
    <div class="topnav-right">
    <a href="../index.php">Cars</a>
    <a href="../Brands.php">Brand</a>
    <a href="../FindCar.php">Find a Car</a>
    <a href="../Compare.php">Compare</a>
</div>
</head>
<style>
  body {
  font-family:Georgia, 'Times New Roman', Times, serif;
  background-color: rgb(246, 231, 231);
  
}
</style>
    
    <div class="content" style="padding : 70px">
        <form id="form" action="validate-login.php" method="POST">
            <h1>Login</h1>

            <div>
                <label for="email">Email</label>
                <input id="email" name="email" type="text" style="width : 300px; height : 30px" required><br>
                <div class="error"></div><br>

                <label for="password">Password</label>
                <input id="password"name="password" type="password" style="width : 300px; height : 30px" required><br>
                <div class="error"></div>
            </div><br>
			
            <button type="submit" name = 'login-submit'>Log in</button>
        </form>
    </div><br>
</html>

<?php     
    include(dirname('footer.php').DIRECTORY_SEPARATOR."footer.php");
?>