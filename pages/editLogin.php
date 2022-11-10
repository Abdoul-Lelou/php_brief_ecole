<?php
include '../models/model.php';

if (isset($_POST['matricule'], $_POST['nom'], $_POST['prenom'], $_POST['email'])) {
    $update = new ModelUser();
    $matricule = $_POST['matricule'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];

    $user = new ModelUser();
    // // var_dump($matriculePost);die;
    // $update = $user->updateUser($matriculePost, $nomPost, $prenomPost, $emailPost);

    $date_modif = date("Y-m-d H:i:s");
    try {

        $sql=$user->db->prepare("UPDATE `user` SET `nom`='$nom',`prenom`='$prenom',`email`='$email', `date_modif`='$date_modif' WHERE matricule='$matricule'");
        
        // $checkMail =$user->db->prepare('SELECT email FROM user WHERE email=:email and matricule !=:matricule');
        // $checkMail->bindParam(":email",$email);
        // $checkMail->bindParam(":matricule",$matricule);


        // $checkMail->execute();

        // $row = $checkMail->fetch(PDO::FETCH_ASSOC);
       
        // if (!$row) {   
            $sql->execute();
        //     return $sql;
        // }else {
        //     return null;
        // }
        

            
    } catch (\Throwable $th) {

        echo ' 
                <div   class="d-flex justify-content-center" role="alert">
                    <span class="badge bg-danger border border-danger">'.$th->getMessage().'</span>
                </div>          
             ';
         
        $sql->closeCursor();
    }
    

    
    if ($update) {
        // $url = "localhost/ecole_project/pages/editProfile.php";
        echo ' 
    <a class="navbar-brand pe-none" href="#">
        <div   class="d-flex justify-content-center" role="alert">
            <span class="badge bg-success border border-success">Reussie</span>
        </div> 
    </a> 
    <script>
                setTimeout(()=>{
                    document.querySelector(".navbar-brand").remove();
                    window.location.href = "editProfile.php"
                },1000)  
    </script>
    ';
    } else {
        echo ' 
    <div   class="d-flex justify-content-center" role="alert">
        <span class="badge bg-danger border border-danger">Email existe déjà!</span>                
    </div>
    <script>
                setTimeout(()=>{
                    document.querySelector(".badge").remove();
                },2000)
    </script>
';
    }
}