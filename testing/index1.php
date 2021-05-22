<?php
date_default_timezone_set('Asia/Kolkata');
$serverName = "tcp:pramaanserver.database.windows.net,1433";
    $connectionOptions = array(
        "Database" => "pramaandb",
        "Uid" => "pramaanadmin",
        "PWD" => "Pramaan_123"
    );
   $con = sqlsrv_connect($serverName, $connectionOptions);

//$district = $_SESSION['vertical'];
   $district = 'kantipudi_eg';
   if(isset($_FILES['image'])){
      $errors= array();
      $file_name = $_FILES['image']['name'];
      $file_size = $_FILES['image']['size'];
      $file_tmp = $_FILES['image']['tmp_name'];
      $file_type = $_FILES['image']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
      $file = $_POST['pdfname'];      
      $billdate = $_POST['billdate'];
      $file_name = $file.".".$file_ext;
      echo "$file_name";
      if($file_size > 2097152) {
         $errors[]='File size must be excately 2 MB';
      }
      $location = "https://suzukimotorcycleandhra.com/campaign/uploads/$file_name";
      if(empty($errors)==true) {
         if(move_uploaded_file($file_tmp,'../uploads/'.$file_name))
         {
            $now = date('Y-m-d H:i:s');
            $sql = "insert into [billfiles] values ('$location','$district','$billdate','$now')";
            sqlsrv_query($con,$sql);
            echo "Success";
         }
      }else{
         print_r($errors);
      }
   }
?>
<html>
   <body>
      
      <form action = "" method = "POST" enctype = "multipart/form-data">
         <input type = "file" name = "image" />
         <input type="text" name='pdfname'/>
         <input type = 'date' name='billdate'/>
         <input type = "submit"/>
			
         <ul>
            <li>Sent file: <?php echo $_FILES['image']['name'];  ?>
            <li>File size: <?php echo $_FILES['image']['size'];  ?>
            <li>File type: <?php echo $_FILES['image']['type'] ?>
         </ul>
			
      </form>
      <?php
      $sql = "select * from billfiles";
          $mres=   sqlsrv_query($con,$sql);
            while($row = sqlsrv_fetch_array($mres, SQLSRV_FETCH_ASSOC)){
                     $file = basename($row['filename']);
                     echo "<a href='".$row['filename']."' download>$file</a><br>";

                  }
      ?>
   </body>
</html>