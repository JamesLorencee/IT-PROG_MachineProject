<html>
	<head>
		<title>Update Employee Information</title>
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
			$id = $_SESSION['id'];
			$cname = $_POST["cname"];
			$status = $_POST["status"];
			$gender = $_POST["gender"];
			$hdate = $_POST["hdate"];
			$pos = $_POST["position"];
			$uname = $_POST["username"];
			$pass = substr(md5($_POST["password"]), 0, 32);
			$today = date("Y-m-d");
			
			$photoquery = mysqli_query($DBConnect, "SELECT * FROM tbl_employees WHERE id='$id'");
			$fetch = mysqli_fetch_array($photoquery);
			
			//If user did not upload a photo
			if($_FILES['photo']['name'] == ""){
				$fileName = $fetch['emp_img'];
			}
			//If user upload a photo
			else{
				$fileName = $_FILES['photo']['name'];
				$fileTmpName  = $_FILES['photo']['tmp_name'];
				//Remember to have an "uploads" folder in the directory for the photos to be saved to your computer 
				$uploadDirectory = "uploads/".$fileName;
				move_uploaded_file($fileTmpName, $uploadDirectory);
			}
			
			//If user did not input password, password will not be updated. Else, update.
			//This is done because of MD5 
			if(empty($_POST['password'])){
				$query = "UPDATE tbl_employees SET completename='$cname', emp_img='$fileName', status='$status', gender='$gender', hiredate='$hdate', position='$pos', username='$uname' WHERE id=$id";
			}
			else{
				$query = "UPDATE tbl_employees SET completename='$cname', emp_img='$fileName', status='$status', gender='$gender', hiredate='$hdate', position='$pos', username='$uname', password='$pass' WHERE id=$id";
			}
			
			//Update the employees' position and effective date (when was it updated)
			$updatePos = mysqli_query($DBConnect, "INSERT tbl_emp_position SET id = '$id', position = '$pos', effectiveDate = '$today'");
			
			//Update the employees' status and effective date (when was it updated)
			$updateStatus = mysqli_query($DBConnect, "INSERT tbl_emp_status SET id = '$id', status = '$status', effectiveDate = '$today'");
			
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
