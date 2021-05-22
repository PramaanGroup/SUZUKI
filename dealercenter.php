<?php
/*
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
} */
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
       <div class="row">
			
		<?php
      		$sql = "select * from billfiles";
          $mres=   sqlsrv_query($con,$sql);
            while($row = sqlsrv_fetch_array($mres, SQLSRV_FETCH_ASSOC)){
                     $file = basename($row['filename']); ?>
                     <div class="col-sm-12 col-md-4 col-lg-3">
                     <?php echo "<a href='".$row['filename']."' download>$file</a><br>"; ?>
                     </div>

                <?php }
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