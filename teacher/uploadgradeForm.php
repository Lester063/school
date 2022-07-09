<?Php




$sql_adviser='SELECT * FROM users WHERE userlevel ="TEACHER"';
$result_adviser=mysqli_query($conn,$sql_adviser);
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
    <title>View Sections</title>
    
</head>
<body>








<div class="openUpload"id="openUpload">
<a href="javascript:void(0)"class="closebutton-addstudent"onclick="closeThis()">&times;</a>
<p>UPLOAD GRADES</P>

<form method="POST" action="uploadfileExcel.php"enctype="multipart/form-data">
        
		<div class="form-group">
			<label>Upload Excel File</label>
			<input type="file" name="excel" class="form-control"required>
            <input type="hidden" name="teacher_id"value="<?php echo $teacher_id?>">

			<input type="hidden" name="section_id"id="section_id">

			<input type="hidden" name="subject_id"value=<?php echo $_GET['subject_id']?>>

			<input type="hidden" name="schoolyear"value="<?php echo $schoolyear?>">
		</div>
		<div class="form-group">
			<button type="submit" name="import" class="bluewhiteButton mt-3"onclick="uploadGrades()">Upload</button>
		</div>
	</form>



</div>
<script>
function closeThis(){
	document.getElementById('openUpload').style.display="none";
}
</script>
</body>
</html>