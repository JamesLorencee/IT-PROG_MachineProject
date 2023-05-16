<?php
	session_start();
	if (!isset($_SESSION["getLogin"])) {
			header("location:login.php");
	}
	else{
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
				<form method='post' action=''>
                <?php
                include("connect.php");
                if (isset($_POST['submit']) == 'Submit') {
                    /*database*/
                    $id = $_SESSION["getLogin"];

                    $empquery = mysqli_query($DBConnect, "SELECT * FROM tbl_employees WHERE id='$id'");
                    $empfetch = mysqli_fetch_array($empquery);
					
                    $sdate = $_POST['sdate'];
                    $edate = $_POST['edate'];
                    $sshift = date('H:i:s', strtotime($_POST['sshift']));
                    $eshift =  date('H:i:s', strtotime($_POST['eshift']));
                    $rday = $_POST['rday'];

                    $position = (string)$empfetch['position']; //change sql query table to tbl_emp_position once we can update the employees info.
                    
                    $ratequery = mysqli_query($DBConnect, "SELECT * FROM tbl_position WHERE position='$position'");
                    $ratefetch = mysqli_fetch_array($ratequery);

                    $regRate = (float)$ratefetch['REGratePerHr']; //Getting from tbl_position
                    $otRate =  (float)$ratefetch['OTratePerHr']; //Getting from tbl_position

                    //Getting the range of dates between sdate and edate
                    for ($i = 0; $i <= 6; $i++) {
                        $tempdate = $sdate;
                        $new_tempdate = date('Y-m-d', strtotime("+" . (int)$i . " days", strtotime($tempdate)));

                        //Work, No Work, or Rest Days
                        if (date('l', strtotime($new_tempdate)) == $rday) {
                            $daytype = 'Rest';
                        } else if (date('l', strtotime($new_tempdate)) == 'Sunday') {
                            $daytype = 'No Work';
                        } else {
                            $daytype = 'Work';
                        }

                        $insert = mysqli_query($DBConnect, "INSERT INTO tbl_dtr (id, shiftDate, typeOfDay, schedIn, schedOut, timeIn, timeOut,position,	REGratePerHr,OTratePerHr,workHrsPerDay,REGHrsPerDay,REGAmtPerDay,OTHrsPerDay,OTAmtPerDay)
                        VALUES('$id', '$new_tempdate', '$daytype', '$sshift', '$eshift','','','$position','$regRate', '$otRate','0','','','','')");
                    }

                    if (mysqli_affected_rows($DBConnect)) {
                        echo "<h3> Weekly DTR has been successfully created.</h3><br>";
                        $query = mysqli_query($DBConnect, "SELECT * FROM tbl_dtr WHERE id='$id' AND shiftDate BETWEEN '$sdate' AND '$edate'");

                        //Selected Parameters   
                        echo "
        <h3> Selected DTR Parameters </h3><br>
        <div class='field-container'>
                <div class='inline-container'>
                    <h3> Period: </h3>
                    <div class='date-container'>
                            <label> Start Date:</label>
                            <input type='date' name='sdate' value='$sdate'  size='9' readonly/>

                            <label> End Date:</label>
                            <input type='date' name='edate' value='$edate'  size='9' readonly/>
                    </div>
                </div>
                <br>
                <br>
                <div class='inline-container'>
                    <h3> Shift: </h3>
                    <div class='shift-container'>
                        <label> Start Shift: </label>
                        <input type='text' name='eshift' size='9' value='$sshift' readonly />
                        <label> End Shift: </label>
                        <input type='text' name='eshift' size='9' value='$eshift' readonly />
                    </div>
                </div>
                <br>
                <br>
                <div class='inline-container'>
                    <h3> Rest Day: </h3>
                    <div class='rday-container'>
                        <input type='text' name='rday' size='9' value='$rday' readonly />
                    </div>
                </div>
                <br>
                <br>
                <br>
        </div>
        ";

                        //DTR Generated rows from DB but only selected columns will be visible
                        echo "
        <h3> DTR Table </h3>
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
                            </tr>

        ";
                        while ($fetch = mysqli_fetch_array($query)) {
                            $day = date('l', strtotime($fetch['shiftDate']));
                            echo "
            <tr>
                <td> " . $fetch['shiftDate'] . " </td>
                <td> " . $day . " </td>
                <td> " . $fetch['typeOfDay'] . " </td>
                <td> " . date('H:i:s', strtotime($fetch['schedIn'])) . " </td>
                <td> " . date('H:i:s', strtotime($fetch['schedOut'])) . " </td>
                <td> " . date('H:i:s', strtotime($fetch['timeIn'])) . " </td>
                <td> " . $fetch['timeOut'] . " </td>
                <td> " . $fetch['workHrsPerDay'] . "</td>
            </tr>
            ";
                        }
                        echo "</table>
        </div>";
                    }
                }
                $weeknum = date("W", strtotime($sdate));

                echo "
<p>The Week $weeknum DTR of $sdate and $edate has been created. It is ready for viewing and update.</p><br>";
                ?>

                <a href="mainMenu.php" class="btn">Back To Main Menu</a>
				
            </div>
            <a href='chat.php' class="chat-support"><i class='fa fa-commenting' style='font-size:25px'></i>Need help?</a>
        </div>
    </body>

    </html>
<?php } ?>