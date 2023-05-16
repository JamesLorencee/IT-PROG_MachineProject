<?php
    session_start();
    require("connect.php");
    if (isset($_POST['go']) == 'Go') {
		if(empty($_POST["date"])) {
			header("location:deleteDaily.php?error=2");
		} 
		else {
			$id = $_SESSION["getLogin"];
			
			$day_input = ($_POST["date"]);
			$dayquery = mysqli_query($DBConnect, "SELECT * FROM tbl_dtr WHERE id='$id' AND shiftDate='$day_input'");
			$count = mysqli_num_rows($dayquery);
				
			//If there is not a single entry
			if ($count != 1) {
				header("location:deleteDaily.php?error=1");
			} 
			else {
				$_SESSION['getDay'] =  $day_input;
				header("location:deleteDaily2.php");
			}
		}
    }
?>
