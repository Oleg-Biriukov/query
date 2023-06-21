<?php
	function mysql_fatal_error($msg){
		$msg2 = mysql_error();
		echo <<< _END
	Cant finishing require task

		<p>$msg: $msg2</p>
	_END;
	}

	function fix_mysql($conn, $var){
		$var = stripslashes($var);
		$var = strip_tags($var);
		return htmlentities($conn->real_escape_string($var));
	}

?>