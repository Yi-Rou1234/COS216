<?php
    include ("config.php");
    if (!$conn) 
    {
        die("<div id='special'>Connection failed: " . mysqli_connect_error() . "<br><a href = 'login.php'><button type = 'button' >Go back</button></a></div>");
    }

    session_start();
    if (isset($_COOKIE['name'])) {
        $theme = $_COOKIE['theme'];
        $name = $_COOKIE['name'];
        echo 'Name: '.$name.' theme: '.$theme;
    }
    else {
        echo 'name is not sets';
    }

    $sql = "UPDATE userdb SET theme = '$theme' WHERE name = '$name'";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_query($conn, $sql)) {
        echo "UPDATED SUCCESSFUL!!!!!";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);

    header('Location: ../index.php');
    die();
?>