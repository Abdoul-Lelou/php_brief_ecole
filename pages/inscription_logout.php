<?php
require "../models/model.php";

$requeste = new ModelUser();

if (isset($_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['roles'], $_POST['passwords'])) {



    $nom = trim($_POST['nom']);
    $prenom = trim($_POST['prenom']);
    $roles = trim($_POST['roles']);
    $passwords = $_POST['passwords'];
    $email = trim($_POST['email']);
    
    $requeste = new ModelUser();


    if (!empty($nom) && !empty($prenom) && !empty($email) && !empty($passwords)) {
        $add=  $requeste->addUser($nom, $prenom,$email, $passwords, $roles);
    } else {
        echo '<script>alert("Tout les champs doivent etre remplis")</script>';
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="css/inscription.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <title>Inscription</title>
</head>

<body>

    <div class="container d-flex justify-content-center parent">
        <div class="col-md-8 mt-4">



            <form class="row  d-flex justify-content-center no-wrap p-2 border border-1  bg-body shadow rounded needs-validation" novalidate action="inscription_logout.php" method="post">
                <nav class="navbar border border-2 bg-primary m-2 shadow ">
                    <div class="container">
                        <a class="navbar-brand pe-none" href="#">
                            <span class="text-center text-dark"> INSCRIPTION </span>
                        </a>
                        <?php
                            if (isset($add)) {
                               
                                if ($add =="Utilisateur ajouté") {
                                   
                                    echo '
                                        <span class="d-flex justify-content-center text" role="alert">
                                            <span class="badge bg-success border">' . $add . '</span>
                                        </span> 
                                    ';
                                    echo '<script>
                                            setTimeout(()=>{
                                                document.querySelector(".text").remove();
                                            },2000)
                                    </script>';
                                }else{
                                    echo '
                                       
                                    <span class="d-flex justify-content-center text" role="alert">
                                        <span class="badge bg-danger border">' . $add . '</span>
                                    </span>     
                                    ';
                                    echo '<script>
                                            setTimeout(()=>{
                                                document.querySelector(".text").remove();
                                            },2000)
                                    </script>';
                                }   
                            }        
                        ?>
                    </div>
                </nav>

                <span id="msgPassword" style="display: none; color:red">Passwords different...ressayer</span>
                <div class="col-md-6 ">
                    <label for="input1" class="form-label">Nom</label>
                    <input type='text' name='nom' placeholder="nom" class="form-control" id="validationServer01" required>
                    <div class="valid-feedback" id="validationServer01"></div>
                    <div class="invalid-feedback" id="validationServer01">Champ invalide</div>
                </div>
                <div class="col-md-6">
                    <label for="input2" class="form-label">Prenom</label>
                    <input type="text" class="form-control" name="prenom" placeholder="prenom" id="validationServer02" required>
                    <div class="valid-feedback"> </div>
                    <div class="invalid-feedback">Champ invalide</div>
                </div>

                <div class="col-md-6">
                    <label for="input3" class="form-label">Email</label>
                    <input type="email" onchange="ValidateEmail()" class="form-control email" name="email" placeholder="email" id="validationServer03" required>
                    <div class="valid-feedback"></div>
                    <div class="invalid-tooltip">Champ invalide</div>
                    <div class="invalid-email" style="display: none; color:red;">Email invalide</div>

                </div>
                <div class="col-md-6">
                    <label for="input9" class="form-label">Rôle</label>
                    <select name="roles" id="roles" class=" form-control form-select is-valid" id="validationServer04" required>
                        <option selected disabled value="">Choisir...</option>
                        <option value="admin" name='roles'>ADMIN</option>
                        <option value="employer" name='roles'>EMPLOYER</option>
                    </select>
                    <div class="valid-feedback"></div>
                    <div class="invalid-feedback"></div>
                </div>
                <div class="col-md-6">
                    <label for="input6" class="form-label">Password</label>
                    <input type="password" class="form-control password" name="passwords" placeholder="password" id="validationServer05" required>
                    <div class="valid-feedback"></div>
                    <div class="invalid-feedback">Champ invalide</div>
                </div>
                <div class="col-md-6">
                    <label for="input6" class="form-label">Confirm Password</label>
                    <input type="password" onchange="checkPassword()" class="form-control confirmPassword" name="confirmPassword" placeholder="confirm password" id="validationServer06" required>
                    <div class="valid-feedback"></div>
                    <div class="invalid-feedback">Champ invalide</div>
                </div>
                



                <div class="row d-flex justify-content-center mt-2">
                    <button type="submit" class="m-2 btn btn-success col-sm-2" onclick="hideMsg()">
                        <i class="spinOff">S'inscrire</i>
                        <i class="spinOn" style="display: none">
                            <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                            Loading...
                        </i>
                    </button>
                </div>

                <span class="text text-center mt-2">
                    <p>Vous avez un compte?
                        <a href="../index.php" style="text-decoration:none;"> connectez-vous</a>
                    </p>
                </span>
            </form>


        </div>
    </div>
    <br>
    <footer class="d-flex justify-content-center mb-auto">
                <div class="row col-md-10 pt-1">
                  <div class=" d-flex justify-content-center">
                   
                    <p class="text-muted">Abdourahmane Diallo ©copyright 2022</p>
                  </div>
                </div>
    </footer>

    <script src="js/inscription.js"></script>
    <script>
    function checkPassword() {
        const password = document.querySelector('.passwords').values();
        const confirmPassword = document.querySelector('.confirmPassword').values();
        alert(password,confirmPassword)

        if (password != confirmPassword) {
            document.getElementById('msgPassword').style.display="block";
            setTimeout(() => {

                document.getElementById('msgPassword').style.display="none";
                password , confirmPassword="";    
            }, 2000);
        }

    }
    </script>


</body>

</html>