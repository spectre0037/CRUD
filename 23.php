<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="23.css">
    <link rel="stylesheet" href="/php1/css/bootstrap.min.css">
</head>
<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "MYDB";
$connection = mysqli_connect($servername, $username, $password, $dbname);

?>

<body>
    <div class="container-fluid bg-dark text-center">
        <h1>DELETE RECORDS</h1>
    </div>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $regno = $_POST['regno'];
        $length = strlen($regno);
        $checkregno = "SELECT*FROM `student`WHERE`Regno`='$regno'";
        $checkres = mysqli_query($connection, $checkregno);
        
        if ($length != 0 && ($length > 7 || $length < 7)) 
        {
            echo '<div class="alert alert-danger text-center" role="alert">INVALID REGISTRATION NUMBER!</div>';
        }
        else if(mysqli_num_rows($checkres) == 0)
        {
            echo '<div class="alert alert-primary text-center" role="alert">NO RECORD FOUND !</div>';
        }
        else if ($length == 7) 
        {
            $sql = "DELETE FROM `student` WHERE regno = $regno";
            $result = mysqli_query($connection, $sql);
            echo '<div class="alert alert-primary text-center" role="alert" id="ntm">DATA DELETED SUCCESSFULY !</div>';
        }
        else 
        {
            echo '<div class="alert alert-danger text-center" role="alert">PLEASE ENTER A VALUE!</div>';
        }

    }

    ?>
    <div class="main">
        <form action="/php1/CRUD/23.php" method="post" class="border">
            <label for="">Enter your reg no:</label><br>
            <input type="text" name="regno" class="mt-4">
            <button type="submit" class="d-inline-block rounded-3 ms-2" id="btn">DELETE</button>

        </form>
    </div>
    <div class="container d-flex justify-content-center align-content-center align-items-center">
    <button class="rounded-3 shadow">
    <a href="index.php" class="text-white text-decoration-none">RETURN</a>
    </button>
    </div>
</body>
<script src="js/bootstrap.min.js"></script>
<script src="23.js"></script>
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

</html>