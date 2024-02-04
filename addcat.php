<?php
session_start();
if($_SESSION['id']==''){
//	echo $_SESSION['Email'];
 header("Location:login.php");
}else{
	?>

<?php

include ('includes/config.php');

//check_login();
if(isset($_POST['submit']))
{
$categoryname=$_POST['categoryname'];
//$color=$_POST['color1'];
//$color="#".$_POST['color1'];
    $query = $con->prepare("SELECT categoryname FROM category WHERE categoryname = '$categoryname' ");
			$query->execute();
					 
					  $n = $query->fetchColumn();
	if($n>1)
	{
      echo "<script>alert('Category already exist');</script>";
    } 
    else
    {
                
		
		
	$statement = $con->prepare("insert into category(categoryname) values('$categoryname')");
	$query=$statement->execute([$categoryname]);

		
		
        if($query)
        {
        	echo "<script>alert('Main Menu created successfully');</script>";
        }
        else
        {
        	echo "<script>alert('Something went wrong please try again.');</script>";
        }
    }
}
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
        
        <div class="col-md-6">
          <!-- Horizontal Form -->
        
          <!-- /.box -->
          <!-- general form elements disabled -->
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Add Menu</h3>
	 
            </div>
			
            <!-- /.box-header -->
            <div class="box-body">
		
               <form action="" role="form" id="submit" method="post" enctype="multipart/form-data">
                                    <div class="box-body">
                                       <div class="form-group">
                                          <label for="name">Menu Name</label>
                                          <input type="text" class="form-control" id="categorytitle" name="categoryname" placeholder="Create Main Menu name"   title="Enter name in string" required>
                                       </div>
                                      

                                    </div>
                                    <!-- /.box-body -->
                                    <div class="box-footer">
                                       <button type="submit" name="submit" class="btn btn-primary">submit</button>
                                    </div>
                                    
                                 </form>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
		<div class="col-md-6">
		               <div class="box box-info">
                                 <div class="row">
                                    <!-- left column -->
                                    <!-- right column -->
                                    <div class="col-md-12">                                 
									   <div class="box-header">
                              <h3 class="box-title">All Main Menu</h3>
                           </div>
                            <!--<div class="box-footer">-->
                            <!--           <button type="submit" name="export" class="btn btn-primary">Export</button>-->
                            <!--        </div>-->
                                    
                           
                           
									<div class="box-body">    
                           <table id="example1" class="table table-bordered table-striped">
                              <thead style="background-color:#3173AD; color: white;">
                                 <tr>
                                    <th>Sr. No</th>
                                    <th>Menu Name</th>
                                    
                                
                                    <th>Update</th>
                                     <th>Delete</th>
                                 </tr>
                              </thead>
                               <tbody>
							   <?php 
		 //$query = mysql_query("SELECT * FROM category ORDER BY id DESC");
                           //$cnt=1;
       //while($row = mysql_fetch_array($query))
//{
	
	
	
	
		$sql = "SELECT * FROM category ORDER BY id DESC";
										$statement = $con->prepare($sql);
										$statement->execute();
										$result = $statement->fetchAll();							
										 $cnt=1;
										foreach ($result as $row) {
?>									
										<tr>
						 <th><?php echo $cnt; ?></th>
					 <td><?php echo $row['categoryname']; ?></td>
					  
					  
											
 <td><a href="update_cat.php?id=<?php echo $row['id'];?>"><span class=" glyphicon glyphicon-pencil"></span></a>&nbsp;&nbsp;
<td align="center"><a onclick="return confirm('Are you sure you want to delete this Category?')" href="delete.php?id=<?php echo $row['id']; ?>&table=category&return=addcat.php&im=<?php echo $row['image']; ?>"><span class="fa fa-trash-o"></span></a></td>
                                                                
</td>
										</tr>
										<?php $cnt=$cnt+1; } ?>
							   </tbody>
                           
                              
                           </table>
                       </div>
                           </div>
                        </div>
                     </div>
		
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