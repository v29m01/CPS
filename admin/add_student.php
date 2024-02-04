<?php
include('../config.php');
include('password.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $dateOfBirth = $_POST['dateOfBirth'];
    $branch = $_POST['branch'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Check if the email already exists
    $checkQuery = $con->prepare("SELECT COUNT(*) as count FROM student_table WHERE email = :email");
    $checkQuery->bindParam(':email', $email);
    $checkQuery->execute();
    $count = $checkQuery->fetch(PDO::FETCH_ASSOC)['count'];

    if ($count > 0) {
        echo "Error: Email already exists.";
    } else {
        $uploadPath = '../uploads/student_profile/';

        if (isset($_FILES['profileImage'])) {
            $profileImage = $_FILES['profileImage']['name'];
            $profileImageTmp = $_FILES['profileImage']['tmp_name'];

            move_uploaded_file($profileImageTmp, $uploadPath . $profileImage);
        } else {
            $profileImage = '';
        }

        $insertQuery = $con->prepare("INSERT INTO student_table (profile_image, name, address, phone, email, gender, date_of_birth, branch, password) VALUES (:profileImage, :name, :address, :phone, :email, :gender, :dateOfBirth, :branch, :password)");

        $insertQuery->bindParam(':profileImage', $profileImage);
        $insertQuery->bindParam(':name', $name);
        $insertQuery->bindParam(':address', $address);
        $insertQuery->bindParam(':phone', $phone);
        $insertQuery->bindParam(':email', $email);
        $insertQuery->bindParam(':gender', $gender);
        $insertQuery->bindParam(':dateOfBirth', $dateOfBirth);
        $insertQuery->bindParam(':branch', $branch);
        $insertQuery->bindParam(':password', $password);

        $result = $insertQuery->execute();

        if ($result) {
            
        } else {
            echo "Error inserting data: " . print_r($insertQuery->errorInfo(), true);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>RDTC | Add Students</title>
  <link rel="shortcut icon" href="../images/logo.png" type="image/x-icon">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.min.css">
  <link rel="stylesheet" href="../dist/css/style.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="../images/login.png" alt="AdminLTELogo" height="60" width="250">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../admin/index.php" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

     
    
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li> -->
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../admin/index.php" class="brand-link" style="color: #F37F13;" >
      <img src="../images/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text brand-text-color font-weight-dark">RDTC's SCSCOE</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">ADMIN</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

     <!-- Sidebar Menu -->
     <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
       
        <li class="nav-item">
          <a href="onboarding.php" class="nav-link">
            <i class="nav-icon fas  fa-users"></i>
            <p>Onboarding</p>
          </a>
        </li>
        <li class="nav-item">
        <a href="users.php" class="nav-link">
          <i class="nav-icon fas  fa-user"></i>
          <p>Users</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="companies.php" class="nav-link">
          <i class="nav-icon fas fa-swatchbook"></i>
          <p>Company</p>
        </a>
      </li>
      <li class="nav-item">
          <a href="drives.php" class="nav-link">
            <i class="nav-icon fas fa-table"></i>
            <p>Drives</p>
          </a>
      </li>
      <li class="nav-item">
          <a href="selected_students.php" class="nav-link">
            <i class="nav-icon fas fa-user-graduate"></i>
            <p>Selected Students</p>
          </a>
      </li>
      <li class="nav-item">
        <a href="collage_info.php" class="nav-link">
          <i class="nav-icon fas fa-user-graduate"></i>
          <p>Collage Information</p>
        </a>
    </li>
      <li class="nav-item">
          <a href="change_pass.php" class="nav-link">
            <i class="nav-icon fas fa-unlock"></i>
            <p>Change Password</p>
          </a>
      </li>
      <li class="nav-item">
          <a href="../index.php" class="nav-link">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>Log Out</p>
          </a>
        </li>
      </ul>
    </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3 class="m-0">Students</h3>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Add Students</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <!-- Your Form Goes Here -->
        <div class="card-primary" style="background-color: #ffffff;">
          <div class="card-header" style="background-color: #D34426;">
            <h3 class="card-title">Student Information</h3>
            </div>
          <div class="card-body" style="margin-bottom: 40px;">
            <form class="col-md-10" method="post" enctype="multipart/form-data">
              <!-- Profile Image Input -->
              <div class="form-group">
                <label for="profileImage">Profile Image</label>
                <input type="file" class="form-control" id="profileImage" name="profileImage" accept="image/*" >
              </div>

              <!-- Other Inputs -->
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
              </div>

              <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" name="address" required>
              </div>

              <div class="form-group">
                <label for="phone">Phone</label>
                <input type="tel" class="form-control" id="phone" name="phone" required>
              </div>

              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
              </div>

              <div class="form-group">
                <label for="gender">Gender</label>
                <select class="form-control" id="gender" name="gender">
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
                </select>
              </div>

              <div class="form-group ">
                <label for="dateOfBirth">Date of Birth</label>
                <input type="date" class="form-control" id="dob" name="dateOfBirth" required>
              </div>

              <div class="form-group">
                <label for="branch">Branch</label>
                <select class="form-control" id="branch" name="branch">
                  <option value="computer">Computer</option>
                  <option value="entc">ENTC</option>
                  <option value="mechanical">Mechanical</option>
                  <option value="civil">Civil</option>
                </select>
              </div>

              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
              </div>

              <!-- Submit Button -->
              <a href="onboarding.php"><button type="submit" class="btn btn-primary" style="background-color: #D34426;border:#D34426" value="register">Submit</button></a>
            </form>
          </div>
        </div>
        <!-- End Your Form -->

      </div>
     
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2023-2024 <a href="https://rajgad.edu.in/">RDTC</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      College Placement System
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="../plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../plugins/moment/moment.min.js"></script>
<script src="../plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.js"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../dist/js/pages/dashboard.js"></script>
</body>
</html>
