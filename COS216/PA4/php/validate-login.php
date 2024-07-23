<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<?php
    session_start();

    if (isset($_POST['email']) && isset($_POST['password'])) 
    {
        $email = $_POST['email'];
        $password = $_POST['password']; 

        include ("config.php");
        if (!$conn) 
        {
            die("<div id='special'>Connection failed: " . mysqli_connect_error() . "<br><a href = 'login.php'><button type = 'button' >Go back</button></a></div>");
        }

        $sql = "SELECT * FROM userdb WHERE email = '$email'";
        $result = $conn->query($sql);
        $data = array();
        if ($result->num_rows > 0) 
        {
            while($row = $result->fetch_assoc()) 
            {
                $data[] = $row; 
            }
        }
        else
        {
            echo "<div id = 'special'>Email does not exist</div>";
            return;
        }

        foreach ($result as $row)
        {
            $name = $row['name'];
            $surname = $row['surname'];
            $api_key = $row['APIkey'];
            $theme = $row['theme'];
            $salt = $row['salt'];
        }
        $hashed_password = hash('sha256', $password.$salt);

        $sql = "SELECT * FROM userdb WHERE email = '$email' AND password = '$hashed_password'";
        echo $sql;
        $result = mysqli_query($conn, $sql);
        if ($result->num_rows > 0)
        {
            setcookie('apikey', $api_key, time() + (86400 * 30), '/');
            setcookie('name', $name, time() + (86400 * 30), '/');
            setcookie('surname', $surname, time() + (86400 * 30), '/');
            setcookie('log', true, time() + (86400 * 30), '/');
            setcookie('theme', $theme, time() + (86400 * 30), '/');
            $_SESSION['logged_in'] = true;
            echo "<div id = 'special'>Logged in</div>";

            // $_SESSION['login_time'] = time();
            // or
            setcookie('login_time', time(), time() + (86400 * 30), '/');

            header("Location: ../index.php");
        }
        else
        {
            echo "<div id = 'special'>Incorrect password</div>";
            return;
        }
    }
    else
    {
        header("Location: login.php");
        exit();
    }
?>