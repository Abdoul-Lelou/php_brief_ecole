<?php

require 'models/model.php';

if (isset($_POST['email'], $_POST['passwords'])) {
    $requeste = new ModelUser();
    $email = $_POST['email'];
    $passwords = $_POST['passwords'];

    $data = $requeste->login($email, $passwords);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Page CONNEXION</title>
</head>

<body>

    <div class=" container d-flex justify-content-center mt-5">
        <div class="col-md-8 ">

            <div class="d-flex justify-content-center ">

                <form action="index.php" novalidate method="post" class="row  border d-block bg-light col-md-8 p-2   bg-body shadow rounded needs-validation">
                    <nav class="navbar border bg-primary shadow ">
                        <div class="container d-flex justify-content-center">
                            <a class="navbar-brand  text-center " href="#">
                                <span class="text-center text-dark"> CONNEXION </span>
                            </a>
                        </div>
                    </nav>
                    <?php
                    if (isset($data)) {
                        echo'
                            <span class="d-flex justify-content-center text" role="alert">
                                <span class="badge bg-danger border">' . $data . '</span>
                            </span> 
                            <script>
                                setTimeout(()=>{
                                    document.querySelector(".text").remove();
                                },3000);
                            </script>
                        ';
                    }
                    ?>

                    <div class="col-md-12 p-2">
                        <label for="email">Email</label>
                        <input type="email" onchange="ValidateEmail()" name="email" placeholder="email" class="form-control email" id="validationServer01" required >
                        <div class="valid-feedback"></div>
                        <div class="invalid-feedback">champ invalide</div>
                        <div class="invalid-email" style="display: none; color:red;">Email invalide</div>
                    </div>

                    <div class="col-md-12 p-2">
                        <label for="password">Password</label>
                        <input type="password" name="passwords" placeholder="password" class="form-control " id="validationServer02" required>
                        <div class="valid-feedback"></div>
                        <div class="invalid-feedback">champ invalide</div>
                    </div>

                    <div class=" d-flex justify-content-center mt-2">
                        <button type="submit" onclick=" btnLoad()" class="m-2 btn btn-success col-sm-4">
                            <i class="spinOff">Connexion</i>
                            <i class="spinOn" style="display: none">
                                <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                                Loading...
                            </i>
                        </button>

                    </div>

                    <span class="text text-center mt-2">
                        <p>Vous n'avez pas de compte?
                            <a href="pages/inscription_logout.php" style="text-decoration:none;">s'inscrire</a>
                        </p>
                    </span>
                </form>





            </div>
        </div>

    </div>
    <script src="pages/js/index.js"></script>


</body>

</html>



        