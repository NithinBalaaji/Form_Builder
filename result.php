<?php
	require_once("connect.php");
	session_start();
	if(isset($_SESSION['username']))
	{
		$username=$_SESSION['username'];
		if(isset($_GET['form_id']))
		{	
			$form_id=$_GET['form_id'];
			$arr=explode('_' , $form_id);
			$admin=$arr[0];
			if($admin!=$username)
				echo "Permission denied";
			else
			{	
				$ok=1;	
				$questable=$form_id."_Q";
				$anstable=$form_id."_A";
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
		<title>Results</title>
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



    <?php
			if(isset($ok))
			{
				$query1="select * from $username where form_id=\"$form_id\"";
				$result1=mysqli_query($connect , $query1);
				if(!$result1)
					echo mysqli_error($connect);

				while($row1=mysqli_fetch_array($result1)){
					echo "<br><br><div align='center' style='font-size: 24px; background-color: ghostwhite;'>Title: <span>".$row1['title']."</span></div><div align='center' style='font-size: 18px;background-color: ghostwhite;'>Description: <span>".$row1['description']."</span></div>";
					echo "<div align='center' style='font-size: 18px; background-color: ghostwhite;'>Link: <span style='color: mediumblue'><b><u>http://localhost/registration/form.php?form_id=".$row1['form_id']."</u></b></span></div>";
				}
				echo "<br><br>";
				echo "<div align='center' style='background-color: ghostwhite;'>Questions given in the Form were:<br>";
                $query3 = "select * from $questable";
                $result3 = mysqli_query($connect, $query3);
                while ($rowq = mysqli_fetch_array($result3)) {
                    echo "<li>" . $rowq['question'] . "</li>";
                }
                echo "</div>";
				$query2="select * from $anstable";
				$result2=mysqli_query($connect , $query2);
				if(!$result2) {
				    echo "No Responses Received.";
                    echo mysqli_error($connect);
                }
				$total=mysqli_num_rows($result2);
				
				
				
				while($rowa=mysqli_fetch_array($result2)) {
                    echo "<ol>";
                    echo "<div style='font-size: 18px;'>User: " . $rowa['user'] . "</div>";
                    $query3 = "select * from $questable";
                    $result3 = mysqli_query($connect, $query3);
                    if (!$result3)
                        echo mysqli_error($connect);

                    while ($rowq = mysqli_fetch_array($result3)) {

                        $q = $rowq['qid'];
                        echo "<li>" . $rowq['question'] . "  " . $rowa[$q] . "</li>";
                    }

                    echo "</ol>";

                }


			}



		?>

	</body>

</html>
					



						







								
										
	







					
			
