<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<style>
    .bigboxi{
        width:100vw;
        height:100vh;
        background-color:red;
        text-align:center;
    }
    .boxi{
        width:250px;
        height:250px;
        margin-top:150px;
        position:relative;

        -webkit-animation:spin 4s linear infinite;
        -moz-animation:spin 4s linear infinite;
        animation:spin 4s linear infinite;
    }
    .boxx{
        width:200px;
        height:200px;
        margin-top:150px;
        border-radius:50%;
        position:absolute;
        margin-left:-225px;
        top:33px;
    }
    @-moz-keyframes spin { 100% { -moz-transform: rotate(360deg); } }
    @-webkit-keyframes spin { 100% { -webkit-transform: rotate(360deg); } }
    @keyframes spin { 100% { -webkit-transform: rotate(360deg); transform:rotate(360deg); } }
</style>
</head>
<body>
    <div class="bigboxi">
        <img class="boxi"src="../profile_gear.png">
        <img class="boxx"src="../ako.jpg">
    </div>
</body>
</html>