<?Php
require_once('../includes/connect.php');
$get_news_id=$_GET['news_id'];
$sql_latestnews=mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM news WHERE news_id='$get_news_id'"));

$sqlnews="SELECT * FROM news ORDER BY news_id DESC LIMIT 3";
$result_news=mysqli_query($conn,$sqlnews);
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <script src="../js/js.js"></script>
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
          
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
            
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>News</title>
<style>
.nopadding {
   padding: 0 !important;
}
</style>
</head>
<body>
<div class="container-fluid bg-light">
    <div class="container">
    <div class="row text-dark">
        <div class="col-sm-4 mt-4">
            <img src="../admin/news/<?php echo $sql_latestnews['image_header']?>"class="img-thumbnail"style="width:100%;height:400px">
        </div>
        <div class="col-sm-7 mt-4">
            <p class="display-1"><?php echo $sql_latestnews['headline']?></p>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-sm-8">
            <?php
            $getcontent=json_decode($sql_latestnews['news_content']);
            foreach($getcontent as $content){
            ?>
            <p class="lead"><?php echo $content?></p>
            <?php
            }
            ?>
        </div>
    </div>

    <div class="row mt-5 border-top border-secondary border-5 m-3">
        <p class="h1">Gallery</p>
        <?php
            $getimages=json_decode($sql_latestnews['gallery']);
            foreach($getimages as $images){
            ?>

            <img src="../admin/news/<?php echo $images?>" style="width:200px;">
            <?php
            }
            ?>
    </div>

    <div class="row mt-5 border-top border-secondary border-5 m-3">
    <p class="h1">Topic</p>
    <?php
    while($row=mysqli_fetch_array($result_news)){
        $getContent=json_decode($row['news_content']);
        ?>
    <div class="col-sm-3 text-dark border border-secondary border-1 nopadding"style="margin-left:6%">
        <div style="height:200px;">
            <img src="../admin/news/<?php echo $row['image_header']?>" class="m-0"style="height:100%;width:100%">
        </div>
        <div style="height:200px;overflow:hidden"class="ms-2">
            <p class="h2"><?php echo $row['headline']?></p>
            <p><?php echo $getContent[0]?></p>
        </div>
        <div class="bg-secondary">
            <a href="http://localhost/college/outside/news.php?headline=<?php echo $row['headline']?>&news_id=<?php echo $row['news_id']?>"class="text-white text-decoration-none">CHECK IT OUT</a>
        </div>
    </div>
    <?php
    }
    ?>
</div>
</div>
</div>
</body>
</html>