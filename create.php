<?php
	require_once("connect.php");
	session_start();
	if(isset($_SESSION['username']))
	{	
		if(isset($_GET['username'])){
			if($_GET['username']!=$_SESSION['username'])
				{ echo "Sorry! You are not allowed to Enter!"; header('Location:index.php'); }
	 		else
			{
				$username=$_SESSION['username'];
				if(isset($_POST['submit']))
				{		
						$username=$_GET['username'];
						$desc=$_POST['desc'];
						$title=$_POST['title'];
						
						$query0="select * from $username";
						$res0=mysqli_query($connect, $query0);
						$count=mysqli_num_rows($res0);
						$count=$count+1;
						$form_id=$username."_".$count;
						

						$query1="insert into $username (form_id, title , description ) values ( '$form_id', '$title' , '$desc')";
						$res1=mysqli_query($connect , $query1);
			
						$qtable=$form_id."_Q";
						$query2="create table $qtable(qid varchar(250) NOT NULL primary key, question varchar(1000), type varchar(20) )";
						$res2=mysqli_query($connect , $query2);


						$atable=$form_id."_A";
						$query3="create table $atable ( user varchar(250) NOT NULL)";
						$res3=mysqli_query($connect, $query3);

						if(!$res0 || !$res1 || !$res2 || !$res3)
							echo mysqli_error($connect);
			
							
						$location="add.php?form_id=$form_id";
						header("Location:$location");
				}			
			}	}
		else
			header('Location:index.php');
	}
	else
		header('Location:login.php');


?>

<html>
	<head>
		<title>New Form</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css?family=Russo+One&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Khula:600|VT323&display=swap" rel="stylesheet">


        <style>



            h1 {
                font-family: 'Russo One', sans-serif;

                font-size: 40px;
                color: white;
                padding-top: 0px;
            }

            h2{
                background-color: antiquewhite;
            }

            form {
                padding: auto;
                font-size: 20px;


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



    <div align="center" id="h2"><h2>Let's Create a Form</h2></div>
     <div id="body1">
		<form method="POST">
			<div align="center"> Title of the Form: <input type="text" name="title" required></div>
			<div align="center">Description : &nbsp; &nbsp; &nbsp; &nbsp;<input type="text" name="desc" required></div>
            <br>
            <div align="center"><input id="submit" type="submit" name="submit" value="Create" style="font-size: 18px; color: #000; background-color: gainsboro;  "></div>
						
		</form>
     </div>
	</body>
</html>
