<?php require('database_connection.php') ?>

<?php
    session_start();
    $teacher_name = $_SESSION['teacher_name'];
    if(isset($_POST['std_id'])){
        $upd_for_std = $_POST['std_id'];
        $current_course = $_GET['id'];
        $new_att = $_POST['new_att'];
        $new_marks = $_POST['new_marks'];
        if (! ($new_marks>100 or $new_marks<0 or $new_att > 45 or $new_att<0)){
        $my_q = "UPDATE STUDENT_FACULTY_COURSE_BRIDGE SET attendance='$new_att', score='$new_marks' 
                WHERE studentId = '$upd_for_std' AND courseId = '$current_course'";

        $res = mysqli_query($connection, $my_q);
        }else{
            echo "<h5>Invalid input</h5>";
        }
    }
    $course_id = $_GET['id'];
    $query = "SELECT courseName FROM COURSE WHERE courseId = '$course_id'";
    $result = mysqli_query($connection, $query );
    $course_name = mysqli_fetch_assoc($result)['courseName'];
    $my_query = "SELECT studentId, attendance, score FROM STUDENT_FACULTY_COURSE_BRIDGE WHERE courseId = '$course_id'";
    $result = mysqli_query($connection, $my_query);
    $student_ids = array();
    $attendance = array();
    $scores = array();
    while ($row = mysqli_fetch_assoc($result)){
        array_push($student_ids, $row['studentId']);
        array_push($attendance, $row['attendance']);
        array_push($scores, $row['score']);
    }
    $st_ids = join("','", $student_ids);
    //query forstudent names

    $query = "SELECT name_ FROM STUDENT WHERE Id IN ('$st_ids')";
    $res = mysqli_query($connection, $query);
    $student_names = array();

    while ($row = mysqli_fetch_assoc($res)){
        array_push($student_names, $row['name_']);
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <style>
        td {
            text-align: center;
            font-weight: bolder;
        }
        h1, h3{
            text-align: center;
        }
        thead{
            background-color:royalblue;
            color:white;
        }
        th{
            text-align: center;
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
    <br><br><br>
    <div class='container'>
        <h1><?php echo $course_name ?></h1>
        <h3>Course Code: <?php echo $course_id ?></h3>
        <table class="table table-bordered table-hover">
            <thead>
                <th>Student ID</th>
                <th>Student Name</th>
                <th>Lect. Attended Out of 45</th>
                <th>Marks Obtained</th>
                <th></th>
            </thead>
            <tbody>
                <?php for ($i=0; $i<sizeof($student_ids); $i++): ?>
                    <tr>
                        <td><?php echo $student_ids[$i]?></td>
                        <td><?php echo $student_names[$i]?></td>
                        <form action="<?php echo $_SERVER['PHP_SELF'] ?>?id=<?php echo $course_id ?>" method="post">
                        <td><input type="number" value="<?php echo $attendance[$i] ?>" name="new_att" min=0 max=45></td>
                        <td><input type="number" value="<?php echo $scores[$i]?>" name="new_marks" min=0 max=100></td>
                        <td><button class="btn btn-outline-primary" type="submit" name="std_id" value="<?php echo $student_ids[$i]?>">Update</button></td>
                        </form>
                    </tr>
                <?php endfor;?>
            </tbody>
        </table>
    </div>
</body>
</html>