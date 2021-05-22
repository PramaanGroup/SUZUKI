<?php
date_default_timezone_set('Asia/Kolkata');
    session_start();
    session_destroy();
	if(isset($_GET['q']))
	{
		$error = base64_encode("Session expired please login again");
		header("location : index.php?lm=$error");
	}
	else
	{
		header('Location: index.php');
	}
?>