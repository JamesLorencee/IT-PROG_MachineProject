<html>
	<head>
		<title>Modify Daily DTR</title>
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
	</head>
	
	<style>
		* {
            margin: 0px;
            padding: 0px;
            box-sizing: content-box;
            font-family: "Raleway", sans-serif;
        }
		
		#container {
            max-width: 50%;
            box-shadow: 10px 20px 50px grey;
            border-radius: 10px;
            box-sizing: border-box;
            box-shadow: 12px;
            background-color: white;
            margin-top: 5%;
            margin-bottom: 5%;
            margin-left: auto;
            margin-right: auto;
            padding: 15px;
            display: block;
            overflow: hidden;
        }
		
		#sub-container {
            width: 100%;
            text-align: center;
            padding: 5px;
            box-sizing: border-box;
        }

        .btn {
            width: 60px;
            font-weight: bold;
            font-size: 12px;
            padding: 5px;
            border-radius: 5px;
            text-decoration: none;
            transition-duration: 0.4s;
            background-color: white;
            color: black;
            border: 1px solid #000000;
            box-shadow: 2px 2px 10px grey;
        }

        .btn:hover {
            background-color: #000000;
            color: white;
        }
	</style>

	<body>
		<?php
			include("connect.php");
			session_start();
			
			$id = $_SESSION["getLogin"];
			$_SESSION['id'] = $id;
			$shiftDate = $_SESSION["getDate"];
			
			$timein = $_SESSION["getTimeIn"];
			$timeout = $_SESSION["getTimeOut"];
			
			$workhours = $_SESSION["getWorkHour"];
			$othours = $_SESSION["getOTHour"];
			$reghours = $_SESSION["getRegHour"];
			
			$otamt = $_SESSION["getOTAmt"];
			$regamt = $_SESSION["getRegAmt"];
			$totalamt = $_SESSION["getTotalAmt"];
			$basicsalary = $_SESSION["getBasicSalary"];
			
			$query = "UPDATE tbl_dtr SET timeIn='$timein', timeOut='$timeout', workHrsPerDay='$workhours', REGHrsPerDay='$reghours', OTHrsPerDay='$othours', REGAmtPerDay='$regamt', OTAmtPerDay='$otamt', basicSalary='$basicsalary', totalAmtPerDay='$totalamt' WHERE id='$id' AND shiftDate='$shiftDate'";
		
			if(mysqli_query($DBConnect, $query)){
				echo "<body>
						<div id='container'>
							<div id='sub-container'>
								<h2> SUCCESSFUL MODIFY </h2><br>
								<a href='mainMenu.php' class='btn'>Back To Main Menu</a>
							</div>
						</div>
					</body>";
			}
			else{
				echo "<body>
						<div id='container'>
							<div id='sub-container'>
								<h2> UNSUCCESSFUL MODIFY </h2><br>
								<a href='mainMenu.php' class='btn'>Back To Main Menu</a>
							</div>
						</div>
					</body>";
			}
		?>
	</body>
</html>
