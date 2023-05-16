<?php
    session_start();
	if(!isset($_SESSION["getLogin"])){
        header("location:login.php");
	}
	else{
?>
    <html>
        <head>
            <title>Delete Daily DTR</title>
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
	<?php
        include("connect.php");

        $id = $_SESSION["getLogin"];
                    
        $day_input = $_SESSION['getDay'];

        $timeIn = "";
        $timeOut = "";
        $basicSalary = 0;
        $workHrsPerDay = 0;
        $REGHrsPerDay = 0;
        $REGAmtPerDay = 0;
        $OTHrsPerDay = 0;
        $OTAmtPerDay = 0;
        $totalAmtPerDay = 0;

        $query = "UPDATE tbl_dtr SET timeIn = '$timeIn', timeOut = '$timeOut', basicSalary='$basicSalary', workHrsPerDay='$workHrsPerDay',REGHrsPerDay='$REGHrsPerDay', REGAmtPerDay='$REGAmtPerDay', OTHrsPerDay='$OTHrsPerDay', OTAmtPerDay='$totalAmtPerDay', totalAmtPerDay='$totalAmtPerDay'
                                            WHERE id='$id' AND shiftDate='$day_input'";

        if (mysqli_query($DBConnect, $query)) { 
            echo "<h2>Successful Deletion</h2>";
            $query1 = mysqli_query($DBConnect, "SELECT * FROM tbl_dtr WHERE id='$id' AND shiftDate='$day_input'");
			$fetch = mysqli_fetch_array($query1);
            if (mysqli_affected_rows($DBConnect)) { 
                echo "<div class='table'>
                            <table>
                                <tr>
                                    <th>Date</th>
                                    <th>Type of Day</th>
                                    <th>Scheduled In</th>
                                    <th>Scheduled Out</th>
                                    <th>Actual In</th>
                                    <th>Actual Out</th>
                                    <th>Work Hours</th>
                                </tr>";
                            echo "<tr>
									<td> ".$day_input." </td>
									<td> ".$fetch['typeOfDay']." </td>
									<td> ".$fetch['schedIn']." </td>
									<td> ".$fetch['schedOut']." </td>
                                    <td> ".$fetch['timeIn']." </td>
                                    <td> ".$fetch['timeOut']." </td>
									<td> ".$fetch['workHrsPerDay']."</td>
								</tr>";
                            }
                            echo "</table>
			    </div>";
        }
        else{
            echo "Deletion Failed";
        }
	?>
            </div>
    <form method="post" action="mainMenu.php">
        <input type="submit" value="Back to Main Menu" class="btn" style="width:120px; display: grid; justify-content: center; align-content: center;"/>
    </form>
            </div>
    </body>
</html>
<?php } ?>