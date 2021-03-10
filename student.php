<?php require('database_connection.php') ?>

<?php 
    session_start();
    if (isset($_GET['sem1'])){
        $_SESSION['semester_number'] = 1;
        header("location:show_sem_det.php");
    }elseif(isset($_GET['sem2'])){  
        $_SESSION['semester_number'] = 2;
        header("location:show_sem_det.php");
    }elseif(isset($_GET['sem3'])){  
        $_SESSION['semester_number'] = 3;
        header("location:show_sem_det.php");
    }elseif(isset($_GET['sem4'])){  
        $_SESSION['semester_number'] = 4;
        header("location:show_sem_det.php");
    }elseif(isset($_GET['sem5'])){  
        $_SESSION['semester_number'] = 5;
        header("location:show_sem_det.php");
    }elseif(isset($_GET['sem6'])){  
        $_SESSION['semester_number'] = 6;
        header("location:show_sem_det.php");
    }
    
    $visitor_id = $_SESSION['current_user'];
    $table_name = $_SESSION['member'];
    $my_query = "SELECT name_ from STUDENT where Id='$visitor_id'";
    $fetch = mysqli_query($connection, $my_query);
    $visitor_name = mysqli_fetch_assoc($fetch)['name_'];
    $_SESSION['visitor_name'] = $visitor_name;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Student Page</title>
    <style>
        nav{
            background-color: blue;
        }
        #b{
            display: flex;
        }
        input {
            width: 300%;
        }
        h1{
            text-align: center;
        }
        #a{
            margin: auto;
        }
        td{
            transform: translate(9px, 0px);
        }
    </style>
</head>
<body>
<nav class="navbar navbar-light bg-success">
    <!-- <a href="#" class="navbar-brand">
            <img src="images/usman.png" height="28" alt="CoolBrand">
    </a> -->
    <a class="navbar-brand"><img style="transform: translate(0px,-5px);" src="images/logo.png" height="30" width="35px" alt=""><strong>  Utah University </strong></a>
    
    <h5 style="display: inline-block; margin-right:2em; transform: translate(310px, 5px);"><?php echo $visitor_name?></h5>
    <button class="btn btn-outline-dark" style="transform: translate(140px,0px);" onclick="location.href='helpdesk.php'">Help desk</button>
    
    <form action="index.php">
        <button class="btn btn-outline-dark" type="submit">Logout</button>
    </form>
    </nav>
    <br><br><br><br>
    <div id = b>
    <div id = a>
    <h1>Hi, <?php echo $visitor_name;?></h1>
    <h3>Have a look at your semester details</h3>
    <form action="<?php echo  $_SERVER['PHP_SELF']?>" method="get">
        <table>
        <tr>
        <td><input class="btn btn-outline-primary" type="submit" value="First Semester" name="sem1"></td>
        </tr>
        <tr>
        <td><input class="btn btn-outline-primary" type="submit" value="Second Semester" name="sem2"></td>
        </tr>
        <tr>
            <td><input class="btn btn-outline-primary" type="submit" value="Third Semester" name="sem3"></td>
        </tr>
        <tr>
            <td><input class="btn btn-outline-primary" type="submit" value="Fourth Semester" name="sem4"></td>
        </tr>
        <tr>
            <td><input class="btn btn-outline-primary" type="submit" value="Fifth Semester" name="sem5"></td>
        </tr>
        <tr>
            <td><input class="btn btn-outline-primary" type="submit" value="Sixth Semester" name="sem6"></td>
        </tr>
    
        </table>
    </form>
    </div>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>