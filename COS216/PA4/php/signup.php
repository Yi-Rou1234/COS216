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

<div class="content" sytle="padding : 70px">
  <form method="post" action="validate-signup.php">
  <h1>Sign-Up</h1>
  <div>
  <label for="name">Name:</label>
  <input type="text" id="name" name="name" style="width : 210px; height : 30px" required><br><br>

  <label for="surname">Surname:</label>
  <input type="text" id="surname" name="surname" style="width : 210px; height : 30px" required><br><br>

  <label for="email">Email:</label>
  <input type="email" id="email" name="email" style="width : 300px; height : 30px" required><br><br>

  <label for="password">Password:</label>
  <input type="password" id="password" name="password" style="width : 300px; height : 30px" required><br><br>

  <input type="submit" onsubmit="return validateForm()" value="Sign Up">
</div>
  </form>
</div><br>

<script>
  function validateForm() {
  // Get the form fields
  var name = document.getElementById("name").value;
  var surname = document.getElementById("surname").value;
  var email = document.getElementById("email").value;
  var password = document.getElementById("password").value;

  // Define the regex patterns for email and password
  var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  var passwordRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()_+])[a-zA-Z\d!@#$%^&*()_+]{8,}$/;

  // Validate the fields
  if (name == "") {
    alert("Please enter your name");
    return false;
  }
  if (surname == "") {
    alert("Please enter your surname");
    return false;
  }
  if (!emailRegex.test(email)) {
    alert("Please enter a valid email address");
    return false;
  }
  if (!passwordRegex.test(password)) {
    alert("Please enter a valid password. It should be at least 8 characters long, contain upper and lower case letters, at least one digit, and one symbol.");
    return false;
  }

  // If all fields are valid, submit the form
  return true;
}

</script>

</html>
<?php     
    include(dirname('footer.php').DIRECTORY_SEPARATOR."footer.php");
?>