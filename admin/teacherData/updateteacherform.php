<?php
require_once('../../includes/connect.php');

if(isset($_POST['teacher_id'])) {
    $query = "SELECT * FROM teacher WHERE teacher_id = '".$_POST['teacher_id']."'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);
    echo json_encode($row);
}

?>
