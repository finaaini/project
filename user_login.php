<?php
    $server = "localhost";
	$user = "root";
	$pass = "";
	$database = "login";

    $koneksi = mysqli_connect($server, $user, $pass, $database);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Healthy Food</title>        
    <meta charset="utf-8">
    <!-- This file has been downloaded from Bootsnipp.com. Enjoy! -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        /* Made with love by Mutiullah Samim*/

@import url('https://fonts.googleapis.com/css?family=Numans');

html,body{
/*background-image: url('img/spedo.jpg');*/
background-size: cover;
background-repeat: no-repeat;
height: 100%;
font-family: 'Numans', sans-serif;
}

.container{
height: 100%;
align-content: center;
}

.card{
height: 370px;
margin-top: auto;
margin-bottom: auto;
width: 400px;
background-color: rgba(0,0,0,0.5) !important;
}

.social_icon span{
font-size: 60px;
margin-left: 10px;
color: #ff0157;
}

.social_icon span:hover{
color: white;
cursor: pointer;
}

.card-header h3{
color: white;
}

.social_icon{
position: absolute;
right: 20px;
top: -45px;
}

.input-group-prepend span{
width: 50px;
background-color: #ff0157;
color: black;
border:0 !important;
}

input:focus{
outline: 0 0 0 0  !important;
box-shadow: 0 0 0 0 !important;

}

.remember{
color: white;
}

.remember input
{
width: 20px;
height: 20px;
margin-left: 15px;
margin-right: 5px;
}

.login_btn{
color: black;
background-color: #ff0157;
width: 100px;
}

.login_btn:hover{
color: black;
background-color: white;
}

.links{
color: white;
}

.links a{
margin-left: 4px;
}
    </style>
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</head>
<body>
<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
   <!--Made with love by Mutiullah Samim -->
   
	<!--Bootsrap 4 CDN-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<!--Custom styles-->
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body style="background-image: url('assets/img/bg.jpg');">
<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3>User</h3>
				<div class="d-flex justify-content-end social_icon">
					<span><i class="fab fa-facebook-square"></i></span>
					<span><i class="fab fa-google-plus-square"></i></span>
					<span><i class="fab fa-twitter-square"></i></span>
				</div>
			</div>
			<div class="card-body">
				<form action="" method="POST">
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" class="form-control" name="username" placeholder="username" required>
						
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" class="form-control" name="passw" placeholder="password"  required>
					</div>
					<div class="row align-items-center remember">
						<input type="checkbox">Remember Me
                    </div>
                    
					<div class="form-group">
                        <input type="submit" value="Login" name="login1" class="btn float-right login_btn">
                    </div>
                    
                </form>

                <?php
                    if(isset($_POST['login1'])){

                        $username   = $_POST['username'];
                        $pass       = $_POST['passw'];

                        $cek_user   = mysqli_query ($koneksi, "SELECT * FROM data_login WHERE username='$username'");
                        $row        = mysqli_num_rows ($cek_user);

                        if($row === 1){
                            //jalankan prosedur seleksi pasword
                            $fetch_pass = mysqli_fetch_assoc($cek_user);
                            $cek_pass   = $fetch_pass['pasword'];
                            if($cek_pass <> $pass){
                                echo "<script>
                                alert('password salah!');
                                document.location='user_login.php';
                            </script>";
                            }
                            else{
                                echo "<script>
                                document.location='index4.php';
                            </script>";
                            }
                        }
                        else{
                            echo "<script>
                            alert('password salah!');
                            document.location='user_login.php';
                        </script>";
                        }
                    }

                ?>
                


			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center links">
					Bukan user? klik untuk<a href="admin_login.php">login Admin</a>
				</div>
				<div class="d-flex justify-content-center">
					<a href="register_user.php">Daftar sekarang</a>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>
<script type="text/javascript">

</script>
</body>
</html>
