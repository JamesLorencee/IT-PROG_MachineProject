<html>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
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
</html>

<?php
	//Exports every single data from the tbl_dtr of the chosen week
	session_start();
	require("connect.php");
	if (isset($_POST['go']) == 'Go') {
		if(empty($_POST["week"])){
			header("location:dtr.php?error=1");
		}
		else{
			//Getting the ID of the Logged In User/Employee
			$id = $_SESSION["getLogin"];
			$_SESSION['id'] = $id;

			//Get first date and last date of week that will be exported
			$export_week = ($_POST["week"]);
			$sdate = date('Y-m-d', strtotime($export_week));
			$edate = date('Y-m-d', strtotime($sdate . "+6 days"));
			
			//Will check if there is already existing week dtr created by the user
			$query = mysqli_query($DBConnect, "SELECT * FROM tbl_dtr WHERE id='$id' AND shiftDate BETWEEN '$sdate' AND '$edate'");
			$count = mysqli_num_rows($query);

			//If there are 7 entries, you can export. Else, tells user that there is no entries for it
			//7 entries because 1 week = 7 days
			if($count == 7){
				$query = "SELECT * FROM tbl_dtr WHERE id='$id' AND shiftDate BETWEEN '$sdate' AND '$edate'";
				$dtrarray = array();

				//Function to create XML document
				function createXMLfile($dtrarray){
					//Set filename for the XML document that will be created
					//Exported DTR will be called 'dtr.xml' saved in the same directory
					$filePath = 'dtr.xml';
					$xml = new DOMDocument('1.0', 'utf-8'); 
					
					//Root element is DTR
					$root = $xml->createElement('dtr'); 
					for($i=0; $i<count($dtrarray); $i++){
						//Fetch values to dtrarray (from tbl_dtr)
						$id = $dtrarray[$i]['id'];  
						$shiftDate = $dtrarray[$i]['shiftDate'];
						$typeOfDay = $dtrarray[$i]['typeOfDay']; 
						$schedIn = $dtrarray[$i]['schedIn']; 
						$schedOut = $dtrarray[$i]['schedOut']; 
						$timeIn = $dtrarray[$i]['timeIn'];  
						$timeOut = $dtrarray[$i]['timeOut']; 
						$position = $dtrarray[$i]['position']; 
						$REGratePerHr = $dtrarray[$i]['REGratePerHr']; 
						$OTratePerHr = $dtrarray[$i]['OTratePerHr']; 
						$basicSalary = $dtrarray[$i]['basicSalary']; 
						$workHrsPerDay = $dtrarray[$i]['workHrsPerDay']; 
						$REGHrsPerDay = $dtrarray[$i]['REGHrsPerDay']; 
						$REGAmtPerDay = $dtrarray[$i]['REGAmtPerDay']; 
						$OTHrsPerDay = $dtrarray[$i]['OTHrsPerDay']; 
						$OTAmtPerDay = $dtrarray[$i]['OTAmtPerDay']; 
						$totalAmtPerDay = $dtrarray[$i]['totalAmtPerDay']; 
						
						$rootElement = $xml->getElementsByTagName("dtr")->item(0);
					
						//Per entry of a DTR is called entry
						$entryTag = $xml->createElement("entry");
							$idTag = $xml->createElement('id', $id); 
							$shiftDateTag = $xml->createElement('shiftDate', $shiftDate); 
							$typeOfDayTag = $xml->createElement('typeOfDay', $typeOfDay); 
							$schedInTag = $xml->createElement('schedIn', $schedIn); 
							$schedOutTag = $xml->createElement('schedOut', $schedOut); 
							$timeInTag = $xml->createElement('timeIn', $timeIn); 
							$timeOutTag = $xml->createElement('timeOut', $timeOut); 
							$positionTag = $xml->createElement('position', $position); 
							$REGratePerHrTag = $xml->createElement('REGratePerHr', $REGratePerHr); 
							$OTratePerHrTag = $xml->createElement('OTratePerHr', $OTratePerHr); 
							$basicSalaryTag = $xml->createElement('basicSalary', $basicSalary);  
							$workHrsPerDayTag = $xml->createElement('workHrsPerDay', $workHrsPerDay); 
							$REGHrsPerDayTag = $xml->createElement('REGHrsPerDay', $REGHrsPerDay); 
							$REGAmtPerDayTag = $xml->createElement('REGAmtPerDay', $REGAmtPerDay); 
							$OTHrsPerDayTag = $xml->createElement('OTHrsPerDay', $OTHrsPerDay); 
							$OTAmtPerDayTag = $xml->createElement('OTAmtPerDay', $OTAmtPerDay); 
							$totalAmtPerDayTag = $xml->createElement('totalAmtPerDay', $totalAmtPerDay);
						
						$entryTag->appendChild($idTag); 
						$entryTag->appendChild($shiftDateTag);  
						$entryTag->appendChild($typeOfDayTag);
						$entryTag->appendChild($schedInTag); 
						$entryTag->appendChild($schedOutTag); 
						$entryTag->appendChild($timeInTag); 
						$entryTag->appendChild($timeOutTag); 
						$entryTag->appendChild($positionTag); 
						$entryTag->appendChild($REGratePerHrTag); 
						$entryTag->appendChild($OTratePerHrTag); 
						$entryTag->appendChild($basicSalaryTag); 
						$entryTag->appendChild($workHrsPerDayTag); 
						$entryTag->appendChild($REGHrsPerDayTag); 
						$entryTag->appendChild($REGAmtPerDayTag); 
						$entryTag->appendChild($OTHrsPerDayTag); 
						$entryTag->appendChild($OTAmtPerDayTag); 
						$entryTag->appendChild($totalAmtPerDayTag); 
					 
						$root->appendChild($entryTag);
					}
					$xml->appendChild($root); 
					$xml->save($filePath); 
				}
				
				if($result = mysqli_query($DBConnect, $query)) {
					while ($row = $result->fetch_assoc()) {
					   array_push($dtrarray, $row);
					}
					if(count($dtrarray)){
						 createXMLfile($dtrarray);
					 }
				}
				echo "<body>
						<div id='container'>
							<div id='sub-container'>
								<h2> SUCCESSFUL EXPORT </h2><br>
								<a href='mainMenu.php' class='btn'>Back To Main Menu</a>
							</div>
						</div>
					</body>";
			}
			else{
				header("location:export.php?error=1");
			}
		}
	}
?>