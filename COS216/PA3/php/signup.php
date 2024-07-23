<html>
<head>
  <link rel="stylesheet" href="../css/style.css">
  <img class="logo" src="../img/logo.png" alt="logo"><br>
  <title>Sign Up now:</title><br>
<style>
body {
  font-family:Georgia, 'Times New Roman', Times, serif;
  background-color: rgb(246, 231, 231);
  
}
</style>

<form method="post" action="validate-signup.php">
  <label for="name">Name:</label>
  <input type="text" id="name" name="name" required><br><br>

  <label for="surname">Surname:</label>
  <input type="text" id="surname" name="surname" required><br><br>

  <label for="email">Email:</label>
  <input type="email" id="email" name="email" required><br><br>

  <label for="password">Password:</label>
  <input type="password" id="password" name="password" required><br><br>

  <input type="submit" onsubmit="return validateForm()" value="Sign Up">
</form>

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