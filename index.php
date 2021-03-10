<?php
    if (isset($_SESSION)){
        session_destroy();
    }
    session_start();
    if(isset($_GET['student'])){
        $_SESSION['member'] = 'STUDENT';
        header('Location: login.php');
    }elseif(isset($_GET['faculty'])){
        $_SESSION['member'] = 'FACULTY';
        header('Location: login.php');
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students Portal</title>
    <style>
        body{
        background-image:url('images/bg_img_3.jpg');
        background-repeat: no-repeat;
        background-size: inherit;
        }
    </style>
</head>
<body style="padding: 10%;">
<div style="padding: 10%; background-color:rgba(236, 250, 215,0.5)">
    <h1 style="text-align: center;">Welcome to UIT Students Portal</h1>
    <div style="display: flex;">
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get" style="margin: auto;">
        <input style="font-weight:700; height:3em; width:50em; background-color:cornflowerblue;" type="submit" value="Login as Student" name='student'>
        <br>
        <input style="font-weight:700; height:3em;width:50em; background-color:lightcoral" type="submit" value="Login as Faculty" name="faculty">
    </form>
    </div>
</div>
</body>
</html>