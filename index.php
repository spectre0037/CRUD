<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SQL COMMANDS</title>
    <link rel="stylesheet" href="/php1/css/bootstrap.min.css">
    <link rel="stylesheet" href="/php1/22.css">
    <link href="https://fonts.cdnfonts.com/css/bebas-neue" rel="stylesheet">
</head>
<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "MYDB";
$connection = mysqli_connect($servername, $username, $password, $dbname);

?>

<body>

    <div class="container1 w-75 my-0">
        <div class="container w-75 mt-5 bg-dark h3">
        <h5 class="container  my-2">SIGN UP FORM FOR STUDENTS</h5>
        </div>
        <form action="/php1/CRUD/index.php" method="post" class="container w-75  d-flex bg-white flex-wrap mt-0 mb-0">
            <div class="container w-75 mt-3">
                <label for="">NAME :</label><br>
                <input type="text" name="name" placeholder=""><br>
                <label for="">REGISTRATION NUMBER :</label><br>
                <input type="text" name="regno" placeholder="(1234567)     "><br>
                <label for="">BATCH NO :</label><br>
                <input type="number" name="batch" placeholder="(31,32,33,34)  "><br>
                <label for="">SECTION :</label><br>
                <input type="text" name="section" placeholder="(A - I)      "><br>
                <label for="">FACULTY :</label><br>
                <input type="text" name="faculty"
                    placeholder="(FCSE / FME / FES / FMCE)    "><br>
                <button type="submit" id="submit">SUBMIT</button>
            </div>
            <div class="container d-flex justify-content-center">
                <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $name = $_POST['name'];
                    $regno = $_POST['regno'];
                    $batch = $_POST['batch'];
                    $section = $_POST['section'];
                    $faculty = $_POST['faculty'];
                    $length = strlen($regno);
                    $checkregno = "SELECT*FROM `student`WHERE`Regno`='$regno'";
                    $checkres = mysqli_query($connection, $checkregno);
                    if ($name != '' || $regno != '' || $batch != '' || $section != '' || $faculty != '') {
                        if (mysqli_num_rows($checkres) > 0) {
                            echo '<div class="alert alert-primary h-50 my-2 d-flex align-items-center w-75" role="alert">THIS REGISTRATION NUMBER HAS ALREADY SIGNED UP</div>';
                        } else if ($length > 7 || $length < 7) {
                            echo "please enter a valid regno :";
                        } elseif (!in_array($batch, ['31', '32', '33', '34'])) {
                            echo '<div class="alert alert-primary h-50 my-2 d-flex align-items-center w-75" role="alert">Please enter a valid batch number (31, 32, 33, 34)</div>';
                        }else if(!in_array($section,['A','a','B','b','C','c','D','d','E','e','F','f','G','g','H','h','I','i']))
                        {
                            echo '<div class="alert alert-primary h-50 my-2 d-flex align-items-center w-75" role="alert">Please enter a valid section (A - I)</div>';

                        }
                         elseif (!in_array($faculty, ['FCSE', 'FES', 'FME', 'FMCE'])) {
                            echo '<div class="alert alert-primary h-50 my-2 d-flex align-items-center w-75" role="alert">Please enter a valid faculty name (CS, ES, ME, CE, CEME)</div>';
                        } else {
                            $sql = "INSERT INTO `student` (`Name`, `Regno`, `batch`, `section`, `faculty`) VALUES ('$name', '$regno', '$batch', '$section', '$faculty')";
                            $result = mysqli_query($connection, $sql);
                            echo '<div class="alert alert-primary h-50 my-2 d-flex align-items-center w-75" role="alert">DATA ENTRY SUCCESSFUL</div>';
                        }
                    } else {
                        echo '<div class="alert alert-primary h-50 my-2 d-flex align-items-center w-75 " role="alert">PLEASE ENTER THE DETAILS</div>';
                    }
                }
                ?>
            </div>
        </form>
    </div>
    <br>
    <div class="container1 w-75 mt-2">
        <div class="container w-75  text-center foot bg-dark text-white d-flex justify-content-around">
            <button class="bg-danger lower mt-2 mb"><a href="/php1/CRUD/23.php" class="text-white">delete records</a></button>
            <button class="bg-danger lower mt-2 mb"><a href="/php1/CRUD/24.php" class="text-white">search records</a></button>
        </div>
    </div>
</body>
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>
<script src="js/bootstrap.min.js"></script>

</html>
