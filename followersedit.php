<?php

date_default_timezone_set('Asia/Kolkata');
 $serverName = "tcp:pramaanserver.database.windows.net,1433";
    $connectionOptions = array(
        "Database" => "pramaandb",
        "Uid" => "pramaanadmin",
        "PWD" => "Pramaan_123"
    );
	$con = sqlsrv_connect($serverName, $connectionOptions);
	$followers = $_GET['followers'];
	$district = $_GET['vertical'];
	
	$sql = "update dealer_details set followers ='$followers' where login_id = '$district'";	
$res = sqlsrv_query($con,$sql);

	if(isset($_REQUEST["destination"])){
      header("Location: {$_REQUEST["destination"]}");
  }else if(isset($_SERVER["HTTP_REFERER"])){
      header("Location: {$_SERVER["HTTP_REFERER"]}");
  }else{
       /* some fallback, maybe redirect to index.php */
  }