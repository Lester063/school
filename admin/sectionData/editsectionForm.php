
<?php
require_once('../../includes/connect.php');

?>
<html>
<head>
    <link rel="stylesheet" href="../css/styles.css">
    <title>EDIT User</title>
</head>
<body>
    <div class="updateSection"id="updateSection">
        <a href="javascript:void(0)"class="closebutton-addstudent"onclick="closebutton_editviews('editsection')">&times;</a>
        <div class="error"><b id="error"></b></div>

        <div class="addstudent-box">
            <form id="updatesectionForm"name="updatesectionForm"method="POST"class="updatesectionForm">
                <table class="addData-table">
                    <tr>
                        <td colspan=2><b>EDIT SECTION</b></td>
                    </tr>
                    <input type="hidden" name="action" value="action_updateSection">
                    <td><input type="hidden" name="editsection_id"id="editsection_id"placeholder="SY(eg.2022-2023)"required="">
                    <td><input type="hidden" name="editsection_schoolyear"id="editsection_schoolyear"placeholder="SY(eg.2022-2023)"required="">

                    <tr>
                        <td>YearSection</td>
                        <td><input type="text" name="editsection_yearsection"id="editsection_yearsection"placeholder="YEARSECTION(eg.4A 1A 1B)"required=""></td>
                    </tr>

                    <tr>
                        <td>Student Quantity</td>
                        <td><input type="text" name="editsection_qty"id="editsection_qty"placeholder="max_qty"required=""></td>
                    </tr>

                    <tr>
                        <td>Student Quantity</td>
                        <td><input type="text" name="get_section_course"id="get_section_course"placeholder="get_section_course"required=""></td>
                    </tr>
                </table>
                <button type="submit" name="submitbutton-editstudent"class="bluewhiteButton submitbutton-editstudent"id="submitbutton-editstudent">UPDATE</button>
            </form>
        </div>
    </div>
</body>
</html>
