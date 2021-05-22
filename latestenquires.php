<?php

session_start();
date_default_timezone_set('Asia/Kolkata');
$inactive = 1800; 

$session_life = time() - $_SESSION['timeout'];

if($session_life > $inactive)
{  session_destroy(); header("Location: logout.php?q");     }

$_SESSION['timeout']=time();
 if(!isset($_SESSION['username']) )
{
	header('location : index.php ');
} 
$serverName = "tcp:pramaanserver.database.windows.net,1433";
    $connectionOptions = array(
        "Database" => "pramaandb",
        "Uid" => "pramaanadmin",
        "PWD" => "Pramaan_123"
    );
	$con = sqlsrv_connect($serverName, $connectionOptions);

$district = $_SESSION['vertical'];
$username  = $_SESSION['username'];





?>
<!DOCTYPE html>
<html lang="EN">
<head>
    <title>Suzuki- Motor Cycles</title>
	<link rel="shortcut icon" type="image/png" href="suzukifavicon.jpg">
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="campaign.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <header id="header" class="fixed-top">
      <div class="container d-flex header-box">

        <div class="logo mr-auto">
		    <a href="index.php"><img src="marketinglogo.png" alt="logo" class="img-fluid"></a>
        </div>

        <nav class="nav-menu d-none d-lg-block">
            <ul class="d-flex m-0">
                <li><a href="dashboard.php">Home</a></li>
				<li class="active"><a href="latestenquires.php">Latest Enquires</a></li>
				<li><a href="nextfollowupenquires.php">Next Follow Up Enquires</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>

        <div class="menu-overlay">
            <div class="menu-box">
                <div class="menu-card">
                    <div class="py-3">
                        <ul class="list-unstyled">
                            <li><a href="dashboard.php">Home</a></li>
							<li class="active"><a href="latestenquires.php">Latest Enquires</a></li>
							<li><a href="nextfollowupenquires.php">Next Follow Up Enquires</a></li>
							<li><a href="logout.php">Logout</a></li>
                        </ul>
                    </div>
                </div>
                <svg class="menu-close-btn" xmlns="http://www.w3.org/2000/svg" height="512px" viewBox="0 0 329.26933 329" width="512px"><g><path d="m194.800781 164.769531 128.210938-128.214843c8.34375-8.339844 8.34375-21.824219 0-30.164063-8.339844-8.339844-21.824219-8.339844-30.164063 0l-128.214844 128.214844-128.210937-128.214844c-8.34375-8.339844-21.824219-8.339844-30.164063 0-8.34375 8.339844-8.34375 21.824219 0 30.164063l128.210938 128.214843-128.210938 128.214844c-8.34375 8.339844-8.34375 21.824219 0 30.164063 4.15625 4.160156 9.621094 6.25 15.082032 6.25 5.460937 0 10.921875-2.089844 15.082031-6.25l128.210937-128.214844 128.214844 128.214844c4.160156 4.160156 9.621094 6.25 15.082032 6.25 5.460937 0 10.921874-2.089844 15.082031-6.25 8.34375-8.339844 8.34375-21.824219 0-30.164063zm0 0" data-original="#000000" class="active-path" data-old_color="#000000" fill="#FFFFFF"/></g> </svg>
            </div>
        </div>

        <div class="d-lg-none d-block">
            <div class="open">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -96 512 512" width="40px" height="40px" ><g class="menu-bars"><path d="m32 0h448c17.671875 0 32 14.328125 32 32s-14.328125 32-32 32h-448c-17.671875 0-32-14.328125-32-32s14.328125-32 32-32zm0 0"/><path d="m32 128h448c17.671875 0 32 14.328125 32 32s-14.328125 32-32 32h-448c-17.671875 0-32-14.328125-32-32s14.328125-32 32-32zm0 0"/><path d="m32 256h448c17.671875 0 32 14.328125 32 32s-14.328125 32-32 32h-448c-17.671875 0-32-14.328125-32-32s14.328125-32 32-32zm0 0"/></g></svg>
            </div>
        </div>

      </div>
    </header><!-- End Header -->
	
	
