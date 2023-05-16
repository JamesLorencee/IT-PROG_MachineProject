<?php
	session_start();
	if (!isset($_SESSION["getLogin"])) {
		header("location:login.php");
	}
	else {
?>
	<html>

	<head>
		<title>Create DTR</title>
	</head>

	<style>
		@import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&family=Roboto:wght@100&display=swap');
		@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');

		* {
			margin: 0px;
			padding: 0px;
			box-sizing: content-box;
			font-family: "Open Sans", sans-serif;
		}

		#container {
			max-width: 80%;
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


		/*Chat Support Icon Link*/
		.chat-support i {
			padding-right: 10px;
		}

		.chat-support {
			text-decoration: none;
			color: black;
			float: left;
		}

		.chat-support:hover {
			color: blue;
		}

		/*Fields*/
		input[type="date"],
		input[type="time"],
		select {
			border-radius: 5px;
			text-decoration: none;
			padding: 5px;
			box-shadow: 2px 2px 5px grey;
			box-sizing: border-box;
			border: 1px solid black;
		}

		.btn {
			width: 60px;
			font-weight: bold;
			font-size: 13px;
			padding: 5px;
			border-radius: 5px;
			text-decoration: none;
			transition-duration: 0.4s;
			background-color: white;
			color: black;
			border: 1px solid #000000;
			box-shadow: 2px 2px 10px grey;
			margin-left: auto;
			margin-right: auto;
		}

		.btn:hover {
			background-color: #000000;
			color: white;
		}

		.field-container {
			display: inline-block;
			padding: 0% 5% 0% 5%;
			box-sizing: border-box;
			margin-left: auto;
			margin-right: auto;
			width: 58.5%;
			font-size: 12px;
		}

		.date-container,
		.shift-container {
			display: inline;
			width: 100%;
			border-radius: 5px;
			border: 1px solid black;
			box-sizing: border-box;
			padding: 10px 10px 15px 10px;
			text-align: left;
		}

		.rday-container {
			display: inline;
			width: 100%;
			border-radius: 5px;
			border: 1px solid black;
			box-sizing: border-box;
			padding: 10px 10px 15px 10px;
			text-align: left;
		}

		.date-container input {
			margin-right: 5%;
		}

		.date-container label,
		.shift-container label {
			margin-right: 10px;
		}

		.shift-container select {
			margin-right: 60px;
		}

		.inline-container {
			display: inline-flex;
			width: 100%;
			height: 11%;
			border-radius: 5px;
			border: 1px solid black;
			box-sizing: border-box;
			box-shadow: 2px 2px 10px grey;
			padding: 10px;
		}

		.inline-container h3 {
			width: 100px;
			text-align: left;
		}
	</style>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

	<script type="text/javascript">
		$(document).ready(function() {
			$('#sshift').on('change', (function() {
				if ($('#sshift').children("option:selected").val() == '07:00') {
					$('#eshift').val('16:00');
				}
				if ($('#sshift').children("option:selected").val() == '08:00') {
					$('#eshift').val('17:00');
				}
				if ($('#sshift').children("option:selected").val() == '09:00') {
					$('#eshift').val('18:00');
				}
			}))
		})

		function confirmation() {
			alert("Confirmation Modification of Record?")
		}
	</script>

	<body>
		<div id="container">
			<div id="sub-container">
				<h2> Daily Time Report </h2>
				<br>
				<hr>
				<br>
				<h3> Set DTR Parameters </h3>
				<br>
				<div class="field-container">
					<form action="dtr3_process.php" method="post">
						<br>
						<div class="inline-container">
							<h3> Period: </h3>
							<div class="date-container">
								<?php
								$week = $_SESSION['getWeek'];
								$sdate = date('Y-m-d', strtotime($week));
								$edate = date('Y-m-d', strtotime($sdate . "+6 days"));
								echo "
							<label> Start Date:</label>
							<input type='date' name='sdate' value='$sdate' size='9' readonly/>
							<label> End Date:</label>
							<input type='date' name='edate' value='$edate' size='9' readonly/>
							";
								?>
							</div>
						</div>
						<br>
						<br>
						<div class="inline-container">
							<h3> Shift: </h3>
							<div class="shift-container">
								<label> Start Shift: </label>
								<select name="sshift" id="sshift" required>
									<option value="07:00">07:00 AM</option>
									<option value="08:00">08:00 AM</option>
									<option value="09:00">09:00 AM</option>
								</select>
								<label> End Shift: </label>
								<input type="time" name="eshift" id="eshift" size="9" value="16:00" required readonly />
							</div>
						</div>
						<br>
						<br>
						<div class="inline-container">
							<h3> Rest Day: </h3>
							<div class="rday-container" required>
								<select name="rday">
									<option value="Monday">Monday</option>
									<option value="Tuesday">Tuesday</option>
									<option value="Wednesday">Wednesday</option>
									<option value="Thursday">Thursday</option>
									<option value="Friday">Friday</option>
									<option value="Saturday">Saturday</option>
								</select>
							</div>
						</div>
						<br>
						<br>
						<a href="dtr.php" class="btn">Back</a>
						<input type="submit" onclick='confirmation()' name="submit" value="Submit" class="btn" />
					</form>
					<br>
				</div>
			</div>

			<br>
			<a href="chat.php" class="chat-support"><i class="fa fa-commenting" style="font-size:25px"></i>Need help?</a>
		</div>


	</body>

	</html>
<?php }?>