<html>
	<head>
		<title>Import Weekly DTR</title>
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
	</head>
	
	<style>
		* {
			font-family: "Raleway", sans-serif;
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
	
	<?php
		require("connect.php");
		session_start();
		
		$id = $_SESSION["getLogin"];
		
		if(isset($_POST['upload'])){
			$file_name = $_FILES['file']['name'];
			$exp = explode('.', $file_name);
			$name = end($exp);
			$entry = 0;
			
			//If file uploaded is an XML file
			if($name == "xml"){
				$xml = simplexml_load_file(''.$file_name) or die("Error: Cannot create object");
				foreach($xml->entry as $dtrImport){
					$xmlid = $dtrImport->id;
					$shiftDate = $dtrImport->shiftDate;
					$entry++;
				}
				
				//Check if there is an entry for the dates in the XML
				$firstDate = date('Y-m-d', strtotime($shiftDate . "-6 days"));
				$checkquery = mysqli_query($DBConnect, "SELECT * FROM tbl_dtr WHERE id='$id' AND shiftDate BETWEEN '$firstDate' AND '$shiftDate'");
				$count = mysqli_num_rows($checkquery);
				
				//If there are already entries in the database for the dates in the XML file
				if($count > 0){
					echo"<script>alert('There are already entries for the date provided')</script>";
					echo"<script>window.location='indexImport.php'</script>";
				}
				//If no, continue
				else{ 
					//If it's not 7 entries (Because import is only weekly)
					if($entry != 7){
						echo"<script>alert('You can only import by weekly. Please check your file again, thank you!')</script>";
						echo"<script>window.location='indexImport.php'</script>";
					}
					elseif($xmlid != $id){
						echo"<script>alert('ID of XML file does not match your ID. Please check your file again, thank you!')</script>";
						echo"<script>window.location='indexImport.php'</script>";
					}
					else{
					?>
					<br>
					<h2><center>Imported XML Data</center></h2>
					<table>
					<tr>
						<th>ID</th>
						<th>Shift Date</th>
						<th>Type of Day</th>
						<th>Sched In</th>
						<th>Sched Out</th>
						<th>Time In</th>
						<th>Time Out</th>
						<th>Position</th> 
						<th>REG Rate per hour</th>
						<th>OT Rate per hour</th>
						<th>Basic Salary</th>
						<th>Work Hours per day</th>
						<th>REG hours per day</th>
						<th>OT hours per day</th>
						<th>REG amount per day</th>
						<th>OT amount per day</th>
						<th>Total amount per day</th>
					</tr>
					<?php
						foreach($xml->entry as $dtrImport){
							$id = $dtrImport->id;
							$shiftDate = $dtrImport->shiftDate;
							$daytype = $dtrImport->typeOfDay;
							$schedIn = $dtrImport->schedIn;
							$schedOut = $dtrImport->schedOut;
							$timeIn = $dtrImport->timeIn;
							$timeOut = $dtrImport->timeOut;
							$position = $dtrImport->position;
							$regRate = $dtrImport->REGratePerHr;
							$otRate = $dtrImport->OTratePerHr;
							$basicSalary = $dtrImport->basicSalary;
							$workHrsPerDay = $dtrImport->workHrsPerDay;
							$REGHrsPerDay = $dtrImport->REGHrsPerDay;
							$REGAmtPerDay = $dtrImport->REGAmtPerDay;
							$OTHrsPerDay = $dtrImport->OTHrsPerDay;
							$OTAmtPerDay = $dtrImport->OTAmtPerDay;
							$totalAmtPerDay = $dtrImport->totalAmtPerDay;
							
							$sql = "INSERT INTO tbl_dtr(id,shiftDate,typeOfDay,schedIn,schedOut,timeIn,timeOut,position,REGratePerHr,OTratePerHr,
							basicSalary,workHrsPerDay,REGHrsPerDay,REGAmtPerDay,OTHrsPerDay,OTAmtPerDay,totalAmtPerDay) VALUES ('$id','$shiftDate',
							'$daytype','$schedIn','$schedOut','$timeIn','$timeOut','$position','$regRate','$otRate','$basicSalary',
							'$workHrsPerDay','$REGHrsPerDay','$REGAmtPerDay','$OTHrsPerDay','$OTAmtPerDay','$totalAmtPerDay')";
							$result = mysqli_query($DBConnect, $sql);
							echo "<tr>
									<td>".$id."</td>
									<td>".$shiftDate."</td>
									<td>".$daytype."</td>
									<td>".$schedIn."</td>
									<td>".$schedOut."</td>
									<td>".$timeIn."</td>
									<td>".$timeOut."</td>
									<td>".$position."</td>
									<td>".$regRate."</td>
									<td>".$otRate."</td>
									<td>".$basicSalary."</td>
									<td>".$workHrsPerDay."</td>
									<td>".$REGHrsPerDay."</td>
									<td>".$REGAmtPerDay."</td>
									<td>".$OTHrsPerDay."</td>
									<td>".$OTAmtPerDay."</td>
									<td>".$totalAmtPerDay."</td>
								</tr>";
						}
					}
					?>
					</table>
					<?php
					echo "<a href='mainMenu.php' class='btn'>Back To Main Menu</a>";
				}
			}
			//If file uploaded is not an XML file
			else{
				echo"<script>alert('This is not an XML file. Please upload a valid file, thank you!')</script>";
				echo"<script>window.location='indexImport.php'</script>";
			}
		}
	?>
</html>