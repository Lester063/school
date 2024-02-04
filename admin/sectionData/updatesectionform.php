<?php
require_once('../../includes/connect.php');
if(isset($_POST['assection_id'])) {
    $section_id = $_POST['assection_id'];
    $query = "SELECT se.*, ss.* FROM section se, section_subject ss WHERE se.section_id = ss.section_id AND se.section_id = '$section_id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);
    echo json_encode($row);
}

?>
