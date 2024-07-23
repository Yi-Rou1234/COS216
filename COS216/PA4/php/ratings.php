<?php
  include ("config.php");

  if ($_SERVER['REQUEST_METHOD'] === 'POST') 
  {
    $id_trim = $_POST['id_trim'];
    $rating = $_POST['rating'];
    $api_key = $_COOKIE['apikey'];

    session_start();
    $sql = "SELECT * FROM ratings WHERE APIkey = '$api_key' LIMIT 1";
    $result = $conn->query($sql);
    if ($result -> num_rows >0){
      $query = "UPDATE ratings SET rating ='$rating' , id_trim ='$id_trim' WHERE APIkey = '$api_key' ";
    }
    else{
      $query = "INSERT INTO ratings (rating, id_trim, APIkey) VALUES ($rating, $id_trim, '$api_key')";
    }

    // $query = "INSERT INTO ratings (rating, id_trim, APIkey) VALUES ($rating, $id_trim, '$api_key')";
    $result = mysqli_query($conn, $query);

    if ($result)
    {
      header("Location: ../index.php");
      exit();
    } 
    else
    {
      echo "Error: " . mysqli_error($conn);
      exit();
    }
  }
?>
