<?php
    session_start();

    if(isset($_SESSION['User']))
    {
?>
<!DOCTYPE html>
<html lang="en">

<head>
<link rel="shortcut icon" href="../assets/images/logo2.png" type="image/x-icon">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>CEES Admin - Add Events</title>

  <?php include 'resources/nav.php'; ?>
  <?php include 'resources/footer.php'; ?>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">
  <?php showNavBar(); ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

<!-- Sidebar Toggle (Topbar) -->
  <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
  </button>


<!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">Add New Event</h1>
  </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->

          <form class="user" action="AdminModel/eventCreate.php" method="POST" enctype="multipart/form-data">
          
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" name="EventName" placeholder="Event Name">
                  </div>
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" name="EventLocation" placeholder="Event Location">
                  </div>
                </div>

                <div class="form-group row">
                <div class="col-sm-2">
                    <label style="float:left;">Event Date</label>
                  </div>
                  <div class="col-sm-2">
                    <input type="date" class="form-control form-control-user" name="EventDate" placeholder="Event Date">
                  </div>
                <div class="col-sm-2">
                    <label style="float:left;">Event Start Time</label>
                  </div>
                <div class="col-sm-2" style="float:left;" >
                  <input type="time" class="form-control form-control-user" name="EventStartTime" placeholder="Email Address">
                </div>
                <div class="col-sm-2">
                    <label style="float:right;">Event End Time</label>
                  </div>
                <div class="col-sm-2">
                  <input type="time" class="form-control form-control-user" name="EventEndTime" placeholder="Email Address">
                </div>
                </div>

                <div class="form-group">
                  <label for="inputDescription">Description</label>
                  <textarea class="form-control" name="inputDescription1" placeholder="Paragraph" required></textarea>
                </div>

                <div class="form-group">
                <label for="inputImage">Upload Event Flyer</label><br>
                <input type="file"  accept="image/*" name="inputImage">
                </div>

                <button type="submit" class="btn btn-primary">Add Event</button>
              </form>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <?php showFooter(); ?>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
<?php   
}
    else
    {
        header("location:login.php");
    }
?>

