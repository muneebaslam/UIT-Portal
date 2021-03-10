<?php require('database_connection.php') ?>
<?php
    session_start();
    $visitor_name = $_SESSION['visitor_name'];
    $current_student = $_SESSION['current_user'];
    $semester_no = $_SESSION['semester_number'];
    $query  = "SELECT * FROM COURSE WHERE courseId IN 
            (SELECT courseId FROM STUDENT_FACULTY_COURSE_BRIDGE WHERE studentId = '$current_student') AND semesterNo = '$semester_no'";

    $result = mysqli_query($connection, $query);
    
    $courses = array();
    $course_codes = array();
    
    while ($row = mysqli_fetch_assoc($result)){
        array_push($courses, $row['courseName']);
        array_push($course_codes, $row['courseId']);
    }
    $useable_c_c = join("','",$course_codes);
    //print_r($useable_c_c);
    // echo "$current_student";
    $query2 = "SELECT score, attendance FROM STUDENT_FACULTY_COURSE_BRIDGE WHERE courseId IN ('$useable_c_c') AND studentId='$current_student'";

    $result2 = mysqli_query($connection, $query2);
    $attendance = array();
    $scores = array();
    while ($row = mysqli_fetch_assoc($result2)){
        array_push($attendance, $row['attendance']);
        array_push($scores, $row['score']);
    }
    
    // print_r($attendance);
    // print_r($scores);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>Document</title>
    <style>
        td {
            text-align: center;
            font-weight: bolder;
        }
        h1{
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
    <a class="navbar-brand"><img style="transform: translate(0px,-5px);" src="images/logo.png" height="30" width="35px" alt=""><strong>  Utah University </strong></a>
    <h5 style="display: inline-block; margin-right:2em; transform: translate(310px, 5px);"><?php echo $visitor_name?></h5>
    <button class="btn btn-outline-dark" style="transform: translate(140px, 0px);" onclick="location.href='helpdesk.php'">Help desk</button>
    <form method="" action="index.php">
        <button class="btn btn-outline-dark" type="submit" name="logout_btn">Logout</button>
    </form>
    </nav>
    <br><br><br>
    <div class="container">
        <h1>Semester <?php echo $_SESSION['semester_number'] ?> Summary</h1>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th scope="col">Course Code</th>
                    <th scope="col">Course Title</th>
                    <th scope="col">Lect. Attended Out of 45</th>
                    <th scope="col">Marks out of 100</th>
                    <th scope="col">Recomended Books</th>
                </tr>
            </thead>
            <tbody class="">
                <?php for($i = 0; $i < sizeof($courses); $i++): ?>
                    <tr>    
                        <td scope="row"><?php echo $course_codes[$i];?></td>
                        <td scope="row"><?php echo $courses[$i];?></td>
                        <td scope="row"><?php echo $attendance[$i];?></td>
                        <td scope="row"><?php echo $scores[$i];?></td>
                        <td scope="row"><a href="books.php?current_course=<?php echo $course_codes[$i]?>">Course material</a></td>
                    </tr>
                <?php endfor;?>
        </table>
    </div>
</body>
</html>
