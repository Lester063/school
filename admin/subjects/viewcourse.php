<?Php
require_once('../../includes/connect.php');
session_start();

?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="../../css/styles.css">
    <script src="../../js/js.js"></script>
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
          
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
            
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>



    <title>View Sections</title>
    
</head>
<body>
<div class="messageTo"id="messageTo"></div>
<div class="deletemessage"id="deletemessage"></div>
<script>

</script>
<?Php require_once('../../includes/navbar.php') ?>

<div class="wrap"id="wrap">
<div class="container mt-5">
	<div class="col-sm-12">
        <input type="text" name="newCourse" id="newCourse" placeholder="Enter new Course Name" required="">
        <input type="text" name="courseDescription" id="courseDescription" placeholder="Enter Course Description"required="">
        <button type="button"class="bluewhiteButton"id="addCourse_button"onclick="addCourse_button()">Add</button><br>
        </div>
    </div>

    <div class="col-sm-12">
    <table class="table">
        <tr>
            <td>#</td>
            <td>Course Name</td>
            <td>Course Description</td>
            <td>Action</td>
        </tr>
        <?php 
        $cc=0;
        $sqlgetcourse=mysqli_query($conn,"SELECT * FROM courses");
        while($row=mysqli_fetch_array($sqlgetcourse)){
            $cc++;
        ?>
        <tr id="<?php echo $row['course_id']?>">
            <td><?php echo $cc?></td>
            <td><?php echo $row['course_name']?></td>
            <td><?php echo $row['course_description']?></td>
            <td><button onclick="confirm('are you sure?') && deleteCourse(<?php echo $row['course_id']?>)"class="redblackButton">Delete</button></td>
        </tr>

        <?php
        }
        ?>
       </table>
    </div>


</div>
</div>
<script>

</script>
</body>
</html>