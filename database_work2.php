<?php include('database_connection.php')?>

<?php

//Login table

$query1 = "CREATE TABLE IF NOT EXISTS STUDENT(
        Id INT(4) AUTO_INCREMENT,
        name_ varchar(20),
        email varchar(20),
        gender varchar(1),
        age NUMERIC(2),
        pass varchar(20),
        constraint student_pk PRIMARY KEY (Id)
)";
$query2 = "CREATE TABLE IF NOT EXISTS FACULTY(
        Id INT(4) AUTO_INCREMENT,
        name_ varchar(20),
        email varchar(20),
        gender varchar(1),
        age NUMERIC(2),
        pass varchar(20),
        constraint faculty_pk PRIMARY KEY (Id)
)";

$query3 = "CREATE TABLE IF NOT EXISTS COURSE(
        courseId INT(4) AUTO_INCREMENT,
        courseName varchar(30),
        semesterNo INT(1),
        facultyId INT(4) NOT NULL,
        constraint course_pk PRIMARY KEY (courseId),
        constraint course_fk FOREIGN KEY (facultyId) REFERENCES FACULTY(Id),
        constraint semester_limit CHECK(semesterNo IN (1,2,3,4,5,6))
)";
$query4 = "CREATE TABLE IF NOT EXISTS BOOK(
        bookId INT(4) AUTO_INCREMENT,
        bookName varchar(20),
        bEdition INT(2),
        publisher VARCHAR(20),
        courseId INT(4),
        constraint book_pk PRIMARY KEY (bookId),
        constraint courseId FOREIGN KEY (courseId) REFERENCES COURSE(courseId)
)";

$query5 = "CREATE TABLE IF NOT EXISTS STUDENT_FACULTY_COURSE_BRIDGE(
        studentId INT(4),
        courseId INT(4),
        score INT(3),
        attendance INT(2),
        constraint table_pk PRIMARY KEY (studentId, courseId),  
        constraint table_fk1 FOREIGN KEY (studentId) REFERENCES STUDENT(Id),
        constraint table_fk2 FOREIGN KEY (courseId) REFERENCES COURSE(courseId),
        constraint att_limit CHECK (attendance >= 0 AND attendance <= 45)
)";

$result = mysqli_query($connection, $query1);
echo "<br>";
echo mysqli_error($connection);

$result = mysqli_query($connection, $query2);
echo "<br>";
echo mysqli_error($connection);

$result = mysqli_query($connection, $query3);
echo "<br>";
echo mysqli_error($connection);

$result = mysqli_query($connection, $query4);
echo "<br>";
echo mysqli_error($connection);

$result = mysqli_query($connection, $query5);
echo "<br>";
echo mysqli_error($connection);


?>