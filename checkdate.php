<?php
	session_start();
	require("connect.php");
	if (isset($_POST['go']) == 'Go') {
		//If user did not enter any date
		if(empty($_POST["date"])){
            header("location:modifyDTR.php?error=1");
        }
		else {
			//Getting the ID of the Logged In User/Employee
			$id = $_SESSION["getLogin"];
			$_SESSION['id'] = $id;

			//Get date input by the user
			$date_input = ($_POST["date"]);
			$chosen_date = date('Y-m-d', strtotime($date_input));
			
			//Will check if there is already existing week dtr created by the user
			$query = mysqli_query($DBConnect, "SELECT * FROM tbl_dtr WHERE id='$id' AND shiftDate='$chosen_date'");
			$fetch = mysqli_fetch_array($query);
			$count = mysqli_num_rows($query);
			
			//More than 0 means there are existing records already of the inputted date by the user, so it will continue to next page
			if($count > 0){
				//Continues if it's a work or rest day
				if($fetch['typeOfDay'] == "Work" || $fetch['typeOfDay'] == "Rest"){
					$_SESSION['getDate'] =  $date_input;
					header("location:modifyDailyDTR.php"); 
				}
				//Redirects back if no work day
				else{
					header("location:modifyDTR.php?error=2");
				}
			}
			else{
				header("location:modifyDTR.php?error=1");
			}
		}
	}
?>