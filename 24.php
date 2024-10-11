
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="24.css">
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
        <h1>SEARCH RECORD</h1>
    </div>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = isset($_POST['name']) ? mysqli_real_escape_string($connection, $_POST['name']) : '';
        $regno = isset($_POST['regno']) ? mysqli_real_escape_string($connection, $_POST['regno']) : '';
        $batch = isset($_POST['batch']) ? mysqli_real_escape_string($connection, $_POST['batch']) : '';
        $section = isset($_POST['section']) ? mysqli_real_escape_string($connection, $_POST['section']) : '';
        $faculty = isset($_POST['faculty']) ? mysqli_real_escape_string($connection, $_POST['faculty']) : '';
        $length = strlen($regno);
        $checkregno = "SELECT*FROM `student`WHERE`Regno`='$regno'";
        $checkres = mysqli_query($connection, $checkregno);
        $row = mysqli_fetch_assoc($checkres);
        if ($length != 0 && ($length > 7 || $length < 7)) {
            echo '<div class="alert alert-danger text-center" role="alert">INVALID REGISTRATION NUMBER!</div>';
        } else if (mysqli_num_rows($checkres) == 0) {
            echo '<div class="alert alert-primary text-center" role="alert">NO RECORD FOUND !</div>';
        } else if (($length == 7) && mysqli_num_rows($checkres)>0) {
            echo '<div class="alert alert-primary text-center" role="alert"><table class="table table-bordered table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Name</th>
                                    <th>Registration No</th>
                                    <th>Batch No</th>
                                    <th>Section</th>
                                    <th>Faculty</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>' . htmlspecialchars($row['Name']) . '</td>
                                    <td>' . htmlspecialchars($row['Regno']) . '</td>
                                    <td>' . htmlspecialchars($row['batch']) . '</td>
                                    <td>' . htmlspecialchars($row['section']) . '</td>
                                    <td>' . htmlspecialchars($row['faculty']) . '</td>
                                </tr>
                            </tbody>
                        </table></div>';
        } else {
            echo '<div class="alert alert-danger text-center" role="alert">PLEASE ENTER A VALUE!</div>';
        }

    }

    ?>
    <div class="main">
        <form action="/php1/24.php" method="post" class="border">
            <label for="ip">Enter your reg no:</label><br>
            <input type="text" name="regno" class="mt-4" id="ip">
            <button type="submit" class="d-inline-block rounded-3 ms-2 shadow" id="btn">SEARCH</button>
        </form>
    </div>
    <div class="container d-flex justify-content-center align-content-center align-items-center">
    <button class="rounded-3 shadow">
    <a href="index.php" class="text-white text-decoration-none">RETURN</a>
    </button>
    </div>
</body>
<script src="js/bootstrap.min.js"></script>
<script src="24.js"></script>
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

</html>