<?Php
require_once('../../includes/connect.php');
$admin_id=$_SESSION['admin_id'];
$schoolyear=$_SESSION['schoolyear'];

$sql_adviser='SELECT * FROM users WHERE userlevel ="TEACHER"';
$result_adviser=mysqli_query($conn,$sql_adviser);

$sql=mysqli_fetch_assoc(mysqli_query($conn, "SELECT schoolyear FROM `admin` WHERE admin_id=$admin_id"));
$sqlcourses=mysqli_query($conn,"SELECT * FROM courses");
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="../../css/styles.css">
    <title>View Sections</title>

</head>
<body>








<div class="addSectionform"id="addSectionform">
<a href="javascript:void(0)"class="closebutton-addstudent"onclick="closebutton_addstudent('addsection')">&times;</a>
<p>ADD SECTION</P>
<form id="addsectionForm"name="addsectionForm" method="POST">
    <input type="hidden"name="action"value="action_addSection">
<table class="addData-table">
    <input type="text" id="num_section_select"value="1">
<input type="button" onclick="addselectSection()"value="add">
    <input type="hidden" name="schoolyear"id="schoolyear"value="<?php echo $sql['schoolyear']?>">
    
    
<div class="addsection_select">
    <select name="grade_year"id="grade_year"required="">
        <option value="">Select Year</option>
        <option value="11">Grade 11</option>
        <option value="12">Grade 12</option>
    </select>

    <select name="section"id="section"required="">
        <option value="">Select Section</option>
        <option value="A">A</option>
        <option value="B">B</option>
        <option value="C">C</option>
        <option value="D">D</option>
        <option value="E">E</option>
        <option value="F">F</option>
    </select>

</div> 
<div class="boxSection">
    <select name="section_subject[]"id="addsection_select"class="addsection_select"required="">
        <?php
        $loopsubject="SELECT * FROM subject";
        $result_loopsubject=mysqli_query($conn,$loopsubject);
        while($row_subject=mysqli_fetch_array($result_loopsubject)){
        ?>
        <option value="<?php echo $row_subject['subject_id']?>"name="section_subject[]"><?php echo $row_subject['subject']?></option>
        <?php
        }
        ?>
    </select>
</div>







<tr>

    <td>
    <select name="section_course"id="section_course"required style="width:160px">
    <option value="">SELECT COURSE</option>
    <?php
while($row=mysqli_fetch_array($sqlcourses)){
?>
<option value="<?php echo $row['course_name']?>"><?php echo $row['course_name']?></option>
<?php
}
?>
    </select>
    </td>
    <td><input type="text" name="max_qty"id="max_qty"placeholder="Enter maximum student"required=""></td>
</tr>
<tr>
    <td>Start Date</td>
    <td><input type="datetime-local" name="start_date"id="start_date"required=""></td>
</tr>
<tr>
    <td>End Date</td>
    <td><input type="datetime-local" name="end_date"id="end_date"required=""></td>
</tr>


</table>
<button type="submit" onclick="addSec()"name="addsectionbutton"class="submitbutton-addsection"id="addsectionbutton">ADD SECTION</button>
</form>


</div>
</body>
</html>