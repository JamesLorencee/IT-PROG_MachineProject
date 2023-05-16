<?php
	session_start();
	require("connect.php");
	if (isset($_POST['go']) == 'Go') {
		if (empty($_POST["week"])) {
			header("location:dtr.php?error=2");
		}
		else {
			$id = $_SESSION["getLogin"];
			$_SESSION['id'] = $id;

			$week_input = ($_POST["week"]);
			$sdate = date('Y-m-d', strtotime($week_input));
			$edate = date('Y-m-d', strtotime($sdate . "+6 days"));
			
			//Will check if there is already existing week dtr created by the user
			$weekquery = mysqli_query($DBConnect, "SELECT * FROM tbl_dtr WHERE id='$id' AND shiftDate BETWEEN '$sdate' AND '$edate'");
			$count = mysqli_num_rows($weekquery);

			//More than 0 means there are existing records already of the inputted week by the user.
			if ($count > 0) {
				header("location:dtr.php?error=1");
			}
			//0 will redirect you to dtr2.php, the next page.
			else{
				$_SESSION['getWeek'] =  $week_input;
				header("location:dtr2.php");  //this sets the headers for the HTTP response given by the server 
			}
		}
	}
?>