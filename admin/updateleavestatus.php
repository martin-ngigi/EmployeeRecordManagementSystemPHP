<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
//error_reporting(0);
if (strlen($_SESSION['aid']==0)) {
  header('location:logout.php');
  } else{

  //get data from db to display on the table data
  // $empid=$_GET['editid'];
  // $result=mysqli_query($con, "select * from employeeleave where EmpID=$empid");
  // $my_info= mysqli_fetch_assoc($result);
  // $firstName = "{$my_info['EmpFname']}";
  // $lastName = "{$my_info['EmpLName']}";
  // $EmployeeCode = "{$my_info['EmpCode']}";


if(isset($_POST['update_btn']))
  {
    $eid=$_GET['editid'];
    $status=htmlspecialchars($_POST['statusDD']);

    // "select * from employeeleave where EmpID=$empid AND ID=(SELECT max(id) FROM employeeleave)"
     $query=mysqli_query($con, "update employeeleave SET LeaveStatus='$status' where EmpID=$eid AND ID=(SELECT max(ID) FROM employeeleave)");
    if ($query) {
    $msg="Status has been updated succeesfully.";
  }
  else
    {
      $msg="Something Went Wrong. Please try again.";
    }
  }
  ?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Update Leave Status</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
  <?php include_once('includes/sidebar.php')?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
         <?php include_once('includes/header.php')?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Update Leave Status</h1>

<p style="font-size:16px; color:green" align="center"> <?php if($msg){
    echo $msg;
  }  ?> </p>

<?php 
$empid=$_GET['editid'];
$query=mysqli_query($con,"select * from employeeleave where EmpID=$empid AND ID=(SELECT max(ID) FROM employeeleave)");
$row=mysqli_fetch_array($query);
if($row>0) //start of if employeedetail
{

?>
<form action="#" method="POST">
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
  <tr>
    <th>Employee ID</th>
    <td><?php echo $row['EmpID'];?></td>
  </tr>
  <tr>
    <th>Employee First Name</th>
    <td><?php echo $row['EmpFName'];?></td>
  </tr>
  <tr>
    <th>Employee Last Name</th>
    <td><?php echo $row['EmpLName'];?></td>
  </tr>
  <tr>
    <th>Employee Code</th>
    <td><?php echo $row['EmpCode'];?></td>
  </tr>
  <tr>
    <th>Start Of Leave</th>
    <td><?php echo $row['StartOfLeave'];?></td>
  </tr>
  <tr>
    <th>End Of Leave</th>
    <td><?php echo $row['EndOfLeave'];?></td>
  </tr>
  <tr>
    <th>Leave Reason</th>
    <td><?php echo $row['LeaveReason'];?></td>
  </tr>
  <tr>
    <th>Leave Status</th>
    <td><?php echo $row['LeaveStatus'];?></td>
  </tr>

</table>
<?php } ?>

<label>Update Status</label>
<div >
    <div class="adm_int">
    <select name="statusDD" class="input_deg">
        <option value="Pending">Pending</option>
        <option value="Approved">Approved</option>
        <option value="Disapproved">Disapproved</option>
      </select> 
  </div>
</div>

<div class="row" style="margin-top:4%">
  <div class="col-4"></div>
  <div class="col-4">
  <input type="submit" name="update_btn"  value="Update" class="btn btn-primary btn-user btn-block">
</div>
</div>
</form>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
   <?php include_once('includes/footer.php');?>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  

  <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin-2.min.js"></script>
  <script type="text/javascript">
    $(".jDate").datepicker({
    format: 'yyyy-mm-dd',
    autoclose: true
}).datepicker("update", "10/10/2016"); 
  </script>

</body>

</html>
<?php }  ?>
