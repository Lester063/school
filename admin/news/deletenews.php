<?php 
require_once('../../includes/connect.php');
if($_POST['action']=="action_deletenews"){
    deleteNews();
}

function deleteNews() {
    global $conn;
    $news_id = $_POST['news_id'];
    $sql_delete = "DELETE FROM news WHERE news_id = $news_id";
    mysqli_query($conn, $sql_delete);

    echo 1;
}

?>