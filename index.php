<?php
require_once("connect.php");
session_start();
if(isset($_SESSION['username'])){
    $username=$_SESSION['username'];
     $query="select fullname from users where username='$username'";
    $result=mysqli_query($connect , $query);
    $row = mysqli_fetch_array($result);
    $name = $row['fullname'];
    }

else
    header('Location:login.php');

?>




<html>
<head>
    <title>NB Forms</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Russo+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Khula:600|VT323&display=swap" rel="stylesheet">


    <style>



        h1 {
            font-family: 'Russo One', sans-serif;
            background: indigo;
            font-size: 40px;
            color: white;
            padding-top: 0px;
        }




        #form label{
            padding: auto;


        }

        #form input{
            padding: 20px;

            font-size: 25px;
        }

        nav{
            background: rebeccapurple;
            text-align: center;
            padding-top: 0px;
        }

        nav ul{
            margin: 0;
            padding:0;
            list-style: none;
        }

        nav li{
            display: inline-block;
            margin-left: 70px;

        }

        nav a{
            text-decoration: none;
            text-transform: uppercase;
            font-size: 20px;
            color: aqua;


        }

        nav a:hover{
            background-color: cornflowerblue;
        }



        body{
            background-image: url("https://cdn.24slides.com/templates/upload/templates-previews/v0fvgx02y69m27KrXEj87zkwMFNthuickY27llQ8.jpg");
            background-repeat: no-repeat;
            font-family: 'Khula', sans-serif;
        }

    </style>


</head>
<body>


<nav id="nav">
    <ul>
        <div class="name"><h1>NB Forms</h1></div>
        <li><a href="index.php">Home</a></li>
        <li><?php echo '<a class="btn" href="create.php?username='.$username.'">New Form</a>'; ?></li>
        <li><a href="formsdisplay.php">Existing Forms</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</nav>


<div id="left" style="font-size: 25px;"><h3><?php echo "Welcome to NB Forms: $name <br> You are Logged in. <br>  "?></h3></div>
<br><br>





</body>




</html>
