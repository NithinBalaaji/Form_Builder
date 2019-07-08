<?php
	require_once("connect.php");

	if(isset($_POST) & !empty($_POST)) {
        $name = mysqli_real_escape_string($connect, $_POST['name']);
        $username = mysqli_real_escape_string($connect, $_POST['username']);
        $password_1 = md5($_POST['password_1']);
        $password_2 = md5($_POST['password_2']);
        $email = mysqli_real_escape_string($connect, $_POST['email']);


        if (strpos($username, " ") !== false)
            $error = "Username cannot contain spaces";
        else if (strpos($username, '_') !== false)
            $error = "Username cannot contain underscore";
        else {
            $que = "select * from users where username=\"$username\"";
            $re = mysqli_query($connect, $que);
            $count = mysqli_num_rows($re);
            if ($count != 0)
                $error = "Username already exists";
            else if ($password_1 != $password_2) {
                $error = " Passwords don't match";
            } else {


                $query1 = "INSERT INTO users (fullname, username, password, email) VALUES ('$name' , '$username' , '$password_1' , '$email')";
                $res1 = mysqli_query($connect, $query1);
                $query2 = "create table $username ( form_id varchar(250) , title varchar(255) NOT NULL , description varchar(1000) , primary key(form_id))";
                $res2 = mysqli_query($connect, $query2);
                if (!$res1 || !$res2)
                    echo("error:" . mysqli_error($connect));
                else
                    header('Location: login.php');
            }
        }

    }

?>


<html>
	<head>
		<title>Register</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css?family=Russo+One&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Khula:600|VT323&display=swap" rel="stylesheet">
        <style type="text/css" >

            *{

                background-image: url("https://lh3.googleusercontent.com/D5wDel0T56yg10rUG0KSJNLrzJ3CFPhG1z_avKfqi2GEhCR3_RGJ3DCBzRkDs4TQRA=h900");
                color: white;
                font-family: 'Khula', sans-serif;
                font-size: 20px;


            }

            h1 {
                background-color: rebeccapurple;
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
                text-align: right;
                color: white;
                font-size: 25px;
            }
            </style>

	</head>

	<body>
		<div align="center" id="h1"><h1>NB FORMS</h1></div>
        <div align="center"><h2><b><u>Register</u></b></h2></div>
		<form method="post">
			<div align="center">Full Name:&nbsp;  <input type="text" name="name" required></div>

			<div align="center">Username:&nbsp <input type="text" name="username" required></div>
			<div align="center">Password: &nbsp; <input type="password" name="password_1" required></div>
            <div align="center">Confirm: &nbsp &nbsp  <input type="password" name="password_2" required></div>
			<div align="center">E-Mail ID: &nbsp <input type="text" name="email" required></div>
            <br><br>
			<div align="center"><input id="submit" type="submit" value="Register"></div>
		</form>
		<?php
			if(isset($error)){
				echo "<br><div align='center'>".$error.", Oh! Please Try Another Username</div>";
			}
		?>
		<br><br>
		<div align="center"><h4>If you already have an account, please
		<a class="btn" href="login.php">Login here</a></h4></div>
	</body>
</html>