<main>
        <!-- Table with 100% with responsive start -->
        <section class="py-3">
		<p id="start"></p>
            <div class="container">
                <div class="row m-0" style="justify-content: space-between;">
                    <div class="pb-3">
                        <h1 style="font-size:32px">Welcome <?php  echo $username; ?></h>
                    </div>
                    <div class="pb-3">
						<label>Filename : </label>
						<input class="filename" type='text' name='dfilename' id='filename' Placeholder="Filename" required></input>
						<input type='hidden' id='curtime' value=<?php echo date('Y-m-d_Hi'); ?> />
                        <button class="open-button" id="create_excel">Download file </button>
                    </div>
                </div>
                <div style="display: flex; justify-content: flex-end; max-width:200px; float:right;">
					<button type="reset" name="reset" value='Reset' id="configreset" class="open-button">Reset</button>
				</div>
				<div  class="pb-3">
					
				<?php
						
						$sql ="select convert(DATE,max(enquiry_date), 120 ) as maximumdate from suzuki_campaign_data where vertical = '$district'";
						 
						 
						$mres = sqlsrv_query($con,$sql);
						if(sqlsrv_errors())
						{
							print_r(sqlsrv_errors());
							exit;
						}
						while($row = sqlsrv_fetch_array($mres, SQLSRV_FETCH_ASSOC)){
							$mdate = $row['maximumdate'];
						}
						$mxdate= '';
						if(isset($mdate))
						{
							$mxdate = $mdate->format("Y-m-d");
							$mxdate = date('Y-m-d', strtotime('-2 days', strtotime($mxdate)));
						}
						?>
						<form id="configform" name='filterform' action='' method='GET' class = 'form-inline'>
						<?php
						 $cdatesql = "select distinct convert(DATE,enquiry_date, 120 ) as enq_date from suzuki_campaign_data where vertical = '$district' and enquiry_date >= '$mxdate'";
						$cdateres = sqlsrv_query($con,$cdatesql);
						echo "<div class='form-group pr-2'><select class='form-control input-sm' name ='enquiry_date' id='enquiry_date'><option value='' selected='selected'>Select Date</option>";
						while($cdateresult = sqlsrv_fetch_array($cdateres, SQLSRV_FETCH_ASSOC)){
							 if(isset($_GET['enquiry_date']) &&  $_GET['enquiry_date'] == $cdateresult['enq_date']->format('Y-m-d'))
							 {
								 echo "<option value='".$cdateresult['enq_date']->format('Y-m-d')."' selected>".$cdateresult['enq_date']->format('d-M-Y')."</option>";
							 }
							 else
							 {
								echo "<option value='".$cdateresult['enq_date']->format('Y-m-d')."'>".$cdateresult['enq_date']->format('d-M-Y')."</option>";
							 }
						}
						echo "</select></div>";

						$cnamaefilsql = "SELECT  distinct (campaign_name) FROM suzuki_campaign_data where vertical = '$district' and enquiry_date >= '$mxdate'";
						
						$cnameres = sqlsrv_query($con,$cnamaefilsql);
						echo "<div class='form-group pr-2'><select class='form-control input-sm' name ='campaign_name' id='campaign_name'><option value='' selected='selected'>Select Campaign</option>";
						
						while($cnameresult = sqlsrv_fetch_array($cnameres, SQLSRV_FETCH_ASSOC)){
							 if(isset($_GET['campaign_name']) &&  $_GET['campaign_name'] == $cnameresult['campaign_name'])
							 {
								 echo "<option value='".$cnameresult['campaign_name']."' selected>".ucwords($cnameresult['campaign_name'])."</option>";
							 }
							 else
							 {
								echo "<option value='".$cnameresult['campaign_name']."'>".ucwords($cnameresult['campaign_name'])."</option>";
							 }
						}
						echo "</select></div>";
						$citfilsql = "SELECT  distinct (city) FROM suzuki_campaign_data where vertical = '$district' and enquiry_date >= '$mxdate'";
						$citres = sqlsrv_query($con,$citfilsql);
						echo "<div class='form-group pr-2'><select class='form-control input-sm' name ='city' id='city'><option value='' selected='selected'>Select City</option>";
						
						while($cresult = sqlsrv_fetch_array($citres, SQLSRV_FETCH_ASSOC)){
							 if(isset($_GET['city']) &&  $_GET['city'] == $cresult['city'])
							 {
								 echo "<option value='".$cresult['city']."' selected>".ucwords($cresult['city'])."</option>";
							 }
							 else
							 {
								 echo "<option value='".$cresult['city']."'>".ucwords($cresult['city'])."</option>";
							 }
							 
						}
						echo "</select></div>";
						$disfilsql = "SELECT  distinct (district) FROM suzuki_campaign_data where vertical = '$district' and enquiry_date >= '$mxdate'";
						$disres = sqlsrv_query($con,$disfilsql);
						echo "<div class='form-group pr-2'><select class='form-control input-sm'  name ='district' id='district'><option value='' selected='selected'>Select District</option>";
						
						while($disresult = sqlsrv_fetch_array($disres, SQLSRV_FETCH_ASSOC)){
							 
							if(isset($_GET['district']) && $_GET['district']== $disresult['district'])
							{
								 echo "<option value='".$disresult['district']."' selected>".ucwords(str_replace("_"," ",$disresult['district']))."</option>";

							}
							else
							{
							 echo "<option value='".$disresult['district']."'>".ucwords(str_replace("_"," ",$disresult['district']))."</option>";
							}
						}
						echo "</select></div>";
						
						$disfilsql = "SELECT  distinct (model_of_vehicle) FROM suzuki_campaign_data where vertical = '$district' and enquiry_date >= '$mxdate'";
						$disres = sqlsrv_query($con,$disfilsql);
						echo "<div class='form-group pr-2'><select class='form-control input-sm'  name ='model_of_vehicle' id='model_of_vehicle'><option value='' selected='selected'>Select Model</option>";
						
						while($disresult = sqlsrv_fetch_array($disres, SQLSRV_FETCH_ASSOC)){
							if(isset($_GET['model_of_vehicle']) && $_GET['model_of_vehicle']==$disresult['model_of_vehicle'])
							{
								echo "<option value='".$disresult['model_of_vehicle']."' selected>".ucwords(str_replace("_"," ",$disresult['model_of_vehicle']))."</option>";
							}
							else
							{
							echo "<option value='".$disresult['model_of_vehicle']."'>".ucwords(str_replace("_"," ",$disresult['model_of_vehicle']))."</option>";
							}
						}
						echo "</select></div>";
						
						?>
						<div class='form-group pr-2'>
							<select class='form-control input-sm'  name ='test_ride' id='test_ride'>
								<option value='' selected='selected'>Select TestRide</option>
								<option value='Yes' <?php if(isset($_GET['test_ride']) && $_GET['test_ride']=='Yes') { echo "selected";}?>>Yes</option>
								<option vlaue='No' <?php if(isset($_GET['test_ride']) && $_GET['test_ride']=='No') { echo "selected";}?>>No</option>
							</select>
						</div>
						<div class='form-group pr-2'>
							<select class='form-control input-sm'  name ='response' id='response'>
								<option value='' selected='selected'>Select Enquiry Status</option>
								<option value='Booking Done' <?php if(isset($_GET['response']) && $_GET['response']=='Booking Done') { echo "selected";}?>>Booking Done</option>
								<option value='Closed Enquiry' <?php if(isset($_GET['response']) && $_GET['response']=='Closed Enquiry') { echo "selected";}?>>Closed Enquiry</option>
								<option value='Competition Bought' <?php if(isset($_GET['response']) && $_GET['response']=='Competition Bought') { echo "selected";}?>>Competition Bought</option>
								<option value='Dummy Enquiry' <?php if(isset($_GET['response']) && $_GET['response']=='Dummy Enquiry') { echo "selected";}?>>Dummy Enquiry</option>
								<option value='Interested' <?php if(isset($_GET['response']) && $_GET['response']=='Interested') { echo "selected";}?>>Interested</option>
								<option value='Not Interested' <?php if(isset($_GET['response']) && $_GET['response']=='Not Interested') { echo "selected";}?>>Not Interested</option>
								<option value='Not Reachable' <?php if(isset($_GET['response']) && $_GET['response']=='Not Reachable') { echo "selected";}?>>Not Reachable</option>
								<option value='Other Location Enquiry' <?php if(isset($_GET['response']) && $_GET['response']=='Other Location Enquiry') { echo "selected";}?>>Other Location Enquiry</option>
								<option value='Delivered' <?php if(isset($_GET['response']) && $_GET['response']=='Delivered') { echo "selected";}?>>Delivered</option>
							</select>
						</div>
						<div class='form-group pr-2'>
						<button type="submit" name="submit" value='submit' id="filtersubmit" class="open-button">Filter</button>
					
						</form>
						</div>
						
						
				</div>
                <div class="table-responsive panel-body">
                    <table class="table" id="t01">
                        <thead class="thead-light">
                            <tr>
							 <th scope="col"  onclick="sortTable(0)" style="cursor: pointer;">S.No</th>
							  <th onclick="sortTable(1)" style="cursor: pointer;">Date Of Enquiry</th>
							  <th>Campaign Type</th>
							  <th>Customer Name</th>
							  <th>Contact Number</th>
							  <th>Alt Number</th>
							  <th>City</th>
							  <th>District</th>
							  <th>Model</th>
							  <th>No Of Followups</th>
							  <th>Test Ride</th>
							  <th>AssignedTo</th>
							  <th onclick="sortTable(12)" style="cursor: pointer;">DMS EnquiryStatus</th>
							  <th>DMS EnquiryNumber</th>
							  <th>Remarks</th>
							  <th>Next FollowUp Date</th>
							  <th></th>
							  <th></th>
                            </tr>
                        </thead>
                        <tbody id ="myTable">
						<?php
						if(isset($_GET['submit']))
						{
							$where = '';
							foreach($_GET as $filterkey=>$filterval)
							{
								if($filterkey != 'submit')
								{
									if($filterval)
									{
										if($filterkey == 'test_ride' &&  $filterval != 'Yes')
										{
											$where .= "and $filterkey != 'Yes' ";
										}
										else if($filterkey == 'enquiry_date')
										{
											$where .= "and convert(DATE,enquiry_date, 120 )  = '$filterval' ";
										}						
										else
										{
											$where .= "and $filterkey = '$filterval' ";
										}
										
									}
								}
							}
						  $sqlSelect = "SELECT * FROM suzuki_campaign_data where vertical = '$district' and enquiry_date >= '$mxdate' $where order by enquiry_date desc ";
							
						}
						else
						{
							 $sqlSelect = "SELECT * FROM suzuki_campaign_data where vertical = '$district' and enquiry_date >= '$mxdate' order by enquiry_date desc ";
						}
						
						$res = sqlsrv_query($con,$sqlSelect);
						$i=0;
						while($result = sqlsrv_fetch_array($res, SQLSRV_FETCH_ASSOC)){
							$i++;
							$comm  = json_decode($result['comments']);
							if(!empty($comm))
							{
								$lct = explode("|",end($comm));
								$latestcomment = $lct[1];
								$followupcount = count($comm);
							}
							else
							{
								$latestcomment = '';
								$followupcount = 0;
							}
							
					 ?>
              		  <tr id=<?php echo $result['id']; ?> > 
					<td id='S.No'><?php echo $i; ?></td>
					<td id='DateOfEnquiry'><?php  echo isset($result['enquiry_date'])? $result['enquiry_date']->format('d-M-Y') : ''; ?></td>
					<td id='CampaignType'><?php  echo ucwords($result['campaign_name']); ?></td>
					<td id='CustomerName'><?php  echo ucwords($result['full_name']); ?></td>
					<td id='ContactNumber'><?php  echo str_replace("+91","",$result['phone_number']); ?></td>
					<td id='AlternateContactNumber'><?php  echo is_numeric($result['alt_phone_num']) ? $result['alt_phone_num'] : ''; ?></td>
					<td id='City'><?php  echo ucwords($result['city']); ?></td>
					<td id='District'><?php  echo ucwords(str_replace("_"," ",$result['district'])); ?></td>
					<td id='Model'><?php  echo ucwords(str_replace("_"," ",$result['model_of_vehicle'])); ?></td>
					<td id='FollowUpCount'><?php  echo $followupcount; ?></td>
					<td id='Testride'><?php  echo $result['test_ride']; ?></td>
					<td id='AssignedTo'><?php  echo $result['assigned_to']; ?></td>
                    <td id='EnquiryStatus'><?php echo $result['response']; ?></td>
					<td id='DMSEnquiryNumber'><?php echo $result['dmsnumber']; ?></td>
					<td id='Comments'><?php  echo $latestcomment; ?></td>
					<td id='FollowUpDate'><?php  echo isset($result['to_be_contacted_date']) ? $result['to_be_contacted_date']->format('d-M-Y') : ''; ?></td>
					<td id='FullComment' style="display:none;"><?php  echo $result['comments']; ?></td>
					<input type="hidden" name="tablerow" id="tablerow" value=<?php echo $result['id']; ?>>
					<td id='EditButton'><i class="fa fa-edit" style="color:#efb81b"></i></td>
					<td id = 'bulkupdate'><Input type="checkbox" value=<?php echo $result['id']; ?>></td>
				
                </tr>
				
				
				 <?php
			}
                ?>
				</tbody>
				</table>
				<button class="btn btn-danger" id='bulkedit'>Bulk Assign</button>
				<div style="display: none;" id = 'bulkassigneddiv' class='py-2'>
					<input class="filename" type='text' name='bulkassigned' id='bulkassigned' Placeholder="Assigned To" required></input>
					<button type="submit" name="assigupdate" value='assigupdate' id="assignupdate" class="open-button">Assign</button>
					<button type="reset" name="cancelassign" value='Reset' id="cancelassign" class="open-button">Cancel</button>
				</div>
                </div>
            </div>
        </section>
 </main>
    <footer id="footer">
        <div class="container">
            &copy; Copyright <strong><span>Pramaan Marketing <?php echo date('Y'); ?></span></strong>. All Rights Reserved
        </div>
    </footer>
