<?php
require_once("connect.php");
session_start();
if(isset($_POST) & !empty($_POST)){
    $username=$_POST['username'];
    $password_1=md5($_POST['password_1']);
    $query="select * from users where username='$username' and password='$password_1'";
    $result=mysqli_query($connect , $query);
    $count=mysqli_num_rows($result);
    if($count!=1)
        echo "Sorry! Login Failed.";
    else{
        $_SESSION['username']=$username;
        echo $_SESSION['username'];
        header('Location: index.php');
    }
}
if(isset($_SESSION['username']))
{

    echo '<div style="color: white; font-size: 10px;"><a>Logged in</a><br><a href="logout.php">Click here to logout</a>';
    }
?>


<html>
<head>
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Russo+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Khula:600|VT323&display=swap" rel="stylesheet">
    <style type="text/css" >

        *{

            background-image: url("https://lh3.googleusercontent.com/D5wDel0T56yg10rUG0KSJNLrzJ3CFPhG1z_avKfqi2GEhCR3_RGJ3DCBzRkDs4TQRA=h900");
            color: white;
            font-family: 'Khula', sans-serif;
            font-size: 30px;


        }

        h1 {
            font-family: 'Russo One', sans-serif;
            font-size: 40px;
            color: white;
        }



        #form label{
            padding: auto;
            color: white;

        }

        #form input{
            padding: 20px;
            color: white;
            font-size: 25px;
        }


        input login {
            height: 50px;
            width: 100px;
        }


    </style>


</head>

<body>
<div align="center" id="h1"><h1> &nbsp; &nbsp; NB FORMS</h1></div>
<div align="center" id="h2"><h2>&nbsp; &nbsp; &nbsp; &nbsp;<u><b>Login</b></u></h2></div>


<form name="form" id="general" method="post">
<br>
    <div align="center" class="input"><label>Username: </label><input type="text" name="username" required/></div>
    <div align="center" class="input"><label>Password: </label>&nbsp;<input type="password" name="password_1" required/></div>
    <br><br>
    <div align="center">&nbsp; &nbsp; &nbsp; <input name="login" id="submit" type="submit" value="Login"/></div>
</form>




<br><br>
<div align="center"><h4>Don't have an account?
        <a href="register.php">Sign Up</a></h4></div>
</body>
</html>
