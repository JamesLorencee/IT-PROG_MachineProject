<?php
	session_start();
	if (!isset($_SESSION["getLogin"])) {
		header("location:login.php");
	} 
	else {
		if (isset($_POST['go']) == 'Go') {
			include("connect.php");
			$id = $_SESSION["getLogin"];
		 
			$position = $_POST['position'];
			$today = date("Y-m-d");
			$update = mysqli_query($DBConnect, "UPDATE tbl_employees SET position='$position' WHERE id='$id'");
			$update1 = mysqli_query($DBConnect, "INSERT tbl_emp_position SET id = '$id', position = '$position', effectiveDate = '$today'");

			if (mysqli_affected_rows($DBConnect)) {
				header("location:mainMenu.php");
			}
		}
	}
?>