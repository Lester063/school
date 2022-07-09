<?Php
require_once('../../includes/connect.php');
session_start();

if(!isset($_SESSION['firstname'])){
	header('Location:login.php');
}
//get data from admin to filter the list just this schoolyear
$admin=mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM admin where admin_id=1"));
$adminsy=$admin['schoolyear'];

$data="SELECT s.* , u.*, e.* FROM section s, users u, enrollment e
WHERE s.section_id = e.section_id AND u.id=e.student_id AND enrollment_status='APPROVED' AND s.schoolyear='$adminsy' ORDER BY s.schoolyear DESC";
$resultData=mysqli_query($conn,$data);


?>
<html>
<head>
	<link rel="stylesheet" href="../../css/styles.css">
	<script src="../../js/js.js"></script>
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
				
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
	<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<title>View Enrolled</title>

</head>
<body>
<div class="messageTo"id="messageTo"></div>
<script>
	$( document ).ready(function() {
  var header = document.getElementById("myDIV");
  var btns = header.getElementsByClassName("colorbtn");
  for (var i = 0; i < btns.length; i++) {
    btns[i].addEventListener("click", function() {
    var current = document.getElementsByClassName("active");
    current[0].className = current[0].className.replace(" active", "");
    this.className += " active";
    });
  }

});


</script>
<?Php require_once('../../includes/navbar.php') ?>
<div class="wrap"id="wrap">
<div class="container mt-5">
<div class="col-sm-12"id="myDIV">

  <button class="colorbtn active"id="APPROVED"onclick="showEnrolee('APPROVED')">APPROVED</button>
  <button class="colorbtn"id="PENDING"onclick="showEnrolee('PENDING')">PENDING</button>



<?Php require_once('displayEnrollees.php') ?>

	</div>
</div>
</div>



</body>
</html>