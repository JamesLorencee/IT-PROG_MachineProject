<?php
	session_start();
	require("connect.php");
	if (isset($_POST['go']) == 'Go') {
		//Getting the ID of the Logged In User/Employee
		$id = $_SESSION["getLogin"];
		$_SESSION['id'] = $id;

		//Get month and year input by the user
		$monthyear_input = $_POST["monthyear"];
		
		//Get first date and last date of chosen month and year
		$sdate = date('Y-m-01', strtotime($monthyear_input));
        $edate = date('Y-m-t', strtotime($monthyear_input));
		
		//Will check if there are at least 24 days entry for the month; 24 because 28 days (fewest day among months) - 4 no work days; rest days are paid
		$query = mysqli_query($DBConnect, "SELECT * FROM tbl_dtr WHERE id='$id' AND shiftDate BETWEEN '$sdate' AND '$edate'");
		$fetch = mysqli_fetch_array($query);
		$count = mysqli_num_rows($query);
		
		if ($count >= 24) {
			$_SESSION['getMonthYear'] =  $monthyear_input;
			header("location:computeSalary2.php");
		}
		else{
			header("location:computeSalary.php?error=1");
		}
	}
?>