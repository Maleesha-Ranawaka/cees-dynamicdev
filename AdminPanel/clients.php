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

  <title>CEES Admin - Manage Clients</title>

  <?php include 'resources/nav.php'; ?>
  <?php include 'resources/footer.php'; ?>

  <!-- including the database connection  -->
  <?php include '../Model/dbh.inc.php'; ?>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <script src="../assets/customjs/sweetalert2.all.min.js"></script>
</head>

<body id="page-top">
  <?php
    $newConnection= new dbh;
    $conn=$newConnection->connect();
    
    
  ?>
  <!-- Page Wrapper -->
  <div id="wrapper">
  <?php showNavBar(); ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">
        <!-- End of Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

        <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>


        <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Add / Update Clients</h1>
        </nav>
        <!-- Begin Page Content -->
        <div class="container-fluid">

            <section>
            <label for="">Add a New Client</label>
            <hr>
                <form method="POST" action="./AdminModel/clientlogo.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="inputImage">Upload Client logo (Please upload only png files)</label><br>
                        <input type="file"  accept="image/*" name="inputImage">
                    </div>

                    <button type="submit" class="btn btn-primary">Add Client</button>
                </form>
            </section>
            <br><br><br>
            <section>
              <label for="">Remove Clients</label>
              <hr>
              <form action="">
                <?php
                $sql="SELECT * FROM clients WHERE status=1";
                $result=$conn->query($sql);
                $numRows=$result->num_rows;
                $target_dir = "../";
                if($numRows>0){
                while($row=$result->fetch_assoc()){
                  echo("
                  <div id=" .$row['idclients'] . " name='img_container'>
                    <input type=\"hidden\" name=\"inputId\" value=" . $row['imageUrl']. ">
                    <img src=".$target_dir.$row['imageUrl']." alt='..' class='img-thumbnail' style=' max-height: 150px'>
                    <button type=\"button\" onclick=\"removeImg(" .$row['idclients'] .")\" name=\"img_remove\" class=\"btn btn-outline-danger\" > Remove client </button>
                  </div>
                  <br>
                  ");
                  }
                }
                ?>
              </form>
            </section>

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

  <script>
    function removeImg(imgId){
      Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
      if (result.value) {
        $.ajax({
          type:'POST', 
          url: "./AdminModel/deleteclients.php",
          data: {img_remove: imgId, req:'imgRemove'},
          success: function(){
          },
          error: function(){
          }
        });
        Swal.fire(
          'Deleted!',
          'Your file has been deleted.',
          'success'
        ).then( function(){
          window.location.reload();
        });
   
    
  }

})
    }
  
  </script>
</body>

</html>
<?php   
}
    else
    {
        header("location:login.php");
    }
?>

