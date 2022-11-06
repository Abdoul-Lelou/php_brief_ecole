<?php

session_start();
if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
}
$status = $statusMsg = '';
// var_dump($_POST);die;
if(isset($_POST["submit"])){ 
    $status = 'error'; 
    if(!empty($_FILES["image"]["name"])) { 
        // Get file info 
        $fileName = basename($_FILES["image"]["name"]); 
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
         
        // Allow certain file formats 
        $allowTypes = array('jpg','png','jpeg','gif'); 
        if(in_array($fileType, $allowTypes)){ 
            $image = $_FILES['image']['tmp_name']; 
            $imgContent = addslashes(file_get_contents($image)); 
         
            // Insert image content into database 
            $db = new PDO('mysql:host=localhost;dbname=test;charset=UTF8', 'root', '');
            $getImage = $db->query("SELECT photo FROM images WHERE user=$id"); 
            if ($getImage) {
                $db->query("DELETE FROM `images` WHERE user=$id");
            }
            $insert = $db->query("INSERT into images (photo, created,user) VALUES ('$imgContent', NOW(),$id)"); 

             
            if($insert){ 
                $status = 'success'; 
                $statusMsg = "File uploaded successfully."; 
                header('location:editProfile.php');
            }else{ 
                $statusMsg = "File upload failed, please try again."; 
            }  
        }else{ 
            $statusMsg = 'Désolé, seule les fichiers JPG, JPEG, PNG, & GIF sont autorisés.'; 
        } 
    }else{ 
        $statusMsg = 'Veillez selectionner une image'; 
    } 
} 
 
// Display status message 
echo "
        <h4 class='msg alert alert-danger' style='color:red'>$statusMsg</h4>
        <script>
            setTimeout(()=>{
                document.querySelector('.msg').remove();
                window.location.href='editProfile.php'
            },3000);

        </script>
    "; 