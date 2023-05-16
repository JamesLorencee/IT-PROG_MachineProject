<?php
	session_start();
	if(!isset($_SESSION["getLogin"])){
        header("location:login.php");
	}
	else{
?>
    <html>

    <head>
        <title>View monthly DTR</title>
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
    </style>

    <body>
        <div id='container'>
            <div id='sub-container'>
				<form method='post' action='mainMenu.php'>
                <?php
					include("connect.php");
					/* Get your ID number of the current session */
					$id = $_SESSION["getLogin"];
					$_SESSION['id'] = $id;
					
					//Gets month and year
					$monthyear_input = $_SESSION['getMonthYear'];
					$chosen_month = date('M', strtotime($monthyear_input));
					$chosen_year = date('Y', strtotime($monthyear_input));
					
					//Gets first date and last date
					$sdate = date('Y-m-01', strtotime($monthyear_input));
					$edate = date('Y-m-t', strtotime($monthyear_input));
				
					$query = mysqli_query($DBConnect, "SELECT * FROM tbl_dtr WHERE id='$id' AND shiftDate BETWEEN '$sdate' AND '$edate'");
		
					if(mysqli_affected_rows($DBConnect)){
						echo "<h2> View all DTR for the month of ".$chosen_month." ".$chosen_year."</h2>
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
						while ($fetch = mysqli_fetch_array($query)) {
							$day = date('l', strtotime($fetch['shiftDate']));
							echo "<tr>
									<td> " . $fetch['shiftDate'] . " </td>
									<td> " . $day . " </td>
									<td> " . $fetch['typeOfDay'] . " </td>
									<td> " . date('H:i:s', strtotime($fetch['schedIn'])) . " </td>
									<td> " . date('H:i:s', strtotime($fetch['schedOut'])) . " </td>
									<td> " . $fetch['timeIn'] . " </td>
									<td> " . $fetch['timeOut'] . " </td>
									<td> " . $fetch['workHrsPerDay'] . " </td>
								  </tr>";
						}
						echo "</table>
								</div>";
					} 
                ?>
				<a href="mainMenu.php" class="btn">Back To Main Menu</a>
			</div>
            <a href='chat.php' class="chat-support"><i class='fa fa-commenting' style='font-size:25px'></i>Need help?</a>
        </div>
    </body>
</html>
<?php } ?>