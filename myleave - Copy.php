<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
//error_reporting(0);
if (strlen($_SESSION['uid']==0)) {
  header('location:logout.php');
  }
else{

    //get data from db to display on the table data
    $empid=$_SESSION['uid'];
    $result=mysqli_query($con, "select * from employeedetail where ID=$empid");
    $my_info= mysqli_fetch_assoc($result);
    $firstName = "{$my_info['EmpFname']}";
    $lastName = "{$my_info['EmpLName']}";
    $EmployeeCode = "{$my_info['EmpCode']}";


if(isset($_POST['request_leave_btn']))
  {
    $eid=$_SESSION['uid'];
    $startOfLeave=$_POST['startOfLeave'];
    $endOfLeave=$_POST['endOfLeave'];
    $leaveReason=$_POST['leaveReason'];
    $status = "Pending";
    
     $query=mysqli_query($con, "insert into employeeleave ( EmpID, EmpFName, EmpLName, EmpCode,  StartOfLeave, EndOfLeave,  LeaveReason, LeaveStatus)
      value('$eid','$firstName', '$lastName', '$EmployeeCode', '$startOfLeave', '$endOfLeave', '$leaveReason', '$status')");
    if ($query) {
    $msg="Your Leave Request has submitted succeesfully. Please wait till its processed.";
    header('location:myleave.php');
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

  <title>Leave Request</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

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
          <h1 class="h3 mb-4 text-gray-800">Leave Request</h1>

<p style="font-size:16px; color:green" align="center"> <?php if($msg){
    echo $msg;
  }  ?> </p>

  <?php 
$empid=$_SESSION['uid'];
$query=mysqli_query($con,"select * from employeedetail where ID=$empid");
$row=mysqli_fetch_array($query);
if($row>0) //start of if employeedetail
{

?>
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
  <tr>
    <th>Employee ID</th>
    <td><?php echo $row['ID'];?></td>
  </tr>
  <tr>
    <th>Employee First Name</th>
    <td><?php echo $row['EmpFname'];?></td>
  </tr>
  <tr>
    <th>Employee Last Name</th>
    <td><?php echo $row['EmpLName'];?></td>
  </tr>
  <tr>
    <th>Employee Code</th>
    <td><?php echo $row['EmpCode'];?></td>
  </tr>

</table>

  <?php ?>
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <th> Comment</th>
          <td style="color:green;"><?php echo "Your previous leave has been approved. See you soon after the leave." ?></td>
        </tr>
      </table>
      <h2>Enter Comment</h2>
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <th>Leave Status</th>
          <td style="color:red;"><?php echo "Sorry, Your previous leave has been disapproved due to unavoidable reasons." ?></td>
        </tr>
      </table>
      <h2>Apply Again</h2>
      <form class="user" name="register" method="post">

        <div class="form-group row">
          <div class="col-sm-6 mb-3 mb-sm-0">
            <label>Leave Start Date (mm-dd-yyyy)</label>
            <input type="date" value="<?php echo date('Y-m-d'); ?>" class="form-control form-control-user" id="StartOfLeave" name="startOfLeave" required="true">
          </div>
          <div class="col-sm-6">
          <label>Leave End Date (mm-dd-yyyy)</label>
            <input type="date" value="<?php echo date('Y-m-d'); ?>" class="form-control form-control-user" id="EndOfLeave" name="endOfLeave" required="true">
          </div>
        </div>
          <div class="form-group">
          <input type="text" class="form-control form-control-user" id="leaveReason" placeholder="Enter the reason for the leave"  name="leaveReason" required="true">
        </div>
        <div>
          <center>
            <input type="submit" name="request_leave_btn" value="Request Leave" class="btn btn-primary btn-user btn-block" style="width: 200px;">
          </center>
        </div>
      </form>
    <?php } ?>
    
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
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>
  <script type="text/javascript">
    $(".jDate").datepicker({
    format: 'yyyy-mm-dd',
    autoclose: true
}).datepicker("update", "10/10/2016"); 
  </script>
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>
</body>

</html>
<?php }  ?>
