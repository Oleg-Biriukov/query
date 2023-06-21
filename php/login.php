<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../css/main.css">
	<title>LOGIN</title>
</head>
<body>
	<section class="section">
		<div class="conteyner">
			
		</div>
	</section>
</body>
</html>
	<?php
		require_once "helper.php";
		require_once "config.php";
	
		$conn = new mysqli($hn, $un, $pw, $db);
		if ($conn->connect_error) die($conn->connect_error);
	
	
		if(isset($_POST['username']) && isset($_POST['password'])){
			$login=fix_mysql($conn, $_POST['username']);
			$pass=fix_mysql($conn, $_POST['password']);
			if(isset($_POST['remember_me'])) $remember=fix_mysql($conn, $_POST['remember_me']);
	
			$query="SELECT * FROM ACCOUNT WHERE login = $login";
	
			$result = $conn->query($query);
			if(!$result) die("query in myslq");
	
			if($remember == 'yes'){
				// code
			}
	
			for($i=0; $i < $result->num_rows; $i++){
				$result->data_seek($j);
				$row = mysqli_fetch_array($result, MYSQLI_NUM);
				if($row[2] == md5($pass)) {
					echo "<p class=''>success<\p><br>";
					sleep(5);
					break;
				}else{}


			}
	
		}
?>