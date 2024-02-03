<?Php
require_once('../../includes/connect.php');
session_start();
$message = false;	
$id = false;
if(!isset($_SESSION['firstname'])) {
	header('Location:../../login/loginpage.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/styles.css">
	<script src="../../js/js.js"></script>
    <title>Add Student</title>
</head>
<body>
    <div class="messageTo"id="messageTo"></div>
    <?Php require_once('../../includes/navbar.php') ?>
    <?Php require_once('editviews.php') ?>
    <div class="wrap"id="wrap">
        <div class="container mt-5">
            <div class="row">
                <div class="col-sm-6">
                    <h3>ADD STUDENT</h3>
                    <form id="userForm"method="POST"name="userForm">
                        <input type="text" name="firstname"id="firstname"required=""placeholder="FIRST NAME"class="form-control mt-2">
                        <input type="text" name="middlename"id="middlename"placeholder="MIDDLE NAME"class="form-control mt-2">
                        <input type="text" name="lastname"id="lastname"required=""placeholder="LAST NAME"class="form-control mt-2">

                        <select name="course"id="course"required=""class="mt-2">
                            <option value="">SELECT COURSE</option>
                            <?php
                            $sqlcourses=mysqli_query($conn,"SELECT * FROM courses");
                            while($row=mysqli_fetch_array($sqlcourses)){
                            ?>
                            <option value="<?php echo $row['course_name']?>"><?php echo $row['course_name']?></option>
                            <?php
                            }
                            ?>
                        </select>

                        <input type="text" name="contact_number"id="contact_number"required=""placeholder="CONTACT NUMBER"class="form-control mt-2">

                        <select name="year"id="year"class="mt-2">
                            <option value="">Year Level</option>
                            <option value="11">Grade 11</option>
                            <option value="12">Grade 12</option>
                            <option value="Graduate">Graduate</option>
                        </select>
                        <br>

                        <button type="submit" name="submit"class="bluewhiteButton mt-3"id="addbutton">ADD</button>
                    </form>
                </div>

                <div class="col-sm-5 bg-light"id="studentbox_data"style="display:none;"></div>
            </div>
        </div>
    </div>
</body>
</html>