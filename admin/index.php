<?php
    include_once '../db_connection.php';
    session_start();
    if(isset($_SESSION["email"]))
	{
		session_destroy();
    }
    
    $ref=@$_GET['q'];
    if(isset($_POST['submit']))
	{	
        $email = $_POST['email'];
        $password = $_POST['password'];

        $email = stripslashes($email);
        $email = addslashes($email);
        $password = stripslashes($password); 
        $password = addslashes($password);

        $email = mysqli_real_escape_string($con,$email);
        $password = mysqli_real_escape_string($con,$password);
        
        $result = mysqli_query($con,"SELECT * FROM admin WHERE adminEmail = '$email' and password = '$password'") or die('Error');
        $count=mysqli_num_rows($result);
        if($count==1)
        {
            session_start();
            if(isset($_SESSION['email']))
            {
                session_unset();
            }
            $_SESSION["admin"] = $email;
            header("location:dashboard.php?");
        }
        else
        {
            echo "<center><h3><script>alert('Sorry.. Wrong Username (or) Password');</script></h3></center>";
            header("refresh:0;url=index.php");
        }
    }
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Admin Login | Online Quiz System</title>
	<style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
    margin: 0;
    padding: 0;
}

.container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.box-wrapper {
    max-width: 450px;
    width: 100%;
    padding: 50px;
    padding-left: 25px;
    background-color: aliceblue;
    border-radius: 10px;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
}

.box-body {
    text-align: left;
}

h3 {
    margin-top: 0;
    color: #333;
    font-size: 20px;
}

form {
    margin-top: 30px;
}

.form-group {
    margin-bottom: 15px;
}

label {
    display: block;
    font-weight: bold;
    margin-bottom: 10px;
    color: #333;
    font-size: 18px;
}

input[type="text"],
input[type="password"] {
    width: 100%;
    padding: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}

.btn {
    display: inline-block;
    padding: 15px 30px;
    background-color: #333;
    color: #fff;
    text-align: center;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
    cursor: pointer;
    font-weight: bold;
    font-size: 16px;
    border: none;
    outline: none;
}

.btn:hover {
    background-color: #555;
}

    </style>
    </head>

	<body>
		<section class="login first grey">
			<div class="container">
				<div class="box-wrapper">				
					<div class="box box-border">
						<div class="box-body">
                           
                          <h3>   Login to  ADMIN page </h3>
							<form method="post" action="index.php" enctype="multipart/form-data">
								<div class="form-group">
									<label>Enter Username:</label>
									<input type="text" name="email" class="form-control">
								</div>
								<div class="form-group">
									<label>Enter Password:
									</label>
									<input type="password" name="password" class="form-control">
								</div> 
								<div class="form-group text-right">
									<button class="btn btn-primary btn-block" name="submit">Login</button>
								</div>
								
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>

		
	</body>
</html>