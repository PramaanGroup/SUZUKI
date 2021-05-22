<?php



date_default_timezone_set('Asia/Kolkata');
 $serverName = "tcp:pramaanserver.database.windows.net,1433";
    $connectionOptions = array(
        "Database" => "pramaandb",
        "Uid" => "pramaanadmin",
        "PWD" => "Pramaan_123"
    );
	$con = sqlsrv_connect($serverName, $connectionOptions);
	$assigned = $_POST['assignedto'];
	$ids = $_POST['ids'];
	
	$sql = "update suzuki_campaign_data set assigned_to ='$assigned' where id in ($ids)";	
$res = sqlsrv_query($con,$sql);
if(!sqlsrv_errors())
{
	echo $sql;
}

	
?>