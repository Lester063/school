<?php
require_once('../../includes/connect.php');
session_start();

if(!isset($_SESSION['firstname'])){
	header('Location:../../login/loginpage.php');
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="../../css/styles.css">
	<script src="../../js/js.js"></script>
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
			
	<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
				
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
	<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
<div class="messageTo"id="messageTo"></div>
<?Php require_once('../../includes/navbar.php') ?>
<div class="wrap"id="wrap">
<div class="container">
    <div class="row mt-5"id="addteacherbox">
        <div class="col-sm-6 bg-light">
            <h1>Add Teacher</h1>
            <input type="text"class="form-control mt-2" name="teacher_firstname"id="teacher_firstname"required=""placeholder="FIRST NAME">
            <input type="text"class="form-control mt-2" name="teacher_middlename"id="teacher_middlename"placeholder="MIDDLE NAME">
            <input type="text"class="form-control mt-2" name="teacher_lastname"id="teacher_lastname"required=""placeholder="LAST NAME">
            <input type="text"class="form-control mt-2" name="teacher_contactnumber"id="teacher_contactnumber"required=""placeholder="CONTACT NUMBER">
            <select class="form-select mt-2" name="teacher_userlevel"id="teacher_userlevel">
                <option value="TEACHER">TEACHER</option>
                <option value="TEACHER-ENROLLMENT">TEACHER-ENROLLMENT</option>
            </select>

            <select class="form-select mt-2" name="teacher_department"id="teacher_department">
                <option value="filipino">FILIPINO</option>
                <option value="english">ENGLISH</option>
                <option value="math">MATH</option>
                <option value="science">SCIENCE</option>
                <option value="ap">A.P</option>
            </select>

            <select class="form-select mt-2" name="teacher_rank"id="teacher_rank">
                <option value="teacher1">Teacher 1</option>
                <option value="teacher2">Teacher 2</option>
                <option value="teacher3">Teacher 3</option>
                <option value="teacher4">Teacher 4</option>
                <option value="teacherhead">Teacher Head</option>
                <option value="teacherprincipal">Teacher Principal</option>
            </select>
            <!--hidden value-->
            <button onclick="addTeacher()"type="submit" name="submit"class="bluewhiteButton mt-3"id="addTeacher">ADD</button>

        </div>

        <div class="col-sm-5 bg-light"id="teacherbox_data"style="display:none;">
        </div>
    </div>
</div>

</div>
</div>
<script>


</script>
</body>
</html>