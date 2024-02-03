<?php
require_once('../../includes/connect.php');
if(isset($_POST['admin_id'])) {
    $query = "SELECT * FROM `admin` WHERE admin_id='".$_POST['admin_id']."'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);
    echo json_encode($row);
}




?>
