<?php
require_once('../includes/connect.php');

?>

<html>
<head>
    <link rel="stylesheet" href="../css/styles.css">
    <script src="../js/js.js"></script>
    <title>EDIT User</title>
</head>
<body>
    <div class="editviews_enrollment"id="editviews_enrollment">
        <a href="javascript:void(0)"class="closebutton-addstudent"onclick="closebutton_editviews('enrollment_status')">&times;</a>
        <div class="error"><b id="error"></b></div>
        <!--form editing user info -->
        <div class="addstudent-box">
            <form id="enrollmentstatus_form"name="enrollmentstatus_form"method="POST">
                <table>
                    <tr>
                        <td colspan=2><b>EDIT STUDENT</b></td>
                    </tr>
                    <input type="text"value="<?Php echo $student_id?>" name="student_id" id="student_id">
                    <input type="text"value="APPROVED" name="enrollment_status" id="enrollment_status">
                </table>
                <button type="submit" name="enrollment_status"class="enrollment_status"id="enrollment_status">UPDATE</button>
            </form>
        </div>
    </div>
</body>
</html>