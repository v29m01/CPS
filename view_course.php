
<?php
//code edited by Ruksar
session_start();
if($_SESSION['id']==''){
//	echo $_SESSION['Email'];
 header("Location:login.php");
}else{
	?>
	<?php


    //include_once "includes/config.php";
    error_reporting(E_ALL ^ E_NOTICE);
   
  
    ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> Admin Panel</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">


  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!--code edited by Ruksar-->
<div class="wrapper">
    
<!--header-->

<!--header-->
  <?php include('includes/header.php')  ?>
  
  
  <!-- Left side column. contains the logo and sidebar -->
 
  <?php include('includes/sidebar.php') ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
   

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         
            
               
              
                    
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">All Course Details</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
              <thead style="background-color:#3173AD; color: white;">
                                 <tr>
                                    <th>Sr. No</th>
                                   
                                   
                                    
                                   <!-- <th>Color</th>-->
                                   
                                      <th>Title</th> 
									  <th>Description</th>  
									  <th>Link</th>
                                   <th>Image</th>
                                    <th>Update</th>
                                     <th>Delete</th>
                                 </tr>
                              </thead>
                              <tbody>
	
	
	
    <?php
   include('includes/config.php');
   
	                            $sql="SELECT * FROM online_course";
										$statement=$con->prepare($sql);
										$statement->execute();
										$result=$statement->fetchAll();							
										 $cnt=1;
										foreach ($result as $row) {	?>									
										<tr>
					 <td><?php echo $cnt; ?></td>
					
					  <td><?php echo $row['title']; ?></td>
					  <td><?php echo $row['description']; ?></td>
					  <td><?php echo $row['link']; ?></td>
					  <td><img src="<?php echo $row['image']; ?>" width="100px" height="100px"></td>
					
			
					  <td>
 <a href="update_course.php?id=<?php echo $row['id'];?>"><span class="glyphicon glyphicon-pencil" style="font-size:20px;color:green"></span></a>


<td align="center"><a onclick="return confirm('Are you sure you want to delete this page?')" href="delete.php?id=<?php echo $row['id']; ?>&table=online_course&return=view_course.php"> <span class="fa fa-trash-o" style="font-size:20px;color:red"></span> </a></td>
                                                                
</td>
										</tr>
										<?php $cnt=$cnt+1; } ?>
							   </tbody>
              </table>
			  
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
	 
    </section>
    <!-- /.content -->
	 <!-- Main content -->
      </div>
  <!-- /.content-wrapper -->
  
<!--footer-->
  <?php  include('includes/footer.php') ?>

 
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>

</body>

</html>
<?php
	}
	
	?>



