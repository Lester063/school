<?Php
require_once('../../includes/connect.php');
session_start();

$sql_section = 'SELECT * FROM section ORDER BY schoolyear DESC';
$result_section = mysqli_query($conn, $sql_section);
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
    <div class="messageTo"id="messageTo"></div>

    <?Php require_once('../../includes/navbar.php') ?>
    <?Php require_once('addsectionForm.php') ?>
    <?Php require_once('editsectionForm.php') ?>
    <?Php require_once('reassignedteacher.php') ?>
    <div class="wrap"id="wrap">
        <div class="container mt-5">
            <div class="col-sm-12">
                <h3>VIEW SECTIONS</h3>
                <button type="submit"class="addSection"name="addSection"onclick="showAddSection()">Add Section</button>
                <?Php
                $sy = null;
                while($rowsection = mysqli_fetch_assoc($result_section)) {
                    $section_id = $rowsection['section_id'];
                    if ($sy != $rowsection['schoolyear']) {
                        $sy = $rowsection['schoolyear'];
                        echo "<table class='myTable'style='margin-top:20px;'>";
                        echo "<tr>";
                        echo "<th colspan=5>SY:$sy</th>";
                        echo "<tr>";

                        echo "<tr>";
                        echo "<th>QTY</th>";
                        echo "<th>Section</th>";
                        echo "<th>View Student List</th>";
                        echo "<th>Re/Assign</th>";
                        echo "<th>Action</th>";
                        echo "<tr>";
                    }
                ?>

                <tr id="<?php echo $rowsection['section_id']?>">
                    <td><b><?php echo $rowsection['student_qty']."/".$rowsection['max_qty']?></b></td>
                    <td><b>SY: <?Php echo $rowsection['schoolyear']." ".$rowsection['section_course'].$rowsection['yearsection']?></b>
                    <td><a href="viewenrolledList.php?section_id=<?php echo $rowsection['section_id']?>">View Student List</a></td>
                    <?php
                    $sql_changelink=mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM section WHERE section_id=$section_id"));
                        if($sql_changelink['assign_status'] == "ASSIGNED") {
                    ?>
                    <td><a href="assignteacher_newversion.php?section_id=<?php echo $section_id?>">Re-Assign Teachers</a></td>
                    <?php
                        }
                        else {
                    ?>
                    <td><a href="assignteacher_newversion.php?section_id=<?php echo $section_id?>">Assign Teachers</a></td>
                    <?php
                    }
                    ?>
                    </td>
                    <td>
                        <button type="button" class="deletebutton"name="button" onclick = "confirm('Are you sure ?') && 
                        deleteSection(<?php echo $rowsection['section_id']; ?>);">
                            Delete
                        </button>
                        <button type="button" class="editsectionbutton"name="editbuttonsection"id="<?php echo $rowsection['section_id'];?>" 
                        onclick = "editbuttonsection(<?php echo $rowsection['section_id']; ?>);">
                            Edit Data
                        </button>
                    </td>
                </tr>
                <?Php
                }
                ?>
                </table>
        </div>
        </div>
    </div>
</body>
</html>