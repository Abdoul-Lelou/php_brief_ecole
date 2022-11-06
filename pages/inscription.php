<?php
require "../models/model.php";
// session_start();
$requeste = new ModelUser();

if (isset($_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['roles'], $_POST['passwords'])) {



    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $roles = $_POST['roles'];
    $passwords = $_POST['passwords'];
    $email = $_POST['email'];
    // var_dump($nom, $prenom,$email, $passwords, $roles);die;

    $requeste = new ModelUser();


    if (!empty($nom) && !empty($prenom) && !empty($email) && !empty($passwords)) {
            $add =  $requeste->addUser($nom, $prenom,$email, $passwords, $roles);
    } else {
        echo '<script>alert("Tout les champs doivent etre rempli")</script>';
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

        <?php
        include 'navbar.php';
        ?>
  

    <div class="container d-flex justify-content-center parent">
        <div class="col-md-8 mt-4">



            <form class="row  d-flex justify-content-center no-wrap p-2 border border-1  bg-body shadow rounded needs-validation" novalidate action="inscription.php" method="post">
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
                <span id="msgPassword" class="text-center" style="display: none; color:red;">
                      <span class=" badge bg-danger ">Passwords different</span>
                      <br>
                </span>

                <div class="col-md-6 ">
                    <label for="input1" class="form-label">Nom</label>
                    <input type='text' name='nom' onchange="controlEspace()" placeholder="nom" class="form-control nom" id="validationServer01" required>
                    <div class="valid-feedback" id="validationServer01"></div>
                    <div class="invalid-tooltip" id="validationServer01">Champ invalide</div>
                </div>
                <div class="col-md-6">
                    <label for="input2" class="form-label">Prenom</label>
                    <input type="text" onchange="controlEspace()" class="form-control prenom" name="prenom" placeholder="prenom" id="validationServer02" required>
                    <div class="valid-feedback"> </div>
                    <div class="invalid-tooltip">Champ invalide</div>
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
                    <div class="invalid-tooltip">choisir</div>
                </div>
                <div class="col-md-6">
                    <label for="input6" class="form-label">Password</label>
                    <input type="password" class="form-control passwords" name="passwords" placeholder="password" id="validationServer05" required>
                    <div class="valid-feedback"></div>
                    <div class="invalid-tooltip">Champ invalide</div>
                </div>
                <div class="col-md-6">
                    <label for="input6" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control confirmPassword" onchange="checkPassword()" name="confirmPassword" placeholder="confirm password" id="validationServer06" required>
                    <div class="valid-feedback"></div>
                    <div class="invalid-tooltip">Champ invalide</div>
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
    <script>
        function controlEspace(){
            const nom = document.querySelector('.nom');
            const prenom = document.querySelector('.prenom');
            nom.value= ltrim(nom.value);
            nom.value= rtrim(nom.value);
            prenom.value= ltrim(prenom.value);
            prenom.value= rtrim(prenom.value);

            
            alert((nom.value))
        }

        function controlEmail(){
    
            const email = document.querySelector('.nom');
            
            if(email.value ==" "){
            
            }
        }

        function ltrim(str) {
            if(!str) return str;
            return str.replace(/^\s+/g, '');
        }

        function rtrim(str) {
            if(!str) return str;
            return str.replace(/\s+$/g, '');
        }
      

function ValidateEmail() {

  var validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
  const email = document.querySelector('.email');
  
  const emailMsg = document.querySelector('.invalid-email');

  if (!email.value.match(validRegex)) {

        emailMsg.style.display = 'block';
        setTimeout(()=>{
            emailMsg.style.display = 'none';
            email.value=""
        },2000)
    return false;

  } 

}
    </script>


</body>

</html>