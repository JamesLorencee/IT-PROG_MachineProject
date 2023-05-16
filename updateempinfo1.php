<html>
	<head>
		<title>Update Employee Information</title>
	</head>

	<style>
		@import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&family=Roboto:wght@100&display=swap');

		* {
			margin: 0px;
			padding: 0px;
			box-sizing: content-box;
			font-family: "Open Sans", sans-serif;
		}

		#container {
			max-width: 30%;
			box-shadow: 10px 20px 50px grey;
			border-radius: 10px;
			box-sizing: border-box;
			box-shadow: 12px;
			background-color: white;
			margin-top: 2%;
			margin-bottom: 2%;
			margin-left: auto;
			margin-right: auto;
			padding: 10px;
			display: block;
			overflow: hidden;
		}

		#sub-container {
			width: 100%;
			text-align: center;
			padding: 5px;
			box-sizing: border-box;
		}

		.fields {
			padding: 5px;
			margin-left: auto;
			margin-right: auto;
			width: 65%;
			box-sizing: border-box;
			display: block;
			text-align: left;
		}

		input[type="text"],
		input[type="password"],
		input[type="date"] {
			margin-top: 10px;
			width: 100%;
			border-radius: 5px;
			text-decoration: none;
			padding: 5px;
			box-shadow: 2px 2px 10px grey;
			box-sizing: border-box;
			border: 1px solid black;
		}

		.btn {
			margin: 5px;
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
		}

		.btn:hover {
			background-color: #000000;
			color: white;
		}

		span {
			display: block;
		}

		label {
			font-weight: bold;
		}

		.radio-container {
			display: flex;
			justify-content: center;
			border-radius: 5px;
			border: 1px solid black;
			box-sizing: border-box;
			font-size: 13px;
			padding: 5px;
			margin-top: 10px;
			box-shadow: 2px 2px 10px grey;

		}

		input[type="radio"] {
			margin-top: 3px;
			margin-left: 10px;
			margin-right: 20px;
		}
	</style>

	<script type="text/javascript">
		function confirmation() {
			alert("Confirm Update of Information?")
		 }
	</script>

	<body>
		<?php
			session_start();
			if(!isset($_SESSION["getLogin"])) {
				header("location:login.php");
			}
			else{		
				include("connect.php");
				
				/* Get your ID number */
				$id = $_SESSION["getLogin"];
				$_SESSION['id'] = $id;
				
				$query = mysqli_query($DBConnect, "SELECT * FROM tbl_employees WHERE id='$id'");
				$fetch = mysqli_fetch_array($query);
				
				$status = $fetch["status"];
				$gender = $fetch["gender"];
				$pos = $fetch["position"];
		?>
		
		<div id="container">
			<div id="sub-container">
				<h2> UPDATE </h2>
				<br>
				<hr>
				<br>

				<form method='post' action='updateempinfo2.php' enctype='multipart/form-data'>
					<div class="fields">
						<label> Complete Name </label>
						<br>
						<?php echo "<span><input type='text' name='cname' value='".$fetch['completename']."' required /></span>" ?>
						<br>
						
						<label> Photo </label>
						<br>
						<?php echo "<span><input type='file' name='photo' value='' /></span>" ?>
						<br>
						
						<label> Status </label>
						<br>
						<div class="radio-container">
							<label> Regular </label>
							<input type="radio" name="status" <?php if($status=="Regular") { ?> <?php echo "checked='true'"; ?> <?php } ?> value="Regular" required />
							<label> Probation </label>
							<input type="radio" name="status" <?php if($status=="Probation") { ?> <?php echo "checked='true'"; ?> <?php } ?> value="Probation" required />
						</div>
						<br>
						
						<label> Gender </label>
						<div class="radio-container">
							<label> Male </label>
							<input type="radio" name="gender" <?php if($gender=="Male") { ?> <?php echo "checked='true'"; ?> <?php } ?>  value="Male" required />
							<label> Female </label>
							<input type="radio" name="gender" <?php if($gender=="Female") { ?> <?php echo "checked='true'"; ?> <?php } ?>  value="Female" required />
						</div>
						<br>
						
						<label> Hire Date </label>
						<br>
						<?php echo "<span><input type='date' name='hdate' value='".$fetch['hiredate']."' required /></span>" ?>
						<br>
						
						<label> Position </label>
						<div class="radio-container">
							<select name="position" id="position" required>		
								<option value="Manager" <?php echo $pos=="Manager" ? "selected" : ""; ?>>Manager</option>
								<option value="Programmer" <?php echo $pos=="Programmer" ? "selected" : ""; ?>>Programmer</option>
								<option value="Encoder" <?php echo $pos=="Encoder" ? "selected" : ""; ?>>Encoder</option>
								<option value="Secretary" <?php echo $pos=="Secretary" ? "selected" : ""; ?>>Secretary</option>
								<option value="Network Admin" <?php echo $pos=="Network Admin" ? "selected" : ""; ?>>Network Admin</option>
							</select>
						</div>
						<br>
						
						<label> Username </label>
						<br>
						<?php echo "<span><input type='text' name='username' value='".$fetch['username']."' required /></span>" ?>
						<br>
						
						<label> Password </label>
						<br>
						<?php echo "<span><input type='password' name='password' value='' placeholder='password' /></span>" ?>
						
					</div>
					<br>
					<a href="mainMenu.php" class="btn">Back to Main Menu</a>
					<input type="submit" value="Update" onclick='confirmation()' name="regBtn" class="btn" />
				</form>

			</div>

		</div>
		<?php } ?>
	</body>

</html>