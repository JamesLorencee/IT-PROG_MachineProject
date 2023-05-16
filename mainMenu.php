<?php
    session_start();
    if (!isset($_SESSION["getLogin"])) {
        header("location:login.php");
    }
    else {?>
        <html>
            <head>
                <title>Main Menu</title>
                <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
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
                    margin-bottom: 2%;
                    margin-left: auto;
                    margin-right: auto;
                    padding: 10px;
                    display: block;
                    overflow: hidden;
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
                a{
                    text-decoration: none;
                    color: inherit;
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
            </style>

            <body>
                <div id="container">
                    <div id="sub-container">
                        <?php
                            include("connect.php");
                            $id = $_SESSION["getLogin"];
                            $query = mysqli_query($DBConnect, "SELECT * FROM tbl_employees WHERE id='$id'");
                            $fetch = mysqli_fetch_array($query);

                            $username = $fetch["username"];
                            echo "<p><center> Hello<b> $username!</b></center></p>";

                            $imageURL = "uploads/".$fetch["emp_img"];
                            echo "<center><img height='100' width='100' src='".$imageURL."'/><center>";
                        ?>
                        <br>
                        <hr>
						<br>
                        <a href="dtr.php" class="btn">Create DTR</a>
                        <br><br>
                        <a href="modifyDTR.php" class="btn">Modify DTR</a>
                        <br><br>
                        <a href="delete.php" class="btn">Delete DTR</a>
                        <br><br>
                        <a href="selectViewMonth.php" class="btn">View All Records</a>
                        <br><br>
						<a href="computeSalary.php" class="btn">Compute Salary</a>
                        <br><br>
                        <a href="updateempinfo1.php" class="btn">Update Employee Information</a>
                        <br><br>
						<a href="indexImport.php" class="btn">Import Data</a>
                        <br><br>
                        <a href="export.php" class="btn">Export Data</a>
                        <br><br><br>

                        <a href="logout.php"><strong><center>Logout</center></strong></a><br>

                    </div>
                    
                    <a href='chat.php' class="chat-support"><i class='fa fa-commenting' style='font-size:25px'></i>Need help?</a>
                </div>
            </body>
        </html>
    <?php } ?>
