<?php
//code edited by Ruksar
session_start();
if($_SESSION['id']==''){
//	echo $_SESSION['Email'];
 header("Location:login.php");
}else{
	?>

<?php

//session_start();
include('includes/config.php');
//include('includes/checklogin.php');
//check_login();
if(isset($_POST['submit']))
{


$name = $_POST['name'];

$mydomain="";
      $file_name = $_FILES['pdf']['name'];	
	  $temp_name = $_FILES['pdf']['tmp_name'];                 
      $url= "upload/paper_pdf/".$file_name;
	   move_uploaded_file($temp_name,$url);

$statement=$con->prepare("INSERT INTO `q_pdf`(`id`,`name`,`pdf`) VALUES (NULL,'$name','$url')");
		$query=$statement->execute([$name,$url]);

if($query)
{
	echo "<script>alert('Data are saved successfully');</script>";

}
else
{
	echo "<script>alert('something gose wrong');</script>";
}
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin Panel</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  
  

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!--code edited by Ruksar-->
<div class="wrapper">

  <?php include('includes/header.php')?>
  <!-- Left side column. contains the logo and sidebar -->
  <?php include('includes/sidebar.php') ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
   

    <!-- Main content -->
    <section class="content">
      <div class="row">
        
        <div class="col-md-6">
          <!-- Horizontal Form -->
        
          <!-- /.box -->
          <!-- general form elements disabled -->
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Add Paper</h3>
            </div>
			
            <!-- /.box-header -->
            <div class="box-body">
            <form role="form" name="form1" method="post" enctype="multipart/form-data" action="" >
                <!-- text input -->
               

				
				<div class="form-group">
                  <label>Name</label>
                     <input class="form-control" name="name" type="text" id="name"  class="validate[required,length[0,100]] text-input">
                </div>
               
			   <div class="form-group">
                  <label>PDF</label>
                     <input class="form-control" name="pdf" type="file" id="pdf"  >
                </div>
               
               
			   <div class="box-footer">
			   <button type="submit" name="submit" class="btn btn-primary">Submit </button>
            
                 </div>
               

              </form>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 <?php include('includes/footer.php') ?>

  <!-- Control Sidebar -->
  
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="build/js/jscolor.js"></script>
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<?php }?>
</body>
</html>

