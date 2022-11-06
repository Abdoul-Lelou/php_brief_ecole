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
    <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/admin.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.3/bootbox.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.3/bootbox.js"></script> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

    <title>Document</title>
</head>

<body>
    <?php

    include('navbar.php');
    ?>

    <div class="container py-5 h-100 ">
        <div class="row d-flex justify-content-center align-items-center h-100 ">
            <div id="passwordBlock" class="col col-lg-6 mb-4  mb-lg-0 bg-dark">

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

                    <div class=" row d-flex justify-content-center">
                        <div class="col-md-8">
                            <label for="input6" class="form-label">Password</label>
                            <input type="password" class="form-control" name="passwords" placeholder="password" id="validationServer05" required>
                            <div class="valid-feedback"></div>
                            <div class="invalid-tooltip">Champ invalide</div>
                        </div>
                        <div class="col-md-8">
                            <label for="input6" class="form-label">New Password</label>
                            <input type="password" class="form-control passwords" name="newPasswords" placeholder="nouveau password" id="validationServer05" required>
                            <div class="valid-feedback"></div>
                            <div class="invalid-tooltip">Champ invalide</div>
                        </div>
                        <div class="col-md-8">
                            <label for="input6" class="form-label">Confirm new Password</label>
                            <input type="password" onchange="checkPassword()" class="form-control confirmPassword" name="confirmPassword" placeholder="confirmer password" id="validationServer06" required>
                            <div class="valid-feedback"></div>
                            <div class="invalid-tooltip">Champ invalide</div>
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
                            <button type="button" onclick="showHide()" class="btn btn-outline-secondary"><i class="bi bi-camera fs-1 fw-bolder"></i></button>
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
            const passwordBlock = document.querySelector('#passwordBlock');

            if (imgBlock.style.display == "none") {
                imgBlock.style.display = "block";
                passwordBlock.style.display = "none"
            } else {
                imgBlock.style.display = "none"
                passwordBlock.style.display = "block"
            }
        }
    </script>
</body>

</html>