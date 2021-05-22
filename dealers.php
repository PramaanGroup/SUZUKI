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
if($_SESSION['username'] == 'Pramaan' ||$_SESSION['username'] == 'Anwar Baig' || $_SESSION['username'] == 'Jeevagan' || $_SESSION['username'] == 'Makesh' || $_SESSION['username'] == 'Arun Kumar' || $_SESSION['username'] == 'Zonal Head')
{}
else
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

$district = $_GET['dealer'];
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
                <li><a href="admindashboard.php">Home</a></li>
				<li class="active"><a href="dealers.php?dealer=<?php echo $district; ?>">Dealer stats</a></li>
                <li><a href="dealerleads.php?dealer=<?php echo $district; ?>">Latest Enquires</a></li>
                <li><a href="nextfollowups.php?dealer=<?php echo $district; ?>">Next Follow Up Enquires</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>

        <div class="menu-overlay">
            <div class="menu-box">
                <div class="menu-card">
                    <div class="py-3">
                        <ul class="list-unstyled">
							<li><a href="admindashboard.php">Home</a></li>
							<li class="active"><a href="dealers.php?dealer=<?php echo $district; ?>">Dealer stats</a></li>
							<li><a href="dealerleads.php?dealer=<?php echo $district; ?>">Latest Enquires</a></li>
							<li><a href="nextfollowups.php?dealer=<?php echo $district; ?>">Next Follow Up Enquires</a></li>
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
            <div class="container ">
                <div class="row m-0" style="justify-content: space-between;">
                    <div class="pb-3">
                        <h1 style="font-size:32px"><?php  echo $_SESSION[$district]; ?></h>
                    </div>
					<?php
					
					$folowersql = "select * from dealer_details where login_id = '$district'";
					$fres = sqlsrv_query($con,$folowersql);
					$delresult = sqlsrv_fetch_array($fres, SQLSRV_FETCH_ASSOC);
					if($username == 'Pramaan')
					{
					?>
					<div class="pb-3">
						<form method='get' action = 'followersedit.php'>
                        <h1 style="font-size:20px">Page Followers : <input type = 'text' name ='followers' value = "<?php echo $delresult['followers']; ?>" required></input></h1>
						<input type="hidden" name="destination" value="<?php echo $_SERVER["REQUEST_URI"]; ?>"/>
						<input type="hidden" name="vertical" value="<?php echo $district; ?>"/>
						<button type="submit" name="submit" value='submit' class="btn btn-submit">Update Followers</button>
						</form>
                    </div>
					<div class="pb-3">
                        <button class="open-button" onclick="openForm()">Upload file </button>
                    </div>
					<?php
					}
					else
					{
						?>
						<div class="pb-3">
                       		<h1 style="font-size:20px">Page Followers : <?php echo $delresult['followers']; ?> </h1>
						</div>
						<div class="pb-3">
							 <h1 style="font-size:20px"> Dealer Facebook Page :  </h1>
							 <a href=<?php echo $delresult['fbpagelink']; ?>> <i class="fa fa-facebook-square" style="font-size:48px"></i></a>
                    	</div>
						<?php 
					}
					?>
					
                </div>
            </div>
        </section>
        <div class="d-flex container">
			<div class="container">
				<?php
					$sql = "select count(id) as total_enquires from suzuki_campaign_data where vertical = '$district'";
					$res = sqlsrv_query($con,$sql);
					$result = sqlsrv_fetch_array($res, SQLSRV_FETCH_ASSOC); ?>
				
					<!-- echo "Total Enquires : ". $result['total_enquires']."<br>"; -->
					<div class="row">
						<div class="col-6 p-2">
							Total Enquires
						</div>
						<div class="col-6 p-2">
							: <?php echo $result['total_enquires']; ?>
						</div>
					</div>
					<?php
					$sql = "select count(id) as count,response from suzuki_campaign_data where vertical = '$district' group by response";
					$res = sqlsrv_query($con,$sql);
					while($cresult = sqlsrv_fetch_array($res, SQLSRV_FETCH_ASSOC))
					{
						
						if($cresult['response'] =='')
						{
							$cres['Unattended Enquires'] = $cresult['count'];
						}
						else
						{
							$cres[$cresult['response']] = $cresult['count'];
						}
					}
					
					$ara = ['Unattended Enquires','Booking Done','Closed Enquiry','Competition Bought','Interested','Not Interested','Not Reachable','Other Location Enquiry','Delivered'];
							
					foreach($ara as $aras)
					{
						$datacount = isset($cres[$aras]) ? $cres[$aras] : 0 ; ?>
						<!-- echo " $aras : $datacount<br>"; -->
						<div class="row">
							<div class="col-6 p-2">
								<?php 
								$ustaus=urlencode($aras);
								$querydata=base64_encode("$ustaus&$district"); ?>
								<a href="enquirystatusdata.php?data=<?php echo $querydata; ?>"><?php echo $aras; ?></a>
							</div>
							<div class="col-6 p-2">
								: <?php echo $datacount; ?>
							</div>
						</div>
					<?php	
						$datacount = null;
					}
					
				?>
			</div>
			
			<div class="container"  style="max-width: 300px">
			<label><b>Campaign Data</b></label>
				<form method="get" action="admincustomdata.php">
				<input type='hidden' name='dealer' value="<?php echo $district; ?>">
						<div class="mb-1">
						
						<label>Start Date </label>
						<input type="date" class="form-control" id="customstart" name="customstart" required>
					</div>
					<div class="mb-1">
			
						<label>End Date </label>
						<input type="date" class="form-control" id="customend" name="customend" required>
					</div>
					
					<div class="mb-1">
						<label> Model </label>
						
						<select class="form-control" id="vehiclemodel" name="vehiclemodel">
						<option value="all">All</option>
						<option value="scooters">Scooters</option>
						<option value="motorcycles">MotorCycle</option>
						</select>
					</div>
					<div class="mb-1">
						<label> Campaign Type </label>
						<select class="form-control" id="campaigntype" name="campaigntype">
						<option value="all">All</option>
						<option value="RegularCampaign">Regular Campaign</option>
						<option value="ExchangeMela">Exchange Mela</option>
						<option value="GixxerExclusive">GixxerExclusive</option>
						<option value="SpecialCampaign">SpecialCampaign</option>
						</select>
					</div>
					
					<button type="submit" name="data" value='submit' class="btn btn-submit">Get Data</button>
				</form>
			</div>	
		</div>	
 </main>
 
    <footer id="footer">
        <div class="container">
            &copy; Copyright <strong><span>Pramaan Marketing <?php echo date('Y'); ?></span></strong>. All Rights Reserved
        </div>
          <div style="display: flex; justify-content: flex-end; max-width:500px; float:right;">
			<h5>Last Login : <?php echo $delresult['last_login']->format('d-M-Y H:i:s'); ?></h5>
		</div>
    </footer>
