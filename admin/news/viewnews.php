<?Php
require_once('../../includes/connect.php');
session_start();
$message=false;	
$id=false;
if(!isset($_SESSION['firstname'])){
	header('Location:../../login/loginpage.php');
}






?>
<html>
<head>

<link rel="stylesheet" href="../../css/styles.css">
	<script src="../../js/js.js"></script>
	<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
				
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
	<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<title>View Teacher</title>

</head>
<body>
<?Php require_once('../../includes/navbar.php') ?>
<div class="wrap"id="wrap">
<div class="container mt-5">
<div class="col-sm-12">
<h3>VIEW NEWS</h3>
        <table class="table">
            <tr>
                <th>#</th>
                <th>Headline</th>
                <th>Header</th>
                <th>View</th>
                <th>Action</th>
            </tr>
        <?php 
        $c=0;
        $displaynews="SELECT * FROM news ORDER BY news_id DESC";
        $res_displaynews=mysqli_query($conn,$displaynews);
        while($rownews=mysqli_fetch_array($res_displaynews)){
            $c++;
        ?>
        <tr id="<?php echo $rownews['news_id']?>">
            <td><?php echo $c?></td>
            <td><?php echo $rownews['headline']?></td>
            <td><img src="<?php echo $rownews['image_header']?>" width="150px"></td>
            <td><a href="../../outside/news.php?news_id=<?php echo $rownews['news_id']?>">View</a></td>
            <td><button type="button" class="redblackButton"id="deleteNews"onclick="confirm('are you sure you want to delete?')&&deleteNews(<?php echo $rownews['news_id']?>)">Delete</button></td>
        </tr>
        
        <?php
        }
        ?>
    </table>


    </div>
    </div>
</div>

</body>
</html>