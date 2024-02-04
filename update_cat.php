<?php
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
	date_default_timezone_set('Asia/Kolkata');
	$date=date("y/m/d");
	$categoryname=$_POST['categoryname'];
//$subcategoryname=$_POST['subcategoryname'];
//$subpartname=$_POST['subpartname'];
// $description=$_POST['description'];
//$title=$_POST['title'];


	//$query=mysql_query("UPDATE `product` SET  `cat`='$cat', `title`='$name', `description`='$description', `date`='$date' where id=".$_GET['id']."");
	
	$statement=$con->prepare("UPDATE `category` SET  `categoryname`='$categoryname' where id=".$_GET['id']." ");
	$query=$statement->execute();
	
	if($query)
	{
		echo "<script>alert(' Main Menu Successfully Updated');</script>";
	}
	else
	{
		echo "<script>alert('Something went wrong please try again.');</script>";
	}

}

if(isset($_POST['image']))
{
	date_default_timezone_set('Asia/Kolkata');
	$date=date("y/m/d");
	
	 $mydomain="admin/";
									
			$file_name = $_FILES['image']['name'];	
			$temp_name = $_FILES['image']['tmp_name'];
                                 
             move_uploaded_file($temp_name,"upload/category/".$file_name);
                $url= $mydomain."upload/category/".$file_name;

	//$query=mysql_query("UPDATE `product` SET  `uploadImage`='$url' where id=".$_GET['id']."");
	
	$statement=$con->prepare("UPDATE `category` SET  `image`='$url' where id=".$_GET['id']." ");
	$query=$statement->execute();
	
	if($query)
	{
		echo "<script>alert('Main Menu Image Successfully Updated');</script>";
	}
	else
	{
		echo "<script>alert('Something went wrong please try again.');</script>";
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
	  <?php 
       $sql="select * from category where id='".$_GET['id']."'";
										$statement = $con->prepare($sql);
										$statement->execute();
										$result = $statement->fetchAll();							
										foreach ($result as $row) {	?>
					
					
        <form action="" role="form" id="submit" method="post" enctype="multipart/form-data">
        <div class="col-md-12">
          <!-- Horizontal Form -->
        
         
          <!-- general form elements disabled -->
          <div class="box box-warning">
           
			  <div class="box-header with-border">
              <h3 class="box-title">Update Main Menu</h3>
<div class="pull-right">
    <a href="addcat.php" class="btn btn-info" role="button">All Main Menu</a>
	</div>        
		   </div>
            <!-- /.box-header -->
            <div class="box-body">
		
                                 
                                    <div class="box-body">
                        
                                       <div class="form-group">
                                          <label for="name">Main Menu Name</label>
                                          <input type="text" class="form-control" id="subpartname" name="categoryname" title="Enter name in string" value="<?php echo htmlentities($row['categoryname']);?>"   placeholder="Enter Mini Category Name"required>
                                       </div>
                                       
					               
								
								
								 
                                    </div>
                                    <!-- /.box-body -->
                                    <div class="box-footer">
                                       <button type="submit" name="submit" class="btn btn-primary">Update</button>
                                    </div>
                                
                               
            </div>
            <!-- /.box-body -->
          </div>
		   </form>
													<?php }?>
          <!-- Horizontal Form -->
        
          <!-- /.box -->
          <!-- general form elements disabled -->
          
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
<!--keyboard-->
<script type="text/javascript" src="https://code.jquery.com/jquery-1.7.min.js"></script>
<script type="text/javascript" src="try/dist_text_editor/cazary.min.js"></script>
<script src="bower_components/ckeditor/ckeditor.js"></script>
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  })
</script>
</body>
</html>
<?php  } ?>