<?php
	SESSION_START();
	$_SESSION['logged']="no";

	include ("conexion.php");

	$usuario = $_REQUEST['user'];
	$password = $_REQUEST['pass'];

	$con = mysqli_connect($host, $user, $pw, $db);
	$con->set_charset("utf8");
	$normal = mysqli_query($con, "SELECT password FROM usuarios WHERE user = '$usuario'");

	if ($row = mysqli_fetch_array($normal)) {

		if (password_verify($password,$row[0])) {
			$_SESSION['logged']="ok";
			$_SESSION['user']=$usuario;
			header("Location: index.php");
			//echo "normal";
		} else {
			$_SESSION['logged']="no";
			//header("Location: login.php");
			//echo "ninguno";
			echo "PW: ".$password."<BR> HASH: ".$row[0];
		}

	} else {
		$_SESSION['logged']="no";
		header("Location: login.php");
		//echo "ninguno";
	}

?>