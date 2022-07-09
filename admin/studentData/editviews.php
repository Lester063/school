<?php
require_once('../../includes/connect.php');

?>
<html>
<head>
<link rel="stylesheet" href="../css/styles.css">
<script src="../../js/js.js"></script>


<title>EDIT User</title>
<style>

</style>
</head>
<body>




<div class="editstudentpageBox"id="editstudentpageBox">
<a href="javascript:void(0)"class="closebutton-addstudent"onclick="closebutton_editviews('student')">&times;</a>
<div class="error"><b id="error"></b></div>


<!--form editing user info -->
<div class="addstudent-box">
<form id="updateForm"name="updateForm"method="POST">
<table class="addData-table">
<tr><td colspan=2><b>EDIT STUDENT</b></td></tr>
<input type="hidden"value="<?Php echo $student_id?>" name="student_id" id="student_id">

<tr>
<td><label>EMAIL</label></td>
<td><input type="text" name="email"required=""id="email"placeholder="EMAIL"></td>
</tr>
<tr>
<td><label>FIRST NAME</label></td>
<td><input type="text" name="firstname"required=""id="put_firstname"placeholder="FIRST NAME"></td>
</tr>

<tr>
<td><label>MIDDLE NAME</label></td>
<td><input type="text" name="middlename"id="put_middlename"placeholder="MIDDLE NAME"></td>
</tr>


<tr>
<td><label>LAST NAME</label></td>
<td><input type="text" name="lastname"required=""id="put_lastname"placeholder="LAST NAME"></td>
</tr>
<tr>
<td><label>CONTACT NUMBER</label></td>
<td><input type="text" name="contact_number"required=""id="put_contact_number"placeholder="CONTACT_NUMBER"></td>
</tr>
<tr>
<td><label>YEAR LEVEL</label></td>
<td>
<select name="year" id="put_year">
<option value="SELECT_YEAR">SELECT YEAR</option>
<option value="11">Grade 11</option>
<option value="12">Grade 12</option>

</select>
</td>
</tr>


</table>
<button type="submit" name="submitbutton-editstudent"class="bluewhiteButton"id="submitbutton-editstudent">UPDATE</button>
</form>
</div>


</div>


</body>
</html>