</body>
<section class="popbox group" id="popbox">
    <div class="popup">
     <div class="popup-inner">
       <p class="title">Lead Details</p>
	   
			<form action="inlineedit.php" method="post" id="inlineeditform">
			<input type="hidden" name="destination" value="<?php echo $_SERVER["REQUEST_URI"]; ?>"/>
            <div class="row">
                <div class="left-sec col-sm-12 col-lg-6" style="font-size:13px">
                	<div class="row">
                		<div class="col-5 form-left-col"></div>
                		<div class="col-7 form-right-col"></div>
                	</div>
                </div>
                <div class="right-sec col-sm-12 col-lg-6">
                	<div class="remarks-section"></div>
					<div class="row">
                		<div class="col-6 rightform-left-col"></div>
                		<div class="col-6 rightform-right-col"></div>
                	</div>
				</div>
            </div>
			</form>
           <a class="close" href="#">x</a>
        </div>
      </div>
    </section> 
	
	
<script src="file.js"></script>
<script>  
 $(document).ready(function(){  
      $('#create_excel').click(function(){  
          
		var filename = $('#filename').val();
		var filedate = $('#curtime').val();
		filename = filename +"_"+filedate+ ".csv";
		
        var data='';
        var myTab = document.getElementById('t01');

        // LOOP THROUGH EACH ROW OF THE TABLE AFTER HEADER.
        for (i = 0; i < myTab.rows.length; i++) {

            // GET THE CELLS COLLECTION OF THE CURRENT ROW.
            var objCells = myTab.rows.item(i).cells;

            // LOOP THROUGH EACH CELL OF THE CURENT ROW TO READ CELL VALUES.
            for (var j = 0; j < objCells.length-3; j++) {
				data +=  objCells.item(j).innerHTML+',';
				
            }
            data= data + '\r\n';     // ADD A BREAK (TAG).
	
        }
    
  function downloadContent(name, content) {
  var atag = document.createElement("a");
  var file = new Blob([content], {type: 'text/csv;charset=utf-8'});
  atag.href = URL.createObjectURL(file);
  atag.download = name;
  atag.click();
}

downloadContent(filename,data);
// Write data in 'Output.txt' . 
 
      });  

 });  

 </script>
 

</html>