</body>
<div class="form-popup" id="myForm">
	
	<form action="addFiles.php" method='post' class="form-container" id="fileuploadform" enctype="multipart/form-data">
	<h1>Upload CSV</h1>
		<input type="file" name="file" id="file" accept=".csv">
		<input type='hidden' name='vertical' value=<?php echo $district; ?> >
		<button type='button' id='load-file' value='Load' class='btn load'>Load</button>
		<div id='formdiv' class='indiv container'>
			<?php
				$fieldsArray = ['full_name','phone_number','alt_phone_num','email_address','city','district','model_of_vehicle','platform','test_ride','previous_vehicle','enquiry_date','campaign_name'];
				foreach($fieldsArray as $fields)
				{
					?>
					<div class="row m-0" style="justify-content: space-between;">
						<div class="pb-1">
						<?php
							echo " <b>$fields  : </b> ";
						?>
						</div>
						<div class="pb-1">
						<?php
							echo "<select id=".$fields." class='uploadselect' name =".$fields." required></select><br>";
						?>
						</div>
					</div>
					<?php
				} 
			?>
		</div>
		<button type="submit" name="submit" value='submit' id="submit" class="btn">upload</button>
		<button type="button" class="btn cancel" onclick="closeForm()">Close</button>
	</form>
</div>
<script src="file.js"></script>
</html>