<?php
    session_start();
    if(!isset($_SESSION["getLogin"])){
        header("location:login.php");
    }
    else{
?>
    <html>
        <head>
            <title>Delete DTR</title>
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

        </style>

        <body>
            <div id="container">
                <div id="sub-container">
                    <h2>Deletetion Method</h2>
					<br>
                    <hr>
                    <br>
						<a href="deleteDaily.php" class="btn">Delete Daily</a>
                        <a href="deleteWeekly.php" class="btn">Delete Weekly</a>
					<br>
					<br>
					<br>
                        <a href="mainMenu.php" class="btn">Back To Main Menu</a>
                </div>
                <a href="chat.php" class="chat-support"><i class="fa fa-commenting" style="font-size:25px"></i>Need help?</a>
            </div>
        </body>
    </html>
<?php }?>