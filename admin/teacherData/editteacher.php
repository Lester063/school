<?php
require_once('../../includes/connect.php');

$sql_section = 'SELECT yearsection FROM section';
$result_section = mysqli_query($conn, $sql_section);
?>

<html>
<head>
    <link rel="stylesheet" href="../../css/styles.css">
    <script src="../../js/js.js"></script>
    <title>EDIT TEACHER</title>
</head>
<body>
    <div class="editteacherbox"id="editteacherbox">
        <a href="javascript:void(0)"class="closebutton-addstudent"onclick="closebutton_editviews('teacher')">&times;</a>
        <div class="error"><b id="error"></b></div>


        <!--form editing user info -->
        <div class="addstudent-box">
            <form id="updateTeacher"name="updateTeacher"method="POST">
                <table class="addData-table">
                    <tr>
                        <td colspan=2><b>EDIT TEACHER</b></td>
                    </tr>
                    <input type="text"value="<?Php echo $teacher_id?>" name="teacher_id" id="put_teacher_id">

                    <tr>
                        <td><label>EMAIL</label></td>
                        <td><input type="text" name="teacher_email"required=""id="put_teacher_email"placeholder="EMAIL"></td>
                    </tr>

                    <tr>
                        <td><label>FIRST NAME</label></td>
                        <td><input type="text" name="teacher_firstname"required=""id="put_teacher_firstname"placeholder="FIRST NAME"></td>
                    </tr>

                    <tr>
                        <td><label>MIDDLE NAME</label></td>
                        <td><input type="text" name="teacher_middlename"id="put_teacher_middlename"placeholder="MIDDLE NAME"></td>
                    </tr>


                    <tr>
                        <td><label>LAST NAME</label></td>
                        <td><input type="text" name="teacher_lastname"required=""id="put_teacher_lastname"placeholder="LAST NAME"></td>
                    </tr>

                    <tr>
                        <td><label>CONTACT NUMBER</label></td>
                        <td><input type="text" name="teacher_contactnumber"required=""id="put_teacher_contactnumber"placeholder="CONTACT_NUMBER"></td>
                    </tr>

                    <tr>
                        <td><label>USERLEVEL</label></td>
                        <td>
                            <select name="teacher_userlevel"id="put_teacher_userlevel">
                                <option value="TEACHER">TEACHER</option>
                                <option value="TEACHER-ENROLLMENT">TEACHER-ENROLLMENT</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label>DEPARTMENT</label></td>
                        <td>
                            <select name="teacher_department"id="put_teacher_department">
                                <option value="filipino">FILIPINO</option>
                                <option value="english">ENGLISH</option>
                                <option value="math">MATH</option>
                                <option value="science">SCIENCE</option>
                                <option value="ap">AP</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td><label>Teacher Rank</label></td>
                        <td>
                            <select name="teacher_rank"id="put_teacher_rank">
                                <option value="teacher1">Teacher 1</option>
                                <option value="teacher2">Teacher 2</option>
                                <option value="teacher3">Teacher 3</option>
                                <option value="teacher4">Teacher 4</option>
                                <option value="teacherhead">Teacher Head</option>
                                <option value="teacherprincipal">Teacher Principal</option>
                            </select>
                        </td>
                    </tr>
                </table>
                <button type="submit" name="submitbutton-editteacher"class="bluewhiteButton submitbutton-editteacher"id="submitbutton-editteacher">UPDATE TEACHER</button>
            </form>
        </div>


    </div>
</body>
</html>