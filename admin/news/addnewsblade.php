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
	<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
	<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

	<title>View Teacher</title>
</head>
<body>

    <script>
        $(document).on('click','.removeInput',function() {
            var x = $(this).attr("id");
            $('#'+x).remove();
        })

        $(document).on('click','.removeFile',function() {
            var x = $(this).attr("id");
            $('#'+x).remove();
        })
    </script>

    <?Php require_once('../../includes/navbar.php') ?>

    <div class="wrap"id="wrap">
        <div class="container mt-5">
            <div class="col-sm-7">
                <h3>ADD NEWS</h3>
                <input type="hidden"value="0" id="totalnew_input">
                <input type="hidden"value="0" id="totalnew_file">
                <input type="text"id="addinput"value=1 style="width:50px;border-radius:10px;border:2px solid #c2c2c2"><button type="button"class="bluewhiteButton"style="margin-bottom:5px;margin-left:5px;width:100px;"id="addinputboxButton"onclick="addinputboxButton()">Add Text</button><br>
                <input type="text"id="addimage"value=1 style="width:50px;border-radius:10px;border:2px solid #c2c2c2"><button type="button"class="bluewhiteButton"style="margin-bottom:5px;margin-left:5px;width:100px;"id="addImages"class="addImages"onclick="addImages()">Add Image</button>
                <form action="sqlnews.php"id="addnewsForm"name="addnewsForm"method="POST" enctype="multipart/form-data">
                    <table id="newsTable" class="table">
                        <tr>
                            <td>Headline</td>
                            <td><input type="text" id="headline"name="headline"placeholder="headline"></td>
                        </tr>

                        <tr>
                            <td>Header Image</td>
                            <td><input type="file" name="imageHeader"></td>
                        </tr>

                        <tr>
                            <td>Story</td>
                            <td><textarea name="story[]" style="width:300px;height:100px;"placeholder="story"></textarea></td>
                        </tr>
                    </table>
                <div class="boxFile">
                    <input type="file" name="image[]"></br>
                </div>
                <button type="submit"id="submitNews"class="bluewhiteButton"style="margin-top:5px;">Submit</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>