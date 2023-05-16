<?php
    session_start();
    if (!isset($_SESSION["getLogin"])) {
        header("location:login.php");
    }
    else {
?>

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

			$id = $_SESSION["getLogin"];

			$week = $_SESSION['getWeek'];
			$sdate = date('Y-m-d', strtotime($week));
			$edate = date('Y-m-d', strtotime($sdate . "+6 days"));

			$query = "DELETE FROM tbl_dtr WHERE id='$id' AND shiftDate BETWEEN '$sdate' AND '$edate'";

			if(mysqli_query($DBConnect, $query)){
				echo "<body>
						<div id='container'>
							<div id='sub-container'>
								<h2> SUCCESSFUL DELETION </h2><br>
								<a href='mainMenu.php' class='btn'>Back To Main Menu</a>
							</div>
						</div>
					</body>";
			}
			else{
				echo "<body>
						<div id='container'>
							<div id='sub-container'>
								<h2> UNSUCCESSFUL DELETION </h2><br>
								<a href='mainMenu.php' class='btn'>Back To Main Menu</a>
							</div>
						</div>
					</body>";
			}
		?>
    </body>
</html>
<?php }?>