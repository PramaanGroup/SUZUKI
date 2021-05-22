<?php
session_start();

date_default_timezone_set('Asia/Kolkata');
$serverName = "tcp:pramaanserver.database.windows.net,1433";
    $connectionOptions = array(
        "Database" => "pramaandb",
        "Uid" => "pramaanadmin",
        "PWD" => "Pramaan_123"
    );
	$con = sqlsrv_connect($serverName, $connectionOptions);

if(isset($_POST['submit']))
{

	$username = $_POST['username'];
	$password = base64_encode($_POST['password']);

	$check = "select * from campaign_logins where user_id = '$username' and password = '$password'";
	
	$res = sqlsrv_query($con,$check);
	$data = [];
	
	while($row = sqlsrv_fetch_array($res, SQLSRV_FETCH_ASSOC)) {
	    $data[] = $row;
	}
	if(count($data) > 0)
	{
		$_SESSION['username'] = $data[0]['name'];
		$_SESSION['timeout']=time();
		$username = strtolower($username);
		if($username == 'pramaanadmin' || $username == 'jeevagan_am' || $username == 'anwar_am' || $username == 'makesh_am' || $username == 'arun_am' || $username == 'zonal_head')
		{
			header('location : admindashboard.php');
		}
		else
		{
			$_SESSION['vertical'] = $data[0]['user_id'];
			$last_login = date("Y-m-d H:i:s");
			$sqlup = "update dealer_details set last_login = '$last_login' where login_id ='".$_SESSION['vertical']."'";
			sqlsrv_query($con,$sqlup);
			header('location : dashboard.php');
		}

	}
	else
	{
		$error = base64_encode("Invalid Credentials");
		header("location : index.php?lm=$error");
		
	} 
	
}
?>