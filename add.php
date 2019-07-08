<?php
	require_once("connect.php");
	session_start();
	if(isset($_SESSION['username']))
	{


        if(isset($_GET['form_id']))

		{	$set=0;
			$username=$_SESSION['username'];
			$form_id=$_GET['form_id'];
			$questable=$form_id."_Q";
			$anstable=$form_id."_A";



            if(isset($_POST['add']))
			{		
				$question=mysqli_real_escape_string($connect , $_POST['question']);
				$type=$_POST['type'];
				
				
				$query0="select * from $questable";
				$res0=mysqli_query($connect , $query0);
				$count = mysqli_num_rows($res0);
				

				$count=$count+1;
				$qid="Q_".$count;
		
				if($count>0)
					$gen=1;

				$query1="insert into $questable ( qid, question ,type ) values( '$qid' , '$question' , '$type' )";
				$res1=mysqli_query($connect , $query1);
		
				$query2="alter table $anstable add $qid varchar(2000)";
				$res2=mysqli_query($connect, $query2);
				

		
				if(!$res0 || !$res1 || !$res2)
					echo mysqli_error($connect);


			}

            if(isset($_POST['submit']))
            {
                $set=1;
                $gen=0;
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
		<title>Build Form</title>
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
                font-size: 20px;

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

    <br><br><br><br><br>
		<?php require_once("connect.php");
		      $username=$_SESSION['username'];
			    $username;
			$query3="select * from $username where form_id=\"$form_id\"";
			$res3=mysqli_query($connect , $query3);
			$row=mysqli_fetch_array($res3);
			if(!$res3)
				echo mysqli_error($connect);
		        echo '<div align="center">Form title: <span>'.$row['title'].'</span></div><div align="center">Description: <span>'.$row['description'].'</span></div><br>';
			if(isset($gen)&&$gen==1) { echo '<form method="POST"><div align="center"><input id="submit" type="submit" value="Generate Link" name="submit" style="font-size: 20px"></div>
                                        </form>'; }
			$query4="select * from $questable";
			$res4=mysqli_query($connect , $query4);
			if(!$res4)
				echo mysqli_error($connect);
			    
			echo "<ol>";
			while($row4=mysqli_fetch_array($res4))
				echo '<li><span>'.$row4['question'].'</span> ('.$row4['type'].')</li>';
		 	echo "</ol>";
			
		?> 
		<?php if($set!=1){
		echo '<form method="POST">
			<div align="center">Question: <input type="text" name="question" style=" font-size: 17px; height: 60px; width:280px;" required></div>
			<div align="center">Answer Type:  &nbsp;&nbsp;       Text<input type="radio" name="type" value="text" required>    &nbsp;&nbsp;&nbsp;      Number<input type="radio" name="type" value="number" required> </div>         
			<div align="center"><input id="submit" type="submit" value="Add" name="add" style="font-size: 20px"></div>
		</form>';
		}
		?>

		<?php if($set==1) {
			echo '<div align="center">Link for the form is: &nbsp; <a style="color: mediumblue;" href="http://localhost/registration/form.php?form_id='.$form_id.'"><b><u>http://localhost/registration/form.php?form_id='.$form_id.'</u></b></a></div>';
			echo '<form method="POST">
                    <div><input id="submit" type="submit" value="Alter" name="alter" style="font-size: 17px"></div>';
            if(isset($_POST['alter']))
            {
                $set=0;
                $gen=1;
            }

		} ?>



<!--        //        $set=0;-->
<!--//        echo '<form method="POST">-->
<!--//			<div>Question: <input type="text" name="question"></div>-->
<!--//			<div>Type:    &nbsp;&nbsp;&nbsp;       Text<input type="radio" name="type" value="text">    &nbsp;&nbsp;&nbsp;      Number<input type="radio" name="type" value="number"></div>-->
<!--//			<div><input id="submit" type="submit" value="add" name="add"></div>-->
<!--//		</form>';-->








	</body>
</html>
