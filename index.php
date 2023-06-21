<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<title>Login</title>
</head>
<body>
	<section class="section" id="section">
		<div class="conteyner">
			<div class="form">
				<h1 class="loginText">log in</h1>
				<form action= "index.php" method="POST" class="formVal" id="login">
					<input type="text" name="username" required="required" placeholder="Username" class="input"><br>
					<input type="password" name="password" required="required" placeholder="Password" class="input" autocomplete="off"><br>
					<p class="remember">Remember me<input type="checkbox" name="remember_me" value="yes" class="checkbox"></p><br>
					<?php
						require_once "php/helper.php";
						require_once "php/config.php";
						
						$ip = $_SERVER['REMOTE_ADDR'];
						$conn = new mysqli($hn, $un, $pw, $db);
						if ($conn->connect_error) die($conn->connect_error);
				
						$result = $conn->query("SELECT * FROM remember WHERE ip = '$ip';");
						if(!$result) die("query in myslq");							
						if($result->num_rows != 0){
							for($i=0; $i < $result->num_rows; $i++){
								$result->data_seek($i);
								$row = mysqli_fetch_array($result, MYSQLI_NUM);
								if($row[0] == $ip){
									$id=$row[1];
									$result = $conn->query("INSERT INTO login(ip, id) VALUE('$ip', '$id');");
									if(!$result) die("query in myslq");
									header("Location: query.php");
									exit();
								}
							}
						}
					
					
						if(isset($_POST['username']) && isset($_POST['password'])){
							$login=fix_mysql($conn, $_POST['username']);
							$pass=fix_mysql($conn, $_POST['password']);
							$remember='';
							if(isset($_POST['remember_me'])) $remember=fix_mysql($conn, $_POST['remember_me']);



							$query="SELECT * FROM account WHERE login = '$login';";
					
							$result = $conn->query($query);
							if(!$result) die("query in myslq");

							for($i=0; $i < $result->num_rows; $i++){
								$result->data_seek($i);
								$row = mysqli_fetch_array($result, MYSQLI_NUM);
								if($row[2] == md5($pass)) {
									$id=$row[0];
									if($remember == 'yes')
										if(!($conn->query("INSERT INTO remember(ip, id) VALUE('$ip', '$id');"))) die("query in mysql");

									$result = $conn->query("INSERT INTO login(ip, id) VALUE('$ip', '$id');");
									if(!$result) die("query in myslq");
									header("Location: query.php");
									exit();
								}
							}
							echo "<p class = 'errorLog'>Wrong Data</p><br>";
					
						}
?>
					<input type="submit" class="submit" value="login"><br>
				</form>
			</div>
		</div>
	</section>
</body>
</html>