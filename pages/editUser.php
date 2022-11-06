<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $db = new PDO('mysql:host=localhost;dbname=test;', 'root', '');
    $sql = $db->query("SELECT * FROM user WHERE id='$id'");
    $donnee = $sql->fetch();

    $nom = $donnee['nom'];
    $prenom = $donnee['prenom'];
    $email = $donnee['email'];
    $matricule = $donnee['matricule'];
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/inscription.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.3/bootbox.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.3/bootbox.js"></script> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <title>Modifier</title>
</head>

<body>

 
    <?php
        require_once('../models/model.php');
        include 'navbar.php';
    ?>
   

    <div class="container d-flex justify-content-center parent">
        <div class="col-md-8 mt-4">



            <form class="row  d-flex justify-content-center no-wrap p-2 border border-1  bg-body shadow rounded needs-validation" novalidate action="editUser.php" method="post">
                <nav class="navbar shadow bg-primary m-2">
                    <div class="container">
                        <a class="navbar-brand pe-none  " href="#">
                            
                            <span class="text-center text-dark"> MODIFIER </span>
                        </a>
                    </div>
                </nav>
                <span class=" d-flex justify-content-center">
                    <?php
                    
                    if (isset($_POST['matricule'], $_POST['nom'], $_POST['prenom'], $_POST['email'])) {
                        $update = new ModelUser();
                        $matriculePost = $_POST['matricule'];
                        $nomPost = $_POST['nom'];
                        $prenomPost = $_POST['prenom'];
                        $emailPost = $_POST['email'];

                        $user = new ModelUser();
                        
                        $update = $user->updateUser($matriculePost,$nomPost,$prenomPost,$emailPost);

                        if ($update){
                            $url = "localhost/ecole_project/pages/accueil_admin.php";
                            echo ' 
                                        <a class="navbar-brand pe-none" href="#">
                                            <div   class="d-flex justify-content-center" role="alert">
                                                <span class="badge bg-success border border-success">Reussie</span>
                                            </div> 
                                        </a> 
                                        <script>
                                                    setTimeout(()=>{
                                                        document.querySelector(".navbar-brand").remove();
                                                        window.location.pathname="/ecole_project/pages/accueil_admin.php";
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

                    ?>
                </span>
                <input type='text' name='matricule' value="<?php echo $matricule ?>" hidden>
                <div class="col-md-6 mb-2">
                    <label for="input1" class="form-label">Nom</label>
                    <input type='text' name='nom' placeholder="nom" class="form-control" id="validationServer01" value="<?php if(isset($nom )) echo $nom ?>" required>
                    <div class="valid-feedback" id="validationServer01"></div>
                    <div class="invalid-feedback" id="validationServer01">Champ invalide</div>
                </div>
                <div class="col-md-6 mb-2">
                    <label for="input2" class="form-label">Prenom</label>
                    <input type="text" class="form-control" name="prenom" placeholder="prenom" id="validationServer02" value="<?php if(isset($prenom )) echo $prenom ?>" required>
                    <div class="valid-feedback"> </div>
                    <div class="invalid-feedback">Champ invalide</div>
                </div>

                <div class="col-md-8 mb-2">
                    <label for="input3" class="form-label">Email</label>
                    <input type="email" onchange="ValidateEmail()" class="form-control email" name="email" placeholder="email" id="validationServer03" value="<?php if(isset($email )) echo $email ?>" required>
                    <div class="valid-feedback"></div>
                    <div class="invalid-feedback">Email invalide</div>
                    <div class="invalid-email" style="display: none; color:red;">Email invalide</div>

                </div>
               


                <div class="row d-flex justify-content-center mt-2">
                    <button type="submit" class=" m-2 btn btn-success col-sm-2" onclick="hideMsg()">
                        <i class="spinOff">Modifier</i>
                        <i class="spinOn" style="display: none">
                            <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                            Loading...
                        </i>
                    </button>
                    <a href="accueil_admin.php" class="m-2  btn btn-danger col-sm-2">
                        <i class="spinOff">Annuler</i>
                        <i class="spinOn" style="display: none">
                            <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                            Loading...
                        </i>
                    </a>
                </div>

                <span class="text text-center mt-2">
                    <p>Ecole de la reussite</p>
                </span>
            </form>


        </div>
    </div>

    <footer class="d-flex justify-content-center mt-4">
                <div class="row col-md-10 pt-1">
                  <div class=" d-flex justify-content-center">
                    <p class="text-muted">Abdourahmane Diallo ©copyright 2022</p>
                  </div>
                </div>
    </footer>

    <script src="js/inscription.js"></script>


</body>

</html>