<?php
 $serverName = "tcp:pramaanserver.database.windows.net,1433";
    $connectionOptions = array(
        "Database" => "pramaandb",
        "Uid" => "pramaanadmin",
        "PWD" => "Pramaan_123"
    );
	$con = sqlsrv_connect($serverName, $connectionOptions); 
	
$vertical = $_POST['vertical'];

if (isset($_POST["submit"])) {
	$check = [];
	$sql = "select * from campaign_logins where dealer = 'Suzuki AP'";
	$res = sqlsrv_query($con,$sql);
	while($cresult = sqlsrv_fetch_array($res, SQLSRV_FETCH_ASSOC))
	{
		$dist_log = strtolower($cresult['district']);
		$check[$dist_log] = $cresult['user_id'];
    }
    $fileName = $_FILES["file"]["tmp_name"];
    if ($_FILES["file"]["size"] > 0) {
        $fp = fopen($fileName, "r");
		$line=0;
		$finalvalues= null;
		while($column = fgetcsv($fp, 100000, ","))
		{ 
			$fields=null;
			$values=null;
			$line++;
			if($line==1)
			{
				continue;
			}
			
			foreach($_POST as $fieldname=>$fieldcolumn)
			{
				if($fieldname != 'submit')
				{
					$fields .= $fieldname.',';
					if($fieldcolumn == 'NA')
					{
						$values .= "' ',";
					}
					elseif($fieldname == 'enquiry_date')
					{
						$date = new DateTime($column[$fieldcolumn]);
						$enq_date = $date->format('Y-m-d H:i:s');
						$values .="'".$enq_date."',";
					}
					elseif($fieldname == 'vertical')
					{
						$d = strtolower(trim(str_replace("_"," ",$column[$_POST['district']])));
						$vertical = $check[$d];
						$values .="'".$vertical."',";
					}
					elseif($fieldname == 'campaign_name')
					{
						$values .="'".$fieldcolumn."',";
					}
					elseif($fieldname == 'phone_number')
					{
						$phonedata = explode(":",$column[$fieldcolumn]);
						$values .="'".$phonedata[1]."',";
					}
					else
					{
						
						$values .="'".str_replace("'","",$column[$fieldcolumn])."',";
					}
				}
			}
			
			$fieldstosql = rtrim($fields,",");
			$valuestosql = rtrim($values,",");	
			$finalvalues .= "($valuestosql),";
			if($line % 100 == 0)
			{
				$finalvalues = rtrim($finalvalues,",");
				$sql = "insert into suzuki_campaign_data($fieldstosql) values $finalvalues";
				$stmt = sqlsrv_query($con,$sql);
				$finalvalues = null;
			}
		}
		if($line % 100 != 0)
		{
			$finalvalues = rtrim($finalvalues,",");
			$sql = "insert into suzuki_campaign_data($fieldstosql) values $finalvalues";
			$stmt = sqlsrv_query($con,$sql);
			$finalvalues = null;
		
		}
		$line = $line-1;
		$msg = base64_encode($vertical." success with count $line");
		header("location: admindashboard.php?q=$msg");	
	}
}
?>


