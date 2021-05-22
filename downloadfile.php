<?php
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
		$start = $_POST['startdate'];
		$end = $_POST['enddate'];
		$vertical = $_POST['vertical'];
		header('Content-Type: text/csv; charset=utf-8');  
		$filename = $vertical."_".$start."_".$end.".csv";
		header("Content-Disposition: attachment; filename=$filename");
		$output = fopen("php://output", "w");  
		fputcsv($output, array('Name','Email','Phone','City','District','Vehicle model'));
		$sql = "select full_name,email_address,phone_number,city,district,previous_vehicle from suzuki_campaign_data where vertical = '$vertical' and created_at between '$start' and '$end'";
		$res = sqlsrv_query($con,$sql);
		while($result = sqlsrv_fetch_array($res, SQLSRV_FETCH_ASSOC)){
			fputcsv($output,$result);
		}
		fclose($output);
	}