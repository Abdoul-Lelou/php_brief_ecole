<?php
require "../models/model.php";
$requeste = new ModelUser();;

if (isset($_POST['passwords'], $_POST['newPasswords'])) {

    $newPassword = $_POST['newPasswords'];
    $passwords = $_POST['passwords'];

    $requeste = new ModelUser();


    // var_dump($requeste->updatePassword($passwords, $newPassword));die;
    if (!empty($newPassword) && !empty($passwords)) {
        $add =  $requeste->updatePassword($passwords, $newPassword);
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
   
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

    <title>Document</title>
</head>

<body>
    <?php

    include('navbar.php');
    ?>

    <div class="container py-5 h-100 ">
        <div class="row d-flex justify-content-center align-items-center h-100 ">
            <div id="passwordForm" class="col col-lg-6 mb-4  mb-lg-0 bg-dark">

                <form class="row no-wrap p-2 border border-1  bg-body shadow rounded needs-validation" novalidate action="editProfile.php" method="post">
                    <nav class="navbar border border-2 bg-primary  shadow mb-4">
                        <div class="container">
                            <a class="navbar-brand pe-none" href="#">

                                <span class="text-center text-dark"> MODIFIER PASSWORD </span>
                            </a>
                            <?php
                            if (isset($add)) {

                                if ($add == "Password modifié") {

                                    echo '
                                        <a class="navbar-brand pe-none msgText" href="#">                                    
                                            <span class="badge bg-success border border-success">' . $add . '</span>      
                                        </a> 
                                       
                                    ';
                                    echo '<script>
                                            setTimeout(()=>{
                                                document.querySelector(".msgText").remove();
                                            },2000)
                                    </script>';
                                } else {
                                    echo '
                                        <a class="navbar-brand pe-none msgText" href="#">                            
                                            <span class="badge bg-danger border border-danger">' . $add . '</span>                                           
                                        </a> 
                                       
                                    ';
                                    echo '<script>
                                            setTimeout(()=>{
                                                document.querySelector(".msgText").remove();
                                            },2000)
                                    </script>';
                                }
                            }
                            ?>
                        </div>
                    </nav>
                    <br><br>

                    <div class="row d-flex justify-content-center passwordEdit">
                        <div class="col-md-8">
                            <label for="input6" class="form-label">Password</label>
                            <!-- <input type="password" class="form-control" name="passwords" placeholder="password" id="validationServer05" required>
                            <div class="valid-feedback"></div>
                            <div class="invalid-tooltip">Champ invalide</div> -->
                            <div class="input-group">
                                <input type="password" style="max-width: 92%;" name="passwords" placeholder="password" class="form-control passwords " id="validationServer01" required>
                                <span class="input-group-text bg-light " style="border:none; " onclick="togglePassword()"><i class="bi bi-eye-slash fs-3 text-primary" id="togglePassword"></i></span>
                                <div class="valid-feedback"></div>
                                <div class="invalid-tooltip">champ invalide</div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <label for="input6" class="form-label">New Password</label>
                            <!-- <input type="password" class="form-control passwords" name="newPasswords" placeholder="nouveau password" id="validationServer05" required>
                            <div class="valid-feedback"></div>
                            <div class="invalid-tooltip">Champ invalide</div> -->
                            <div class="input-group">
                                <input type="password" style="max-width: 92%;" name="newPasswords" placeholder="nouveau password" class="form-control confirmPassword " id="validationServer02" required>
                                <span class="input-group-text bg-light " style="border:none; " onclick="togglePasswordConfirm()"><i class="bi bi-eye-slash fs-3 text-primary" id="togglePasswordConfirm"></i></span>
                                <div class="valid-feedback"></div>
                                <div class="invalid-tooltip">champ invalide</div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <label for="input6" class="form-label">Confirm new Password</label>
                            <!-- <input type="password" onchange="checkPassword()" class="form-control confirmPassword" name="confirmPassword" placeholder="confirmer password" id="validationServer06" required>
                            <div class="valid-feedback"></div>
                            <div class="invalid-tooltip">Champ invalide</div> -->
                            <div class="input-group">
                                <input type="password" style="max-width: 92%;" onchange="checkPassword()" name="confirmPassword" placeholder="confirmer password" class="form-control confirmPassword2 " id="validationServer03" required>
                                <span class="input-group-text bg-light" style="border:none; " onclick="togglePasswordConfirm2()"><i class="bi bi-eye-slash fs-3 text-primary" id="togglePasswordConfirm2"></i></span>
                                <div class="valid-feedback"></div>
                                <div class="invalid-tooltip">champ invalide</div>
                            </div>
                        </div>
                        <span id="msgPassword" class="text-center p-2" style="display: none; color:red;">
                            <span class=" badge bg-danger ">Passwords different</span>
                            <br>
                        </span>
                    </div>

                    <div class="row d-flex justify-content-center mt-2">
                        <button type="submit" class="btnPassword btn btn-success col-sm-2" onclick="hideMsg()">
                            <i class="spinOff">Modifier</i>
                            <i class="spinOn" style="display: none">
                                <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                                Loading...
                            </i>
                        </button>
                        <span class="text text-center mt-4">
                            <button type="button" onclick="showHide()" class="btn " title="edit password"><i class="bi bi-camera fs-1 fw-bolder text-primary"></i></button>
                            <button type="button" onclick="showHideInfo()" class="btn " title="edit info"><i class="bi bi-person-badge fs-1 fw-bolder text-primary"></i></button>
                        </span>
                    </div>

                </form>
            </div>

            <br>
            <div class=" mt-4 col-md-4 blockImg" style="display: none;">
                <nav class="navbar border border-2 bg-primary  shadow mb-4">
                    <div class="container">
                        <a class="navbar-brand pe-none" href="#">
                            <span class="text-center text-dark"> CHANGER PHOTO </span>
                        </a>
                    </div>
                </nav>
                <form action="addImage.php" class="d-flex justify-content-center border p-2 needs-validation bg-light shadow" novalidate method="post" enctype="multipart/form-data">


                    <input type="file" id="inputGroupFile02" class="form-control w-100 m-3" name="image" required>
                    <br>
                    <div class="valid-feedback"></div>
                    <div class="invalid-tooltip">Choisir une photo</div>
                    &nbsp;
                    <button type="submit" id="photo" name="submit" class="btn btn-outline-info col-md-1.5" title="changer"><i class="bi bi-camera fs-1 fw-bolder"></i></button>
                    <span class="d-flex shadow border border-danger m-1 p-3 btn btn-outline">
                        <i class="bi bi-x-circle fs-1 fw-bolder  rounded" onclick="showHide()"></i>
                    </span>
                </form>
            </div>


            <div class="col-md-8 mt-4" style="display: none;">



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

                            $update = $user->updateUser($matriculePost, $nomPost, $prenomPost, $emailPost);

                            if ($update) {
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
                        <input type='text' name='nom' placeholder="nom" class="form-control" id="validationServer01" value="<?php if (isset($nom)) echo $nom ?>" required>
                        <div class="valid-feedback" id="validationServer01"></div>
                        <div class="invalid-feedback" id="validationServer01">Champ invalide</div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="input2" class="form-label">Prenom</label>
                        <input type="text" class="form-control" name="prenom" placeholder="prenom" id="validationServer02" value="<?php if (isset($prenom)) echo $prenom ?>" required>
                        <div class="valid-feedback"> </div>
                        <div class="invalid-feedback">Champ invalide</div>
                    </div>

                    <div class="col-md-8 mb-2">
                        <label for="input3" class="form-label">Email</label>
                        <input type="email" onchange="ValidateEmail()" class="form-control email" name="email" placeholder="email" id="validationServer03" value="<?php if (isset($email)) echo $email ?>" required>
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

            <div class="col-md-8 mt-4 editBlock" style="display: none;">



                <form class="row  d-flex justify-content-center no-wrap p-2 border border-1  bg-body shadow rounded needs-validation" novalidate action="editProfile.php" method="post">
                    <nav class="navbar shadow bg-primary m-2">
                        <div class="container">
                            <a class="navbar-brand pe-none  " href="#">

                                <span class="text-center text-dark"> MODIFIER </span>
                            </a>
                        </div>
                    </nav>
                    <span class=" d-flex justify-content-center">
                        <?php

                        if (isset($_SESSION['matricule'])) {
                            $matriculeUser = $_SESSION['matricule'];
                            $nomUser = $_SESSION['nom'];
                            $prenomUser = $_SESSION['prenom'];
                            $emailUser = $_SESSION['email'];

                        }

                        if (isset($_POST['matricule'], $_POST['nom'], $_POST['prenom'], $_POST['email'])) {
                            $update = new ModelUser();
                            $matriculePost = $_POST['matricule'];
                            $nomPost = $_POST['nom'];
                            $prenomPost = $_POST['prenom'];
                            $emailPost = $_POST['email'];

                            $user = new ModelUser();
                            var_dump($matriculePost);die;
                            $update = $user->updateUser($matriculePost, $nomPost, $prenomPost, $emailPost);
                            

                            
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
                    <input type='text' name='matricule' value="<?php echo $matriculeUser ?>" hidden>
                    <div class="col-md-6 mb-2">
                        <label for="input1" class="form-label">Nom</label>
                        <input type='text' name='nom' placeholder="nom" class="form-control" id="validationServer01" value="<?php if (isset($nomUser)) echo $nomUser ?>" required>
                        <div class="valid-feedback" id="validationServer01"></div>
                        <div class="invalid-feedback" id="validationServer01">Champ invalide</div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="input2" class="form-label">Prenom</label>
                        <input type="text" class="form-control" name="prenom" placeholder="prenom" id="validationServer02" value="<?php if (isset($prenomUser)) echo $prenomUser ?>" required>
                        <div class="valid-feedback"> </div>
                        <div class="invalid-feedback">Champ invalide</div>
                    </div>

                    <div class="col-md-8 mb-2">
                        <label for="input3" class="form-label">Email</label>
                        <input type="email" onchange="ValidateEmail()" class="form-control email" name="email" placeholder="email" id="validationServer03" value="<?php if (isset($emailUser)) echo $emailUser ?>" required>
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
                        <a href="editProfile.php" class="m-2  btn btn-danger col-sm-2">
                            <i class="spinOff">Annuler</i>
                        </a>
                    </div>

                    <span class="text text-center mt-2">
                        <p>Ecole de la reussite</p>
                    </span>
                </form>


            </div>

        </div>
    </div>
    </section>

    <footer class="d-flex justify-content-center mt-4">
        <div class="row col-md-10 pt-1">
            <div class=" d-flex justify-content-center">

                <p class="text-muted">Abdourahmane Diallo ©copyright 2022</p>
            </div>
        </div>
    </footer>

    <script src="js/inscription.js"></script>
    <script>
        function showHide() {

            const imgBlock = document.querySelector('.blockImg');
            const passwordBlock = document.querySelector('#passwordForm');

            if (imgBlock.style.display == "none") {
                imgBlock.style.display = "block";
                passwordBlock.style.display = "none"
            } else {
                imgBlock.style.display = "none"
                passwordBlock.style.display = "block"
            }
        }

        function showHideInfo() {

            const imgBlock = document.querySelector('#passwordForm');
            const passwordBlock = document.querySelector('.editBlock');
            
            if (imgBlock.style.display == "none") {
                imgBlock.style.display = "block";
                passwordBlock.style.display = "none"
            } else {
                imgBlock.style.display = "none"
                passwordBlock.style.display = "block"
            }
        }

        function togglePassword() {
            const togglePassword = document.querySelector('#togglePassword');

            const password = document.querySelector('.passwords');


            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';

            password.setAttribute('type', type);

            togglePassword.classList.toggle('bi-eye');
        }

        function togglePasswordConfirm() {
            const togglePassword = document.querySelector('#togglePasswordConfirm');

            const password = document.querySelector('.confirmPassword');

            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';

            password.setAttribute('type', type);

            togglePassword.classList.toggle('bi-eye');
        }

        function togglePasswordConfirm2() {
            const togglePassword = document.querySelector('#togglePasswordConfirm2');

            const password = document.querySelector('.confirmPassword2');

            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';

            password.setAttribute('type', type);

            togglePassword.classList.toggle('bi-eye');
        }
    </script>
</body>

</html>