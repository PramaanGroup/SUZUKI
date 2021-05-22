<?php
date_default_timezone_set('Asia/Kolkata');
 $serverName = "tcp:pramaanserver.database.windows.net,1433";
    $connectionOptions = array(
        "Database" => "pramaandb",
        "Uid" => "pramaanadmin",
        "PWD" => "Pramaan_123"
    );
	$con = sqlsrv_connect($serverName, $connectionOptions);
	
$tableid = $_POST['tableid'];

$getsql = "select * from suzuki_campaign_data where id = $tableid";
$gres = sqlsrv_query($con,$getsql);
while($result = sqlsrv_fetch_array($gres, SQLSRV_FETCH_ASSOC)){
	$prevcomments = $result['comments'];
	$prevassigned = $result['assigned_to'];
	$dmsenquirynumber = $result['dmsnumber'];
	$testridevalue = $result['test_ride'];
}

$prev = json_decode($prevcomments);

$response = $_POST['EnquiryStatus'];
if(isset($_POST['AssignedTo']))
{
	$assigned = $_POST['AssignedTo'];
}
else
{
	$assigned = $prevassigned;
}
if(isset($_POST['DMSEnquiryNumber']))
{
	$updmsnum = $_POST['DMSEnquiryNumber'];
}
else
{
	$updmsnum = $dmsenquirynumber;
}
if(isset($_POST['Testride']))
{
	$test_ride = $_POST['Testride'];
}
else
{
	$test_ride = $testridevalue;
}
$comments = $_POST['Comments'];
$updated = date('d-M-Y H:i:s');
$followupdate = $_POST['FollowUpDate'];
$prev[] = $updated."|".$comments;
$pc = json_encode($prev);

$sql = "update suzuki_campaign_data set dmsnumber='$updmsnum',test_ride ='$test_ride',response='$response',assigned_to='$assigned',comments='$pc',to_be_contacted_date='$followupdate',updated_at ='$updated'  where id = $tableid";	

$res = sqlsrv_query($con,$sql);
 if(isset($_REQUEST["destination"])){
      header("Location: {$_REQUEST["destination"]}");
  }else if(isset($_SERVER["HTTP_REFERER"])){
      header("Location: {$_SERVER["HTTP_REFERER"]}");
  }else{
       /* some fallback, maybe redirect to index.php */
  }