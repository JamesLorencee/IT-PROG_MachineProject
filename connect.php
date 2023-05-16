<?php
	$DBConnect = mysqli_connect( "localhost", "root", "") or die("Unable to connect". mysqli_error());
    $db = mysqli_select_db($DBConnect, 'dbdtr');
?>