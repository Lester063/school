<?Php
require_once('../../includes/connect.php');
session_start();
$message = false;	
$id = false;
if(!isset($_SESSION['firstname'])) {
	header('Location:../../login/loginpage.php');
}

if(isset($_POST['deletebutton'])) {
	$sql = "DELETE FROM users WHERE id=50";
}

$sql_user = 'SELECT * FROM users WHERE userlevel = "Student" ORDER BY status ASC';
$result_user = mysqli_query($conn, $sql_user);

if(isset($_GET['submituser'])) {
	$sql_user = "SELECT * FROM users WHERE 
	lastname LIKE '%".$_GET['search']."%'
	OR
	firstname LIKE '%".$_GET['search']."%'";
}
$result_user = mysqli_query($conn, $sql_user);

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
	<title>View Students</title>
</head>
<body>
	<div class="messageTo"id="messageTo"></div>
	<?Php require_once('../../includes/navbar.php') ?>
	<?Php require_once('editviews.php') ?>
	<div class="wrap"id="wrap">
		<div class="container mt-5">
			<div class="col-sm-12">
				<h3>VIEW STUDENT</h3>
				<p><?Php echo $message?></p>
				<a href="addStudent_view.php"class="bluewhiteButton"style="text-decoration:none;">Add Student</a>
				<select id="selectYear" class="selectYear"name="selectYear">
					<option value="all">Year</option>
					<option value="11">Grade 11</option>
					<option value="12">Grade 12</option>
				</select>
				<input type="text" name="searchStudent"class="searchStudent"id="searchStudent"placeholder="Search for last name.">

				<?Php require_once('displayStudent.php') ?>
			</div>
		</div>
	</div>
</body>
</html>