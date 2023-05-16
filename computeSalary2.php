<?php
	session_start();
	if(!isset($_SESSION["getLogin"])){
        header("location:login.php");
	}
	else{
?>
    <html>

    <head>
        <title>Compute Salary</title>
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
    </style>

    <body>
        <div id='container'>
            <div id='sub-container'>
				<form method='post' action=''>
                <?php
					include("connect.php");
					/* Get your ID number of the current session */
					$id = $_SESSION["getLogin"];
					$_SESSION['id'] = $id;
					
					//Get month and year input from user
					$monthyear_input = $_SESSION['getMonthYear'];
					$chosen_month = date('M', strtotime($monthyear_input));
					$chosen_year = date('Y', strtotime($monthyear_input));
					
					//Get first day, 15th day, 16th day, and last day
					$sdate15 = date('Y-m-01', strtotime($monthyear_input));
					$edate15 = date('Y-m-15', strtotime($monthyear_input));
					$sdate30 = date('Y-m-16', strtotime($monthyear_input));
					$edate30 = date('Y-m-t', strtotime($monthyear_input));
					
					//Get regular hour earnings
					$sumreg15 = mysqli_query($DBConnect, "SELECT sum(REGAmtPerDay) FROM tbl_dtr WHERE id='$id' AND shiftDate BETWEEN '$sdate15' AND '$edate15'");
					$fetchreg15 = mysqli_fetch_array($sumreg15);
					$sumreg30 = mysqli_query($DBConnect, "SELECT sum(REGAmtPerDay) FROM tbl_dtr WHERE id='$id' AND shiftDate BETWEEN '$sdate30' AND '$edate30'");
					$fetchreg30 = mysqli_fetch_array($sumreg30);
					
					//Get overtime hours earnings
					$sumot15 = mysqli_query($DBConnect, "SELECT sum(OTAmtPerDay) FROM tbl_dtr WHERE id='$id' AND shiftDate BETWEEN '$sdate15' AND '$edate15'");
					$fetchot15 = mysqli_fetch_array($sumot15);
					$sumot30 = mysqli_query($DBConnect, "SELECT sum(OTAmtPerDay) FROM tbl_dtr WHERE id='$id' AND shiftDate BETWEEN '$sdate30' AND '$edate30'");
					$fetchot30 = mysqli_fetch_array($sumot30);
				
					//Get basic salary for Day1-15 and Day16-30; computation for Philhealth
					$sumbasicsalary = mysqli_query($DBConnect, "SELECT sum(basicSalary) FROM tbl_dtr WHERE id='$id' AND shiftDate BETWEEN '$sdate15' AND '$edate30'");
					$fetchbasicsalary = mysqli_fetch_array($sumbasicsalary);
					
					//Get total salary for Day1-15 and Day16-30, this has no deductions yet
					$sumtotalsalary15 = mysqli_query($DBConnect, "SELECT sum(totalAmtPerDay) FROM tbl_dtr WHERE id='$id' AND shiftDate BETWEEN '$sdate15' AND '$edate15'");
					$fetchtotalsalary15 = mysqli_fetch_array($sumtotalsalary15);
					$sumtotalsalary30 = mysqli_query($DBConnect, "SELECT sum(totalAmtPerDay) FROM tbl_dtr WHERE id='$id' AND shiftDate BETWEEN '$sdate30' AND '$edate30'");
					$fetchtotalsalary30 = mysqli_fetch_array($sumtotalsalary30);

					//SSS and PAGIBIG is set to 1125 and 100 respectively because minimum to maximum salary computes the same
					$sss = 1125;
					$pagibig = 100;
					
					if($fetchbasicsalary == 10000 || $fetchbasicsalary == 10000){
						$philhealth15 = 400/2;
						$philhealth30 = 400/2;
					}
					elseif($fetchbasicsalary > 10000 && $fetchbasicsalary < 80000){
						$philhealth15 = $fetchbasicsalary * 0.04;
						$philhealth30 = $fetchbasicsalary * 0.04;
					}
					elseif($fetchbasicsalary >= 80000){
						$philhealth15 = 3200/2;
						$philhealth30 = 3200/2;
					}
					
					//15 means computation for Day1-15; 30 is for Day16-30
					$totalearnings15 = $fetchtotalsalary15[0] - $sss/2 - $pagibig/2 - $philhealth15;
					$totalearnings30 = $fetchtotalsalary30[0] - $sss/2 - $pagibig/2 - $philhealth30;
					
					//Income tax for Day 1-15
					if($fetchtotalsalary15[0] > 16667 && $fetchtotalsalary15[0] < 33332){
						$incometax15 = ($fetchtotalsalary15[0] - 16667) * 0.25 + 1250;
					}
					elseif($fetchtotalsalary15[0] > 33333 && $fetchtotalsalary15[0] < 83332){
						$incometax15 = ($fetchtotalsalary15[0] - 33333) * 0.3 + 5416.67;
					}
					elseif($fetchtotalsalary15[0] > 83333 && $fetchtotalsalary15[0] < 333332){
						$incometax15 = ($fetchtotalsalary15[0] - 83333) * 0.32 + 20416.67;
					}
					elseif($fetchtotalsalary15[0] > 333333){
						$incometax15 = ($fetchtotalsalary15[0] - 333333) * 0.35 + 100416.67;
					}
					
					//Income tax for Day 16-30
					if($fetchtotalsalary30[0] > 16667 && $fetchtotalsalary30[0] < 33332){
						$incometax30 = ($fetchtotalsalary30[0] - 16667) * 0.25 + 1250;
					}
					elseif($fetchtotalsalary30[0] > 33333 && $fetchtotalsalary30[0] < 83332){
						$incometax30 = ($fetchtotalsalary30[0] - 33333) * 0.3 + 5416.67;
					}
					elseif($fetchtotalsalary30[0] > 83333 && $fetchtotalsalary30[0] < 333332){
						$incometax30 = ($fetchtotalsalary30[0] - 83333) * 0.32 + 20416.67;
					}
					elseif($fetchtotalsalary30[0] > 333333){
						$incometax30 = ($fetchtotalsalary30[0] - 333333) * 0.35 + 100416.67;
					}
					
					$totaldeductions15 = $sss/2 + $pagibig/2 + $philhealth15 + $incometax15;
					$totaldeductions30 = $sss/2 + $pagibig/2 + $philhealth30 + $incometax30;
					
					//Final salary
					$netpay15 = $totalearnings15 - $incometax15;
					$netpay30 = $totalearnings30 - $incometax30;
					
					if (mysqli_affected_rows($DBConnect)) { 
						echo "<h2> Here is the breakdown of your salary for the month of ".$chosen_month." ".$chosen_year."</h2>
								<div class='table'>
									<table>
										<tr>
											<th></th>
											<th>Day 1-15</th>
											<th>Day 16-30</th>
										</tr>
										<tr>
											<td style='color: green;'>Regular Earnings</td>
											<td style='color: green;'>".number_format($fetchreg15[0])."</td>
											<td style='color: green;'>".number_format($fetchreg30[0])."</td>
										</tr>
										<tr>
											<td style='color: green;'>Overtime Earnings</td>
											<td style='color: green;'>".number_format($fetchot15[0])."</td>
											<td style='color: green;'>".number_format($fetchot30[0])."</td>
										</tr>
										<tr>
											<td style='color: green;'><b>Gross Income</b></td>
											<td style='color: green;'><b>".number_format($fetchtotalsalary15[0])."</b></td>
											<td style='color: green;'><b>".number_format($fetchtotalsalary30[0])."</b></td>
										</tr>
										<tr>
											<td style='color: red;'>SSS</td>
											<td style='color: red;'>".number_format($sss/2, 2)."</td>
											<td style='color: red;'>".number_format($sss/2, 2)."</td>
										</tr>
										<tr>
											<td style='color: red;'>PhilHealth</td>
											<td style='color: red;'>".number_format($philhealth15, 2)."</td>
											<td style='color: red;'>".number_format($philhealth30, 2)."</td>
										</tr>
										<tr>
											<td style='color: red;'>PAGIBIG</td>
											<td style='color: red;'>".number_format($pagibig/2)."</td>
											<td style='color: red;'>".number_format($pagibig/2)."</td>
										</tr>
										<tr>
											<td style='color: red;'>Income Tax</td>
											<td style='color: red;'>".number_format($incometax15, 2)."</td>
											<td style='color: red;'>".number_format($incometax30, 2)."</td>
										</tr>
										<tr>
											<td style='color: red;'><b>Total Deductions</b></td>
											<td style='color: red;'><b>".number_format($totaldeductions15, 2)."</b></td>
											<td style='color: red;'><b>".number_format($totaldeductions30, 2)."</b></td>
										</tr>
										<tr>
											<td style='color: green;'><b>Net Pay</b></td>
											<td style='color: green;'><b>".number_format($netpay15, 2)."</b></td>
											<td style='color: green;'><b>".number_format($netpay30, 2)."</b></td>
										</tr>
									</table>
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