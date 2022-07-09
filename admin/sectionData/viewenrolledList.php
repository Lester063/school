<?php
require_once('../../includes/connect.php');
session_start();
$getSection_id=$_GET['section_id'];
$schoolyear=$_SESSION['schoolyear'];


$sec=mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM section WHERE section_id='$getSection_id'"));
$section_course=$sec['section_course'];
$grade_year=$sec['grade_year'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="../../css/styles.css">
<script src="../../js/js.js"></script>
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="messageTo"id="messageTo"></div>
<?Php require_once('../../includes/navbar.php') ?>
<div class="wrap"id="wrap">
<div class="container">
    <div class="row mt-5">
        <h3><?php echo $sec['section_course'].$sec['yearsection']?></h3>
        <input type="hidden"value="<?php echo $sec['yearsection']?>"id="yearsection">
        <input type="hidden"value="<?php echo $sec['section_id']?>"id="sec_id">
        <input type="hidden"value="<?php echo $sec['schoolyear']?>"id="syear">
        <table class="table">
            <tr>
                <th>#</th>
                <th>Student#</th>
                <th>Full Name</th>
                <th>Action</th>
            </tr>
            <?php
            $section="SELECT en.*, u.* FROM enrollment en, users u WHERE en.student_number=u.student_number AND section_id='$getSection_id'";
            $result_section=mysqli_query($conn,$section);
            $fetch=array();
            $c=0;
            while($row=mysqli_fetch_array($result_section)){
                $c++;
                $fetch[]=$row['student_number'];
                
            ?>
            <tr id="<?php echo $row['id']?>">
                <td><?php echo $c?></td>
                <td><?php echo $row['student_number']?></td>
                <td><?php echo $row['lastname'].', '.$row['firstname'].' '.$row['middlename']?></td>
                <td><button onclick="confirm('Are you sure1?') && deleteEnrolled_student(<?php echo $row['id']?>)"class="redblackButton">Delete</button></td>

            </tr>
            <?php
            }
            ?>
        </table>
    </div>

    <div class="row mt-5">
        <h3>ADMIN: ENROLL STUDENTS</h3>
        <table class="table">
            <tr>
                <th>#</th>
                <th>Student#</th>
                <th>Full Name</th>
                <th>Action</th>
            </tr>
            <?php       
                $cc=0;


                $getPossible_enrollee="SELECT * FROM users WHERE schoolyear='$schoolyear' AND year='$grade_year' AND course='$section_course'";
                $result_getPossible_enrollee=mysqli_query($conn,$getPossible_enrollee);
                while($row_enrollees=mysqli_fetch_array($result_getPossible_enrollee)){
                    $syy=$row_enrollees['schoolyear'];
                    $sn=$row_enrollees['student_number'];
                    $check="SELECT * FROM enrollment WHERE schoolyear='$syy' AND student_number='$sn'";
                    $re_check=mysqli_query($conn,$check);
                    if(mysqli_num_rows($re_check)>0){
                    
                    
                    }else{
                        $cc++;
            ?>
            <tr id="<?php echo $row_enrollees['id']?>">
                <td><?php echo $cc?></td>
                <td><?php echo $row_enrollees['student_number']?></td>
                <td><?php echo $row_enrollees['lastname'].', '.$row_enrollees['firstname'].' '.$row_enrollees['middlename']?></td>
                <td><button onclick="confirm('Are you sure?') && adminEnroll_student(<?php echo $row_enrollees['id']?>)"class="bluewhiteButton">Enroll</button></td>
            </tr>
            <?php
                
                    }
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