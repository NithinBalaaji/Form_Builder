<?php 
	require_once("connect.php");
	session_start();
	if(isset($_SESSION['username']))
		{ 
			if(isset($_GET['form_id']))
			{	$count_q=0;
				if(isset($_SESSION['username']))
				{	$form_id=$_GET['form_id'];
					$arr=explode('_' , $form_id);
					$admin=$arr[0];
					$username=$_SESSION['username'];
					$questable=$form_id."_Q";
					$anstable=$form_id."_A";
					$query0="select * from $username where form_id=\"$form_id\"";
					$res0=mysqli_query($connect , $query0);
					$count0=mysqli_num_rows($res0);
					if(!$res0)
						echo mysqli_error($connect);
					if($query0){
					   header('Location: http://localhost/registration/formsdisplay.php?username=$username');

                    }

					else
					{	 
						
						$submit=0; 
						if(isset($_POST['submit']))
						{
								$submit=1;
								$i=1;
								 $query2="insert into $anstable (user) values ('$username')";
								$res2=mysqli_query($connect, $query2);
								if(!$res2)
									echo mysqli_error($connect);
								$query11="select * from $questable";
								$result11=mysqli_query($connect , $query11);
								$count_q=mysqli_num_rows($result11);
								while($i<=$count_q)
								{	 $q="Q_".$i;
									$ans=$_POST[$q];
									$query="update $anstable set $q ='$ans' where user=\"$username\"";
									$result=mysqli_query($connect , $query);
									if(!$result)
										echo mysqli_error($connect);
									$i=$i+1;		
								}

						}
					}
				}	
			}
			else
				header('Location:index.php');
	}
	else
		header('Location:login.php');

?>




<html>
	<head>
		<title>Form</title>
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
            <li><a href="logout.php">Logout</a></li>
            <li><?php echo '<a class="btn" href="create.php?username='.$username.'">New Form</a>'; ?></li>
            <li><a href="#">Existing Forms</a></li>
        </ul>
    </nav>

	<?php	
		require_once("connect.php");
		$query3="select * from $admin where form_id=\"$form_id\"";
			$result3=mysqli_query($connect, $query3);
			while($row3=mysqli_fetch_array($result3))
			{
				echo '<br><div align="center" style="font-size: 20px">Title: <span>'.$row3['title'].'</span><br></div><div align="center" style="font-size: 18px">Description: <span>'.$row3['description'].'</span></div>';
			}
		echo "<br><br>";
		if(isset($submit)&&$submit==0)
		{
			$query1="select * from $questable";
			$result1=mysqli_query($connect , $query1);
			$count_q=mysqli_num_rows($result1);
			if(!$result1)
				echo mysqli_error($connect);
			
			
			while($row=mysqli_fetch_array($result1))
			{
				echo '<form method="POST">
				<div align="center" style="font-size: 20px">'.$row['question'].'<br><input type="'.$row['type'].'"name="'.$row['qid'].'" style="font-size: 15px; height: 30px; width: 200px;"></div><br><br>';

			}

			echo '<br><div align="center"><input id="submit" type="submit" value="Submit" name="submit" style="font-size: 18px"></div></form>';
		}
		else
		    if($submit==1){
			echo "You have filled the form successfully";
		}

    ?>
	</body>
</html>
