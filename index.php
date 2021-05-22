<?php

session_start();
date_default_timezone_set('Asia/Kolkata');
if(isset($_SESSION['username']))
{
	if($_SESSION['username'] == 'Pramaan' ||$_SESSION['username'] == 'Anwar Baig' || $_SESSION['username'] == 'Jeevagan' || $_SESSION['username'] == 'Makesh' || $_SESSION['username'] == 'Arun Kumar' )
	{	
		header('location : admindashboard.php');
	}
	else
	{
		header('location : dashboard.php ');
	}
}	
else
{
		session_unset();
		session_destroy();
	}

 ?>

<!doctype html>
<html lang="en">
<head>
    <title>Suzuki- Motor Cycles</title>
    <link rel="shortcut icon" type="image/png" href="suzukifavicon.jpg">
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="campaign.css">
</head>

<body>
    <header id="header" class="fixed-top">
      <div class="container d-flex header-box">
        <div class="logo">
            <a href="#"><img src="campaignmarketing.png" width="50%" alt="logo" class="img-fluid"></a>
        </div><div class="logo">
            <a href="#"><img src="marketinglogo.png" alt="logo" class="img-fluid"></a>
        </div>
      </div>
    </header><!-- End Header -->
    <main class="d-flex align-items-center">
        <div class="container section">
            <div class="row">
                <div class="col-sm-12 col-md-6 py-4 d-flex align-items-center justify-content-center">
                    <div class="">
                        <form action= "login.php" method ="POST">
                            <div class="mb-3">
                                <input class="form-control" type='text' name ="username" placeholder ='Username' value = "<?php if(isset($_POST['username'])){echo $_POST['username'];}?>" required />
                            </div>
                            <div class="mb-3">
                                <input class="form-control" type='password' name = "password" placeholder= 'Password' required/>
                            </div>
                            
                            <div class ="error">
                                <p><?php  if(isset($_REQUEST['lm'])){echo base64_decode($_REQUEST['lm']);}?></p>
                            </div>
                            <div class="text-center">
                                <input class="btn btn-primary btn-submit" type = 'submit' name = 'submit' />
                            </div>           
                        </form>
                    </div>
                </div>

                <div class="col-sm-12 col-md-6 py-4">
                  <img src="600logo.png" alt="image" width="100%">
					
				<h3 class="text-center pt-1" style="color: #b1c7cf">Andhra Pradesh</h3>
                </div>
            </div>
        </div>
    </main>
    <footer id="footer">
    <div class="container">
    &copy; Copyright <strong><span>Pramaan Marketing <?php echo date('Y'); ?></span></strong>. All Rights Reserved
    </div>
    </footer>
</body>
</html>