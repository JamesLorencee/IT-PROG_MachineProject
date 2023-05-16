<?php
    session_start();
    require("connect.php");
    if (isset($_POST['go']) == 'Go') {
		if (empty($_POST["week"])) {
			header("location:deleteWeekly.php?error=2");
		} 
		else {
			$id = $_SESSION["getLogin"];
			
			$week_input = ($_POST["week"]);
			$sdate = date('Y-m-d', strtotime($week_input));
			$edate = date('Y-m-d', strtotime($sdate . "+6 days"));
			
			$weekquery = mysqli_query($DBConnect, "SELECT * FROM tbl_dtr WHERE id='$id' AND shiftDate BETWEEN '$sdate' AND '$edate'");
			$count = mysqli_num_rows($weekquery);

			//If chosen week have entries
			if ($count > 0) {
				$_SESSION['getWeek'] =  $week_input;
				header("location:deleteWeekly3.php");
			} 
			else{
				header("location:deleteWeekly.php?error=1");				
			}
		}
    }
?>
