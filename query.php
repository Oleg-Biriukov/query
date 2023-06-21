<?php
	require_once "php/helper.php";
	require_once "php/config.php";
	$ip = $_SERVER['REMOTE_ADDR'];
	$conn = new mysqli($hn, $un, $pw, $db);
	if ($conn->connect_error) die($conn->connect_error);
	$result = $conn -> query("SELECT * FROM login;");
	if(!$result) die("query in mysql");
	$num = $result->num_rows;
	if ($num > 0){
		for($i=0; $i < $num; $i++){
			$result->data_seek($i);
			$row = mysqli_fetch_array($result, MYSQLI_NUM);
			if ($ip == $row[0]) break;
			if ($ip != $row[0] && $i+1 == $num){
				header("Location: index.php");
				exit();
			}
		}
	}else{
		header("Location: index.php");
		exit();
	}

	$account = $conn -> query("SELECT * FROM account, login WHERE account.id = login.id;");
	if(!$result) die ("query in mysql");
	$account->data_seek(0);
	$row = mysqli_fetch_array($account, MYSQLI_NUM);

	$name=$row[1];
	$surname=$row[3];
	$login=$row[4];
	$ip=$row[5];


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/query.css">
	<title>About</title>
</head>
<body>
	<section class="section">
		<div class="conteyner">
			<div class="about">
				<table class="table">
					<caption class="titleTable">about me</caption>
					<tr class="rows">
						<th class="col">name</th>
						<th class="col">surname</th>
						<th class="col">login</th>
						<th class="col">ip</th>
					</tr>
					<?php echo "<tr class='rows'><td class='col'>$name</td><td class='col'>$surname</td><td class='col'>$login</td><td class='col'>$ip</td></tr></td";?>
				</table>
			</div>
		</div>
	</section>
</body>
</html>