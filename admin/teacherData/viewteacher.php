<?Php
require_once('../../includes/connect.php');
session_start();
$message=false;	
$id=false;
if(!isset($_SESSION['firstname'])){
	header('Location:../../login/loginpage.php');
}






?>
<html>
<head>

	<link rel="stylesheet" href="../../css/styles.css">
	<script src="../../js/js.js"></script>
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
			
	<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
				
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
	<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<title>View Teacher</title>

</head>
<body>
<div class="messageTo"id="messageTo"></div>
<?Php require_once('../../includes/navbar.php') ?>
<?Php require_once('editteacher.php') ?>

<div class="wrap"id="wrap">
<div class="container mt-5">
	<div class="col-sm-12">
	<h3>ADVISORY</h3>

				<p><?Php echo $message?></p>
				<div class="deletemessage"id="deletemessage"style="display:none;"></div>
				<a href="addteacherblade.php"class="bluewhitebutton"style="text-decoration:none;">Add Teacher</a>

				<select id="selectDepartment" class="selectDepartment"name="selectDepartment">
				<option value="all">All</option>
				<option value="filipino">Filipino</option>
				<option value="english">English</option>
				<option value="math">Math</option>
				<option value="science">Science</option>
				<option value="ap">AP</option>
				</select>

				<select id="selectTeacher_rank" class="selectTeacher_rank"name="selectTeacher_rank">
				<option value="teacher"selected="selected">All</option>
				<option value="teacher1">Teacher 1</option>
				<option value="teacher2">Teacher 2</option>
				</select>
				<input type="text" name="searchTeacher"class="searchTeacher"id="searchTeacher"placeholder="Search for last name."style="width:185px;">

				<?php require_once('displayTeachers.php')?>


	</div>
</div>
</div>


</body>
</html>