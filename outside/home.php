<?php
require_once('../includes/connect.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <script src="../js/js.js"></script>
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>     
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <title>Document</title>
<style>
.navigationBar a{
    text-decoration:none;
    color:#fff;
    font-size:30px;
    padding:15px;
}
.navigationBar a:hover{
    color:#c2c2c2;
}
.startHere{
    text-decoration:none;
    border-radius:10px;
    background-color:#349beb;
    color:#fff;
    padding:10px;
    font-weight:bold;
}
.startHere:hover{
    color:#000;
}
.nav_rightSlide{
    display:none;
}
.footer{
    background-color:red;
    width:100%;
    height:20px;
    color:#fff;
    position:relative;

}
@media screen and (max-width: 800px) {
    .navigationBar a{
        display:none;
    }
    .nav_rightSlide{
        display:block;
    }
}
</style>
</head>
<body>
    <div class="container-fluid bg-light">
        <div class="row">
            <div class="col-sm-12 bg-dark navigationBar"style="padding:5px;position:fixed;">
                <button type="submit"onclick="nav_rightSlide()"class="nav_rightSlide"id="nav_rightSlide"><i class="fa fa-bars" aria-hidden="true"></i></button>
                <a href="#home">HOME</a>
                <a href="#courses">COURSES</a>
                <a href="#news">NEWS</a>
            </div>
        </div>

    <div class="container bg-light">
        <div class="row mt-5 "id="home">
            <div class="col-7 bg-light align-self-center"style="padding:50px;">
                <h1>We are here to help you achieve your dream.</h1>
                <a href="#"class="startHere">Start Here</a>
            </div>

            <div class="col-5 bg-light mt-5 mb-5">
                <img src="ako.jpg" style="width:100%;height:100%;">
            </div>

        </div>

        <div class="row bg-light border-top border-secondary border-5"id="courses" style="height:100vh">
            <h1 class="mt-5">What courses we offer?</h1>
            <h4>Here are our Top 6 courses</h4>
            <?php
            $getCourses = mysqli_query($conn,"SELECT * FROM courses LIMIT 6");
            while($row = mysqli_fetch_array($getCourses)){
            ?>
            <div class="col-sm-4">
                <h3><?php echo $row['course_name']?></h3>
                <p><?php echo $row['course_description']?></p>
            </div>
            <?php
            }

            ?>
        </div>

        <div class="row bg-light border-top border-secondary border-5"id="news">
                <h1 class="mt-5">Top 3 Hot News</h1>
                <?php
                $getNews=mysqli_query($conn,"SELECT * FROM news LIMIT 3");
                while($rowNews=mysqli_fetch_array($getNews)){
                    $getContent=json_decode($rowNews['news_content']);
                ?>
                <div class="col-sm-4">
                    <img src="../admin/news/<?php echo $rowNews['image_header']?>" class="m-0"style="height:300px;width:100%">
                    <p><?php echo $getContent[0]?></p>
                    <h2><?php echo $rowNews['headline']?></h2>
                    <a href="http://localhost/college/outside/news.php?headline=<?php echo $rowNews['headline']?>&news_id=<?php echo $rowNews['news_id']?>">Click Here...</a>
                </div>
                <?php
                }
                ?>
        </div>

        <div class="row mt-5 border-top border-secondary border-5">
            <div class="col-sm-6">
                <h1>Mission</h1>
                <p>Our mission is to provide students a quality education that will help them to hone their skills.</p>
            </div>

            <div class="col-sm-6">
                <h1>Vision</h1>
                <p>Our school envision to have a peacefull and advanced society where everyone can enjoy by providing professionals with integrity.</p>
            </div>
        </div>

    </div>
    </div>

    <div class="container-fluid bg-dark text-white">
        <div class="row p-3">
            <div class="col-6">
                <h2>Where are we located?</h2>
                <b>We are located at Sapang Biabas Phase 1 Resettlement, Mabalacat City, Pampanga</b>
            </div>

            <div class="col-3">
                <h2>Are you open today?</h2>
                <b>We are only open during weekdays from 7am to 4pm.</b>
            </div>
            
            <div class="col-3">
                <h2>What courses are available?</h2>
                <b>Please, Check our offered courses to the Course Tab.</b>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 text-white text-center">
                <b style="font-size:40px;">SCHOOL</b>
            </div>
        </div>
    </div>

</body>
</html>