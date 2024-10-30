<?php
require_once('../../includes/connect.php');
?>

<html>
<head>
    <link rel="stylesheet" href="../../css/styles.css">
    <script src="../../js/js.js"></script>
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
    <title>EDIT TEACHER</title>
</head>
<body>
    <div class="editAdmin"id="editAdmin">
        <a href="javascript:void(0)"class="closebutton-addstudent"onclick="closebutton_editviews('adminInfo')">&times;</a>
        <div class="error"><b id="error"></b></div>

        <!--form editing user info -->
        <div class="addstudent-box"id="admineditinfo">
            <form id="updateAdmin"name="updateAdmin"method="POST">
                <table class="addData-table">
                    <tr>
                        <td colspan=2><b>Update my Info</b></td>
                    </tr>
                    <input type="hidden" name="admin_id" id="admin_id">

                    <tr>
                        <td><label>EMAIL</label></td>
                        <td><input type="text" name="admin_email"required=""id="admin_email"placeholder="EMAIL"></td>
                    </tr>

                    <tr>
                        <td><label>FIRST NAME</label></td>
                        <td><input type="text" name="admin_firstname"required=""id="admin_firstname"placeholder="FIRST NAME"></td>
                    </tr>

                    <tr>
                        <td><label>MIDDLE NAME</label></td>
                        <td><input type="text" name="admin_middlename"id="admin_middlename"placeholder="MIDDLE NAME"></td>
                    </tr>

                    <tr>
                        <td><label>LAST NAME</label></td>
                        <td><input type="text" name="admin_lastname"required=""id="admin_lastname"placeholder="LAST NAME"></td>
                    </tr>

                    <tr>
                        <td><label>Schoolyear</label></td>
                        <td>
                            <select name="admin_schoolyear"id="admin_schoolyear">
                                <option value="2022-2023">2022-2023</option>
                                <option value="2023-2024">2023-2024</option>
                                <option value="2024-2025">2024-2025</option>
                                <option value="2025-2026">2025-2026</option>
                                <option value="2026-2027">2026-2027</option>
                            </select>
                        </td>
                    </tr>
                </table>
                <button type="submit" name="submitbutton-editteacher"class="bluewhiteButton"id="submitbutton-editteacher">UPDATE ADMIN</button>
            </form>
        </div>


    </div>

</body>
</html>

