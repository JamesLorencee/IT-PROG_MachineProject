<?php
	session_start();
	if (!isset($_SESSION["getLogin"])){
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

        /*Field*/
        input[type="day"] {
            margin-top: 10px;
            border-radius: 5px;
            text-decoration: none;
            padding: 5px;
            box-shadow: 2px 2px 10px grey;
            box-sizing: border-box;
            border: 1px solid black;
        }

        .day-container {
            display: inline block;
            margin-left: auto;
            margin-right: auto;
            width: 50%;
            border-radius: 5px;
            border: 1px solid black;
            box-sizing: border-box;
            padding: 10px 10px 15px 10px;
            box-shadow: 2px 2px 10px grey;
        }

        .day-container input {
            margin-right: 20px;
        }

        .day-container label {
            font-weight: bold;
            margin-right: 10px;
        }

        p {
            color: red;
        }
    </style>
	
    <script type="text/javascript">
        function confirmation() {
            alert("Confirm date?")
        }
    </script>
	
    <body>
        <div id="container">
            <div id="sub-container">
                <h2> Please select a day to modify its DTR</h2>
                <br>
                <hr>
                <br>
                <div class="day-container">
                    <form method="post" action="checkdate.php">
                        <label> Date: </label>
                        <input type="date" name="date" />
                        <input type="submit" onclick='confirmation()' name="go" value="Go" class="btn" />
                    </form>
                </div>
                <br>
				<?php
					if (isset($_GET["error"])) {
						$error = $_GET["error"];

						//this line will be called by the checkdate.php
						if ($error == 1) {
							echo "<p align='center'>There is no DTR with this date. Please enter a valid date, thank you!<br/></p>";
						}
						if ($error == 2) {
							echo "<p align='center'>This is a 'No Work' day, cannot modify.<br/></p>";
						}
					}
                ?>
                <br>
                <a href="mainMenu.php" class="btn">Back To Main Menu</a>
            </div>
            <a href="chat.php" class="chat-support"><i class="fa fa-commenting" style="font-size:25px"></i>Need help?</a>
        </div>
    </body>
    </html>
<?php }?>