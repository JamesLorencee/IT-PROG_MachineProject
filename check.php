<?php
	require("connect.php");
	
	if (isset($_POST["loginBtn"])){
		if(empty($_POST["username"]) && empty($_POST["password"])){  
			header("location:login.php?error=2");  
		}  
		else{  
			$user = $_POST["username"];
			$pass = substr(md5($_POST["pass"]),0,32);    
			$query = mysqli_query($DBConnect, "SELECT * FROM tbl_employees WHERE username='$user' AND password='$pass'");
			$count = mysqli_num_rows($query);

			if($count>0){
				session_start();  //to start the session

				$idfetch = mysqli_fetch_array($query); //get ID
				$id = $idfetch['id'];
				$_SESSION['getLogin'] = $id;

				$posquery = mysqli_query($DBConnect, "SELECT * FROM tbl_employees WHERE id='$id'"); // will check if the position data of an id exists
				$pos = mysqli_fetch_array($posquery);
				//No position, go to select position.
			
				if(empty($pos['position'])){
					header("location:selectposition.php");  //this sets the headers for the HTTP response given by the server 
				}//With position, go menu.
				else{
					header("location:mainMenu.php");
				}
			}
			else{
				header("location:login.php?error=1"); 
			}
		}
	}
	
	if(isset($_POST["regBtn"])){
		header("location:register.php");
	}
?>