<?Php
require_once('../includes/connect.php');
session_start();
if(!isset($_SESSION['id'])){
	header('Location:../login/loginpage.php');
}
$firstname=$_SESSION['firstname'];
$middlename=$_SESSION['middlename'];
$lastname=$_SESSION['lastname'];
$year=$_SESSION['year'];
$student_id=$_SESSION['id'];
$student_number=$_SESSION['student_number'];

$sql_info=mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM users WHERE student_number='$student_number'"));

?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <script src="../js/js.js"></script>
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
          
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
            
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>View Profile</title>
    
</head>
<body>
<?Php require_once('../includes/loadingpage.php') ?>
<?Php require_once('../includes/studentnavbar.php') ?>
<div class="studentwrapper"id="studentwrapper">
    <div class="container mt-5">

            <div class="col-sm-12" style="overflow:auto">
                <h3>PROFILE</h3>
                <table class="profileTable">
                    <tr>
                        <td colspan=2><b>Profile</b></td>
                    </tr>
                    <tr>
                        <td>Full Name:</td>
                        <td><?php echo $sql_info['firstname'].' '.$sql_info['middlename'].' '.$sql_info['lastname']?></td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td><?php echo $sql_info['email']?></td>
                    </tr>
                    <tr>
                        <td>Student#:</td>
                        <td><?php echo $sql_info['student_number']?></td>
                    </tr>
                    <tr>
                        <td>Contact#:</td>
                        <td><?php echo $sql_info['contact_number']?></td>
                    </tr>
                    <tr>
                        <td>Year:</td>
                        <td><?php echo $sql_info['year']?></td>
                    </tr>
                    <tr>
                        <td>Course:</td>
                        <td><?php echo $sql_info['course']?></td>
                    </tr>
                    <tr>
                        <td>Schoolyear:</td>
                        <td><?php echo $sql_info['schoolyear']?></td>
                    </tr>
                </table>
            </div>


    </div>
</div>


</body>
</html>