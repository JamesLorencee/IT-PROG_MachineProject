<?php
	session_start();
	if(!isset($_SESSION["getLogin"])){
        header("location:login.php");
	}
	else{
?>
    <html>

    <head>
        <title>Modify Daily DTR</title>
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


        input[type="date"],
        input[type="time"],
        input[type="text"],
        input[type="number"],
        select {

            border-radius: 5px;
            text-decoration: none;
            padding: 5px;
            box-shadow: 2px 2px 10px grey;
            box-sizing: border-box;
            border: 1px solid black;
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

        /*Buttons*/
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

        /*Parameters*/
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

        .shift-container input {
            margin-right: 50px;
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

        /*Table*/
        .table {
            display: block;
            width: 100%;
        }

        table {
            table-layout: fixed;
            margin-top: 2%;
            margin-bottom: 2%;
            margin-left: auto;
            margin-right: auto;
            width: 100%;
            text-align: center;
            box-shadow: 2px 2px 10px grey;
        }

        th {
            background-color: #12456D;
            color: white;
        }

        td,
        th {
            padding: 10px;
        }

        tr:nth-child(even) {
            background-color: rgb(222, 222, 222);
        }

        tr:nth-child(odd) {
            background-color: azure;
        }

        table input[type="date"],
        table input[type="time"],
        table input[type="text"],
        table input[type="number"] {
            width: 100%;
        }
		
		p {
            color: red;
        }
    </style>

    <body>
        <div id='container'>
            <div id='sub-container'>
				<form method='post' action='checkhour.php'>
                <?php
					include("connect.php");
					/* Get your ID number of the current session */
					$id = $_SESSION["getLogin"];
					$_SESSION['id'] = $id;
					
					//Get the chosen date passed from checkdate.php
					$date = $_SESSION['getDate'];
					$chosen_date = date('Y-m-d', strtotime($date));
					
					$query = mysqli_query($DBConnect, "SELECT * FROM tbl_dtr WHERE id='$id' AND shiftDate='$chosen_date'");
					$fetch = mysqli_fetch_array($query);
					$timeIn = $fetch['timeIn'];
					
					//To get time for minimum of 6 hours for rest days
					$schedOut6 = date('H:i:s', strtotime($fetch['schedOut']) - 7200);
					$regrate = $fetch['REGratePerHr'];
					$otrate = $fetch['OTratePerHr'];
					$_SESSION['getREGrate'] = $regrate;
					$_SESSION['getOTrate'] = $otrate;
					
					if (mysqli_affected_rows($DBConnect)) { 
						$query = mysqli_query($DBConnect, "SELECT * FROM tbl_dtr WHERE id='$id' AND shiftDate='$chosen_date'");
						echo "<h2> Please enter your Time In and Time Out </h2><br><hr><br>
							  <h5>
								※For work days, please enter values and press submit.<br> 
								※For rest days, you do not need to enter any values and press submit. <br>
							  </h5>
								<div class='table'>
									<table>
										<tr>
											<th>Date</th>
												<th>Day</th>
												<th>Type of Day</th>
												<th>Scheduled In</th>
												<th>Scheduled Out</th>
												<th>Actual In</th>
												<th>Actual Out</th>
												<th>Work Hours</th>
										</tr>";
						while ($fetch = mysqli_fetch_array($query)){
							$day = date('l', strtotime($fetch['shiftDate']));
							echo "<tr>
									<td>".$fetch['shiftDate']."</td>
									<td>".$day."</td>
									<td>".$fetch['typeOfDay']."</td>
									<td>".date('H:i:s', strtotime($fetch['schedIn']))."</td>
									<td>".date('H:i:s', strtotime($fetch['schedOut']))."</td>";
									//If no work day. There should be no 'no work day' message already, but this is just in case
									if($fetch['typeOfDay'] == "No Work"){
										echo "<td><input type='time' value='timeIn' name='timeIn' readonly></td>";
										echo "<td><input type='time' value='timeOut' name='timeOut' readonly></td>";
									}
									//If rest day, cannot modify. Just show only
									elseif($fetch['typeOfDay'] == "Rest"){
										echo "<td><input type='time' value='".$fetch['schedIn']."' name='timeIn' readonly></td>
											  <td><input type='time' value='".$schedOut6."' name='timeOut' readonly></td>";
									}
									//If work day
									else{ ?>
										<td><select name='timeIn' id='timeIn'>
												<option value="07:00" <?php echo $timeIn=="07:00:00" ? "selected" : ""; ?> >07:00 AM</option>
												<option value="08:00" <?php echo $timeIn=="08:00:00" ? "selected" : ""; ?> >08:00 AM</option>
												<option value="09:00" <?php echo $timeIn=="09:00:00" ? "selected" : ""; ?> >09:00 AM</option>
											</select></td>
										<?php
										echo "<td><input type='time' value='".$fetch['timeOut']."' name='timeOut'></td>";
									}
									echo "<td> ".$fetch['workHrsPerDay']." </td>
								  </tr>";
						}
						echo "</table>
								</div>";
						}
					if(isset($_GET["error"])){
						$error = $_GET["error"];

						//this line will be called by the checkhour.php
						if ($error == 1) {
							echo "<p align='center'>You did not meet the requirement of 6 minimum working hours. Please enter again, thank you!<br/></p>";
						}
						if ($error == 2) {
							echo "<p align='center'>You cannot enter more than the OT hours (13). Please enter again, thank you!<br/></p>";
						}
						echo "<br/>";
					}
				?>
				<input type="submit" value="Submit" name="submit" class="btn" />
            </div>
            <a href='chat.php' class="chat-support"><i class='fa fa-commenting' style='font-size:25px'></i>Need help?</a>
        </div>
    </body>

    </html>
<?php } ?>