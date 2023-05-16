<?php
	session_start();
	include('connect.php');

	if(isset($_SESSION["getLogin"])){
		header('location:mainMenu.php');
	}
	else{
?>
    <html>

    <head>
        <title>Login Page</title>
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
            max-width: 30%;
            box-shadow: 10px 20px 50px grey;
            border-radius: 10px;
            box-sizing: border-box;
            box-shadow: 12px;
            background-color: white;
            margin-top: 2%;
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
        input[type="password"] {
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

        i {
            padding-right: 10px;
        }

        a {
            text-decoration: none;
            color: black;
        }

        a:hover {
            color: blue;
        }

        p {
            color: red;
        }
        h1{
            text-align: center;
            margin-top: 5%;
            font-style: italic;
        }
    </style>

    <body>
    <h1>WJJP Tech Co.</h1>
        <div id="container">
            <div id="sub-container">
                <h2> LOGIN </h2>
                <br>
                <hr>
                <br>

                <form method="post" action="check.php">
                    <div class="fields">
                        <label> Username</label>
                        <br>
                        <span><input type="text" name="username" placeholder="username" /></span>
                        <br>
                        <label> Password </label>
                        <br>
                        <span><input type="password" name="pass" placeholder="password" /></span>
                    </div>
                    <br>
                    <?php
						if (isset($_GET["error"])) {
							$error = $_GET["error"];

							//this line will be called by the check.php if the login credentials are incorrect 
							if ($error == 1) {
								echo "<p align='center'>Username and/or password invalid<br/></p>";
							}
							if ($error == 2) {
								echo "<p align-'center'> Both are required fields to proceed. </p>";
							}
						}
                    ?>
                    <br>
                    <input type="submit" value="Login" name="loginBtn" class="btn" />
                    <input type="submit" value="Register" name="regBtn" class="btn" />
                </form>
            </div>

            <a href="chat.php"><i class="fa fa-commenting" style="font-size:25px"></i>Need help?</a>
        </div>
		
    </body>

    </html>
<?php } ?>