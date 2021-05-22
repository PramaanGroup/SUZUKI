<?php
date_default_timezone_set('Asia/Kolkata');
session_start();
$inactive = 1800; 

$session_life = time() - $_SESSION['timeout'];

if($session_life > $inactive)
{  session_destroy(); header("Location: logout.php?q");     }

$_SESSION['timeout']=time();
if(!isset($_SESSION['username']))
{
	header('location : index.php ');
} 
if($_SESSION['username'] == 'Pramaan' || $_SESSION['username'] == 'Anwar Baig' || $_SESSION['username'] == 'Jeevagan' || $_SESSION['username'] == 'Makesh' || $_SESSION['username'] == 'Arun Kumar' || $_SESSION['username'] == 'Zonal Head')
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
	
$username = $_SESSION['username'];
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
                <li class="active"><a href="admindashboard.php">Home</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>

        <div class="menu-overlay">
            <div class="menu-box">
                <div class="menu-card">
                    <div class="py-3">
                        <ul class="list-unstyled">
                            <li class="active"><a href="admindashboard.php">Home</a></li>
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
			<div class="container">
                <div class="row m-0" style="justify-content: space-between;">
                    <div class="pb-3">
                        <h1 style="font-size:32px">Welcome <?php  echo $username; ?></h>
                    </div>
                    
                </div> 
			</div>
		</section>
        <section class="py-3">
            <div class="container">
                <div class="accordion-header">Select Dealer</div>
                <div class="accordion-body">
                    <div id="myDropdown" class="row m-0">
                        <input type="text" placeholder="Search.." id="myInput" onkeyup="filterFunction()">
						<?php 
						if($_SESSION['username'] == 'Pramaan')
						{
							$sql = "select * from campaign_logins where role ='Dealer'";
						}
						if($_SESSION['username'] == 'Zonal Head')
						{
							$sql = "select * from campaign_logins where role ='Dealer' and dealer = 'Suzuki AP'";
						}
						if($_SESSION['username'] == 'Jeevagan')
						{
							$sql = "select * from campaign_logins where district in ('Srikakulam','Vizianagaram','Visakhapatnam','East Godavari')";
						}
						if($_SESSION['username'] == 'Anwar Baig')
						{
							$sql = "select * from campaign_logins where district in ('West Godavari','Krishna')";	
						}
						if($_SESSION['username'] == 'Makesh')
						{
							$sql = "select * from campaign_logins where district in ('Guntur','Prakasam','Kurnool')";
						}
						if($_SESSION['username'] == 'Arun Kumar')
						{
							$sql = "select * from campaign_logins where district in ('Chittoor','Anantapur','Nellore','KADAPA')";
						}
						$res = sqlsrv_query($con,$sql);
						if(sqlsrv_errors())
						{
							print_r(sqlsrv_errors());
						}
						while($result = sqlsrv_fetch_array($res, SQLSRV_FETCH_ASSOC)){
							echo "<a href='dealers.php?dealer=".$result['user_id']."' id = '".$result['user_id']."' class='col-sm-12 col-md-6 col-lg-3 district'> ".$result['name']."-".$result['district']."</a>";
								$_SESSION[$result['user_id']] = $result['name'];
							$disti[]= $result['user_id'];
						}
						?>
                    </div>
                </div>
				
            </div>
			<div class="container">
				<?php 
				if(isset($_GET['q']))
				{
					echo base64_decode($_GET['q']);
				}
				?>
				</div>
        </section>
		<div class="d-flex container">
			<div class="container">
				<?php
					$grodis = implode("','",$disti);
					$sql = "select count(id) as total_enquires from suzuki_campaign_data where vertical in ('$grodis')";
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
					$sql = "select count(id) as count,response from suzuki_campaign_data where vertical in ('$grodis') group by response";
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
								<?php echo $aras; ?>
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
    </main>

    <footer id="footer">
        <div class="container">
            &copy; Copyright <strong><span>Pramaan Marketing <?php echo date('Y'); ?></span></strong>. All Rights Reserved
        </div>
    </footer>
</body>
<script src="file.js"></script>
</html>

