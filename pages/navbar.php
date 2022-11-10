<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/navbar.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <title>page d'accueil</title>

</head>

<body>
    <nav class="navbar navbar-expand-lg bg-primary m-2 fixed-top" style="max-height: 8rem;">
        <div class="container-fluid shadow">

            <img src="../img/simplon.png" class="navbar-brand placeholder-glow p-2 img-thumbnail" height="50" height="50">

            <button class="navbar-toggler fs-1" onclick="hideShow()" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon bi bi-menu-button"></span>
            </button>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <ul class="navbar-nav me-auto mb-2 rounded  bg-light shadow  mb-lg-0" style="max-height: 6rem; min-width:70%;">
                    <span class="d-flex justify-content-between shadow w-100 ml-2">

                        <?php

                        if (isset($_SESSION['roles'])) {
                            if ($_SESSION['roles'] == "admin") {
                                echo '
                                            <span class="d-flex  ">
                                                <li class="nav-item nav-link ">
                                                    <a class="nav-link  btn-light border shadow  rounded-circle" title="Users" aria-current="page" href="accueil_admin.php">
                                                        <i class=" bi-people fs-1  p-2 fw-bolder " ></i>
                                                    </a>
                                                </li>
                                                <li class="nav-item nav-link ">
                                                    <a class="nav-link btn-light border shadow rounded-circle" title="Archives" href="archive_admin.php" data-toggle="tooltip" data-placement="bottom" title="Tooltip on bottom">
                                                        <i class=" bi-archive p-2 fs-1 fw-bolder" ></i>
                                                    </a>
                                                </li>    
                                                <li class="nav-item nav-link ">
                                                    <a class="nav-link btn-light border shadow rounded-circle" title="Archives" href="inscription.php" data-toggle="tooltip" data-placement="bottom" title="Tooltip on bottom">
                                                        <i class=" bi-person-plus p-2 fs-1 fw-bolder" ></i>
                                                    </a>
                                                </li>                              
                                            </span>
                                        ';
                            } else {
                                echo '
                                            <span class="d-flex  ">
                                                <li class="nav-item nav-link ">
                                                    <a class="nav-link  btn-light border shadow  rounded-circle" title="Users" aria-current="page" href="accueil_user.php">
                                                        <i class=" bi-people fs-1  p-2 fw-bolder " ></i>
                                                    </a>
                                                </li>
                                                
                                                                       
                                            </span>
                                        ';
                            }

                            echo '';
                        }
                        ?>


                        <hr class="divider">
                        <h5 class="text-muted">ÉCOLE DE LA RÉUSSITE </h5>


                        <li class=" nav-item  dropdown ">

                            <a class="nav-link  d-sm-flex justify-content-center shadow bg-body text-dark text-decoration-none" title="Avatar" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="max-height: 5.7rem;">

                                <?php

                                $db = new PDO('mysql:host=localhost;dbname=test;charset=UTF8', 'root', '');

                                if (isset($_SESSION['id'])) {
                                    $id = $_SESSION['id'];
                                }

                                $result = $db->query("SELECT * FROM images WHERE user='.$id.' ");

                                ?>

                                <?php if ($result) { ?>

                                    <?php

                                    while ($row = $result->fetch()) {



                                    ?>
                                        <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['photo']); ?>" class="rounded-circle border m-1   " height="40" />
                                    <?php

                                    } ?>



                                <?php } ?>
                                <p class="d-block">
                                    <?php
                                    if (isset($_SESSION['nom'], $_SESSION['prenom'], $_SESSION['matricule'])) {
                                        echo '<span class="d-none d-sm-inline ">' . $_SESSION['prenom'] . " " . $_SESSION['nom'] . '</span> <br>
                                                      <span class="d-none d-sm-inline ">' . $_SESSION['matricule'] . '</span>';
                                    }
                                    ?>

                                </p>

                            </a>
                            <ul class="dropdown-menu w-25" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="avatar.php"><i class=" bi-gear p-2 fs-1 fw-bolder"></i>profile</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="../index.php"><i class="bi bi-box-arrow-left p-2 fs-1"></i>Déconnecter</a></li>



                            </ul>
                        </li>
                    </span>

                </ul>

            </div>
        </div>
        </div>
    </nav>

    <script src="js/navbar.js"></script>
</body>

</html>