<?php require('database_connection.php')?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body{
        background-image:url('images/bg_img_3.jpg');
        background-repeat: no-repeat;
        background-size: inherit;
        }

    </style>
</head>
<body style="padding: 1% 5% 1% 5%;"> 

    <div style="background-color:rgba(236, 250, 215,0.5) ; padding: 5em 35%; height:30em"> 
        <form style="margin:auto;" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            <table>
            <tr>
            <td><h1 style="text-align: center;">Login</h1></td>
            </tr>

            <tr>
                <td><input type="text" name='id' placeholder="id"></td>
            </tr>
            <tr>
                
                <td><input type="password" name='password' placeholder="password"></td>
            </tr>
            <tr>
                <td colspan=""><input style="width: 100%;" type="submit" value="Login" name='login'></td>
            </tr>
            </table>
        </form>
        <br><br><br>
        <h3 id='wrong_pass'></h3>
    </div>
</body>

<?php
    session_start();
    if (isset($_GET['show'])){
        echo "<script>
                my_el = document.getElementById('wrong_pass')
                my_el.innerText = 'Invalid id or password'
                my_el.style = 'color: red';
            </script>";
    }
    if (isset($_POST['login'])){
        $curr_user = $_POST['id'];
        $curr_user_pass = $_POST['password'];
        // if($_SESSION['member'] == 'faculty'){
        //     $my_query = "SELECT * FROM FACULTY WHERE facultyId = '$curr_user' and pass='$curr_user_pass'";
        // }else{
        //     $my_query = "SELECT * FROM STUDENT WHERE studentId = '$curr_user' and pass='$curr_user_pass'";
        // }
        $table_name = $_SESSION['member'];

        $my_query = "SELECT * from $table_name WHERE id = '$curr_user' AND pass='$curr_user_pass'";
        $result = mysqli_query($connection,$my_query);
        
        if(mysqli_num_rows($result) > 0){
            if($_SESSION['member'] == 'FACULTY'){
                $usr = mysqli_fetch_assoc($result)['Id'];

                $_SESSION['current_user'] = $usr;
                header('location:faculty.php');
                die();
            }
            $usr = mysqli_fetch_assoc($result)['Id'];
            $_SESSION['current_user'] = $usr;
            header('location:student.php');

        }else{
            header('location:login.php?show=true');
        }   


    }

    
?></html>