<?Php
require_once('../../includes/connect.php');
$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp' , 'pdf' , 'doc' , 'ppt'); // valid extensions
$path = 'news_images/'; // upload directory

$array = array();

	if(!empty($_POST['story'] AND  $_POST['headline'])) {	
        $story = $_POST['story'];
        $headline = $_POST['headline'];
        $storey = json_encode($_POST['story']);
        for($i = 0;$i < count($_FILES['image']['name']);$i++){
            $img = $_FILES['image']['name'][$i];
            $tmp = $_FILES['image']['tmp_name'][$i];
            $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
            $final_image = rand(1000,1000000).$img;

            if(in_array($ext, $valid_extensions)) { 
                $pati = $path.strtolower($final_image); 
                array_push($array,$pati);
                $awet = json_encode($array);

                if(move_uploaded_file($tmp, $pati)) {
                    
                }
            }
            else{
                $me = "<script>
                alert('Failed to create News1.');
                document.location.href = 'addnewsblade.php';
                </script>";
                exit($me);
            }

        }

        //for imageHeader
        $img_header = $_FILES['imageHeader']['name'];
        $tmp_header = $_FILES['imageHeader']['tmp_name'];
        $ext_imageHeader = strtolower(pathinfo($img_header, PATHINFO_EXTENSION));
        //this will set a random filname
        $final_imageheader = rand(1000,1000000).$img_header;
        
        if(in_array($ext, $valid_extensions)){ 
            //imageheader
            $pati_imageHeader = $path.strtolower($final_imageheader); 

            if(move_uploaded_file($tmp_header,$pati_imageHeader)) {
                
            }
        }
        else{
            $me = "<script>
            alert('Failed to create News2.');
            document.location.href = 'addnewsblade.php';
            </script>";
            exit($me);
        }

        $sql_news = "INSERT INTO news (headline,image_header,news_content, gallery) VALUES ('$headline','$pati_imageHeader','$storey','$awet')";
        mysqli_query($conn, $sql_news);

        echo
        "
        <script>
        alert('Created News Successfully');
        document.location.href = 'addnewsblade.php';
        </script>
        ";
    }
	else{
        echo
        "
        <script>
        alert('Failed to create News.');
        document.location.href = 'addnewsblade.php';
        </script>
        ";
	}
?>


