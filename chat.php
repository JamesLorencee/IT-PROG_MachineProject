<html>
	<head>
		<title>Chat Client</title>
	</head>
	
	<style>
	* {
		margin: 0;
		padding: 0;
	  }
	   
	  body {
		margin: 20px auto;
		font-family: "Lato";
		font-weight: 300;
	  }
	   
	  form {
		padding: 15px 25px;
		display: flex;
		gap: 10px;
		justify-content: center;
	  }
	   
	  form label {
		font-size: 1.5rem;
		font-weight: bold;
	  }
	   
	  input {
		font-family: "Lato";
	  }
	   
	  a {
		color: #0000ff;
		text-decoration: none;
	  }
	   
	  a:hover {
		text-decoration: underline;
	  }
	   
	  #wrapper,
	  #loginform {
		margin: 0 auto;
		padding-bottom: 25px;
		background: #eee;
		width: 600px;
		max-width: 100%;
		border: 2px solid #212121;
		border-radius: 4px;
	  }
	   
	  #loginform {
		padding-top: 18px;
		text-align: center;
	  }
	   
	  #loginform p {
		padding: 15px 25px;
		font-size: 1.4rem;
		font-weight: bold;
	  }
	   
	  #chatbox {
		text-align: left;
		margin: 0 auto;
		margin-bottom: 25px;
		padding: 10px;
		background: #fff;
		height: 300px;
		width: 530px;
		border: 1px solid #a7a7a7;
		overflow: auto;
		border-radius: 4px;
		border-bottom: 4px solid #a7a7a7;
	  }
	   
	  #usermsg {
		flex: 1;
		border-radius: 4px;
		border: 1px solid #ff9800;
	  }
	   
	  #name {
		border-radius: 4px;
		border: 1px solid #ff9800;
		padding: 2px 8px;
	  }
	   
	  #submitmsg,
	  #enter{
		background: #ff9800;
		border: 2px solid #e65100;
		color: white;
		padding: 4px 10px;
		font-weight: bold;
		border-radius: 4px;
	  }
	   
	  .error {
		color: #ff0000;
	  }
	   
	  #menu {
		padding: 15px 25px;
		display: flex;
	  }
	   
	  #menu p.welcome {
		flex: 1;
	  }
	   
	  a#exit {
		color: white;
		background: #c62828;
		padding: 4px 8px;
		border-radius: 4px;
		font-weight: bold;
	  }
	   
	  .msgln {
		margin: 0 0 5px 0;
	  }
	   
	  .msgln span.left-info {
		color: orangered;
	  }
	   
	  .msgln span.chat-time {
		color: #666;
		font-size: 60%;
		vertical-align: super;
	  }
	   
	  .msgln b.user-name, .msgln b.user-name-left {
		font-weight: bold;
		background: #546e7a;
		color: white;
		padding: 2px 4px;
		font-size: 90%;
		border-radius: 4px;
		margin: 0 5px 0 0;
	  }
	   
	  .msgln b.user-name-left {
		background: orangered;
	  }
	</style>
	
	<body>
		<h3><center>Chat Client</center></h3>
		
		<div id="wrapper">
			<div id="menu">
				<p class="welcome">How can I help you?</p>
				<p class="logout"><a id="exit" href="mainMenu.php">Exit Chat</a></p>
			</div>

			<form method="POST">
				<input type="text" name="txtMessage" size="45">
				<input type="submit" id="btnSend" name="btnSend" value="Send">
			</form>
			
			<?php
				$host = "127.0.0.1";
				$port = 4999;
				set_time_limit(0);
				if (isset($_POST["btnSend"])){
					$msg = $_REQUEST["txtMessage"];
					$sock = socket_create(AF_INET, SOCK_STREAM, 0);
					socket_connect($sock, $host, $port);
					  
					socket_write($sock, $msg, strlen($msg));
					  
					$reply = socket_read($sock, 1024);
					$reply = trim($reply);
					$reply = "Admin:\t". $reply;
				}
			?>
		<div id="chatbox">
			<?php echo @$reply; ?>
		</div>
	</body>
</html>