<?Php
require_once('../includes/connect.php');


$firstname=$_SESSION['firstname'];
?>
<!DOCTYPE html>
<html>
<head>
<style>
    body{margin:0;}

    .header{
        margin:0 auto;
        height:60px;
        padding:20px 30px 0px 30px;
        background-color:#383735;
        color:#f1f1f1;
        position:fixed;
        width:100%;
        z-index:1;
    }
    .header a{
        color:#f1f1f1;
        text-decoration:none;
        float:right;
    }
    .header a:active{
        color:red;
    }
    .header b{
        float:left;
    }
</style>
</head>
<body>

    <div class="header"><a href="logout.php">Logout</a><a href="adminpage.php"style="float:left;"><?php echo $firstname; ?></a></div>

</body>

</html>