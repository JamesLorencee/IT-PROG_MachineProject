<html>

<head>
    <title>Register Component</title>
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
		$id = $_POST["id"];
		$name = $_POST["cname"];
		$status = $_POST["status"];
		$gender = $_POST["gender"];
		$hdate = $_POST["hdate"];
		$uname = $_POST["username"];
		$pass = substr(md5($_POST["pass"]), 0, 32);
		$today = date("Y-m-d");

		$insert = mysqli_query($DBConnect, "INSERT INTO tbl_employees (id, completename, status, gender,	hiredate, position, username,	password)
			VALUES('$id', '$name', '$status', '$gender', '$hdate', NULL, '$uname', '$pass')");

		//Update the employees' status and effective date (when was it updated)
		$updateStatus = mysqli_query($DBConnect, "INSERT tbl_emp_status SET id = '$id', status = '$status', effectiveDate = '$today'");
		
		if (mysqli_affected_rows($DBConnect)) {
			echo "<body>
						<div id='container'>
							<div id='sub-container'>
								<h2> RECORD HAS BEEN SUCCESSFULLY ADDED </h2><br>
								Affected rows:" . mysqli_affected_rows($DBConnect) . "<br /><br />";
								$query2 = mysqli_query($DBConnect, "SELECT * FROM tbl_employees WHERE id='$id'");
								$fetch2 = mysqli_fetch_array($query2);
								echo "	ID: " . $fetch2["id"] . "<br />
										Complete Name: " . $fetch2["completename"] . "<br />
										Status: " . $fetch2["status"] . "<br />
										Gender: " . $fetch2["gender"] . "<br />
										Username: " . $fetch2["username"] . "<br />
										Password: " . $fetch2["password"] . "<br><br>
								<a href='mainMenu.php' class='btn'>Back To Main Menu</a>
							</div>
						</div>
					</body>";
		}
    ?>

</html>