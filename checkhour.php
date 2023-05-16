<?php
	session_start();
	require("connect.php");
	if (isset($_POST['submit']) == 'Submit') {
		//Getting the ID of the Logged In User/Employee
		$id = $_SESSION["getLogin"];
		$_SESSION['id'] = $id;

		$timeIn = $_POST["timeIn"];
		$timeOut = $_POST["timeOut"];
		$regrate = $_SESSION["getREGrate"];
		$otrate = $_SESSION["getOTrate"];
		$_SESSION['getTimeIn'] = $timeIn;
		$_SESSION['getTimeOut'] = $timeOut;
	
		//-1 because lunch
		$totalhours = ((int)$timeOut - (int)$timeIn) - 1;
		
		//If the user's work reach the 6 hour minimum
		if($totalhours >= 6){
			//If the user work within the minimum and maximum = between 6 - 8 hours
			if($totalhours >= 6 && $totalhours < 8){
				$workhours = $totalhours;
				$reghours = $totalhours;
				$othours = 0;
				header("location:modifyDailyDTR2.php");
			}
			//If the user work for OT but not over OT = between 8 - 13 hours
			elseif($totalhours >= 8 && $totalhours < 13){
				$workhours = $totalhours;
				$othours = $workhours - 8;
				$reghours = 8;
				header("location:modifyDailyDTR2.php");
			}
			//If the user work for over OT = over 13 hours
			elseif($totalhours >= 13){
				header("location:modifyDailyDTR.php?error=2");
			}
			$regamt = $regrate * $reghours;
			$otamt = $otrate * $othours;
			$totalamt = $regamt + $otamt;
			$basicsalary = $regrate* 6;
		}
		//If user did not reach the 6 hour minimum
		else{
			header("location:modifyDailyDTR.php?error=1");
		}
		$_SESSION['getWorkHour'] = $workhours;
		$_SESSION['getOTHour'] = $othours;
		$_SESSION['getRegHour'] = $reghours;
		$_SESSION['getRegAmt'] = $regamt;
		$_SESSION['getOTAmt'] = $otamt;
		$_SESSION['getTotalAmt'] = $totalamt;
		$_SESSION['getBasicSalary'] = $basicsalary;
	}
?>