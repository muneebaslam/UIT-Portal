<?php require('database_connection.php') ?>

<?php
    session_start();
    $visitor_name = $_SESSION['visitor_name'];
    $current_course = $_GET['current_course'];
    $query = "SELECT courseName from COURSE where courseId = '$current_course'";
    $res  =mysqli_query($connection, $query);
    $course_name = mysqli_fetch_assoc($res)['courseName'];
    $query = "SELECT bookName, bEdition, publisher FROM BOOK
            WHERE courseId = '$current_course'";
    $result = mysqli_query($connection, $query);

    $book_names = array();
    $book_editions = array();
    $book_publisher = array();

    while($row = mysqli_fetch_assoc($result)){
        array_push($book_names, $row['bookName']);
        array_push($book_editions, $row['bEdition']);
        array_push($book_publisher, $row['publisher']);
    }


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
        h1,h3{
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
        <h1><?php echo $course_name ?> Books</h1>
        <h3>Course Code: <?php echo $current_course?></h3>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th scope="col">Book Name</th>
                    <th scope="col">Book Edition</th>
                    <th scope="col">Publisher</th>
                </tr>
            </thead>
            <tbody class="">
                <?php for($i = 0; $i < sizeof($book_names); $i++): ?>
                    <tr>    
                        <td scope="row"><?php echo $book_names[$i];?></td>
                        <td scope="row"><?php echo $book_editions[$i];?></td>
                        <td scope="row"><?php echo $book_publisher[$i];?></td>
                    </tr>
                <?php endfor;?>
        </table>
    </div>
</body>
</html>