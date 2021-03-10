<?php require('database_connection.php') ?>
<?php
    session_start();
    $teacher_Id = $_SESSION['current_user'];
    $my_q = "SELECT name_ FROM FACULTY where Id = '$teacher_Id'";
    $result = mysqli_query($connection, $my_q);
    $teacher_name = mysqli_fetch_assoc($result)['name_'];
    $_SESSION['teacher_name'] = $teacher_name;
    $my_q = "SELECT * FROM COURSE WHERE facultyId = '$teacher_Id'";
    $result  = mysqli_query($connection, $my_q);
    $courses = array();
    $course_ids = array();
    while($row = mysqli_fetch_assoc($result)){
        array_push($courses, $row['courseName']);
        array_push($course_ids,$row['courseId']);
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <style>
        nav{
            background-color: blue;
        }
        #b{
            display: flex;
        }
        button.btna {
            width: 90%;
            transform: translate(30px,0);
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
    <a class="navbar-brand"><img style="transform: translate(0px,-5px);" src="images/logo.png" height="30" width="35px" alt=""><strong>  Uttah University </strong></a>
    
    <form method="" action="index.php">
    <h5 style="display: inline-block; margin-right:2em; transform: translate(0px, 5px);"><?php echo $teacher_name?></h5>
        <button class="btn btn-outline-dark" type="submit">Logout</button>
    </form>
    </nav>
    <br><br><br><br>
    <div id = b>
    <div id = a>
        <h1>Hi, <?php echo $teacher_name; ?></h1>
        <h3>Edit score and attendance of your courses.</h3>
        <form action="edit_details.php" method="get">
        <?php for($i = 0; $i < sizeof($courses); $i++): ?>  
            <button class="btn btn-outline-primary btna" type="submit" name="id" value="<?php echo $course_ids[$i];?>"><?php echo $courses[$i];?></button>
        <?php endfor;?>
        </form>
    </div>
    </div>
</body>
</html>