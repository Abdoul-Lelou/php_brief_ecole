<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/admin.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <title>page d'accueil</title>
    <title>List_Planing</title>
</head>

<body class="bg-body">
    <header class="head">
        <?php
        session_start();
        include('navbar.php');
        ?>
    </header>

    <?php
    
    $bdd = new PDO('mysql:host=localhost;dbname=test;charset=UTF8', 'root', '');
    $reponse = $bdd->query('SELECT COUNT(*) AS total FROM `user` WHERE `etat`= 0');
    $total_lignes = $reponse->fetch()['total'];
    $limite = 5;
    $nbre_pages = ceil($total_lignes / $limite);

    $page = (isset($_GET['page']) and $_GET['page'] > 0) ? $_GET['page'] : 1;
    $page = (isset($_GET['page']) and $_GET['page'] > $nbre_pages) ? $nbre_pages : $page;
    $debut = ($page - 1) * $limite;



    $reponse = $bdd->prepare('SELECT * FROM user WHERE `etat`= 1 ORDER BY ID ASC LIMIT :debut, :limite');
    $reponse->bindValue('debut', $debut, PDO::PARAM_INT);
    $reponse->bindValue('limite', $limite, PDO::PARAM_INT);
    $reponse->execute() || die('Impossible de charger la page');

    $searchState = false;
    if (isset($_POST['search'])) {
        $search = $_POST['search'];
        $sql = $bdd->prepare('SELECT id,email,passwords,roles,nom,prenom,matricule,etat,date_inscrit FROM user WHERE matricule=:matricule and etat=1');
        $sql->execute(['matricule' => $search]);
        $searchQuery = $sql->fetch();
        $searchState = true;
        
    }

    ?>


    <div class="col-md-12  d-flex justify-content-center tableParent ">
        <div class="table-responsive shadow border  col-md-8">
            <form action="accueil_user.php" method="post" class="d-flex justify-content-end pb-4   needs-validation m-4" novalidate>
                <div class="col-md-3 p-2 shadow position-fixed">
                    <input type='text' name='search' placeholder="search..." class="form-control" id="validationServer01" required autocomplete="false">
                    <div class="valid-feedback"></div>
                    <div class="invalid-tooltip">Champ invalide</div>
                </div>
                &nbsp;
                <button type="submit" class="btn  rounded-circle position-fixed" onclick="hideMsg()">
                    <i class=" bi-search fs-2  fw-bolder "></i>
                </button>
            </form>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Prenom</th>
                        <th scope="col">Email</th>
                        <th scope="col">Matricule</th>
                        <th scope="col">Rôles</th>
                        <th scope="col">Date_inscription</th>

                    </tr>
                </thead>

                <tfoot>
                    <tr>
                        <th colspan="7">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination"> 
                                <?php
                            if ($page > 1) {
                                ?>
                                <li class="page-item">   
                                    <a class="page-link" href="?page=<?php echo $page - 1; ?>" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                            <?php
                            } else {
                                echo '
                                    <li class="page-item">   
                                        <a class="page-link pe-none  disabled "  href="?page=<?php echo $page - 1; ?>" aria-label="Previous">
                                            <span class="disabled " aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                ';
                            }

                            for ($i = 1; $i <= $nbre_pages; $i++) {
                                if ($i != $page) {
                                    echo '<li class="page-item"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
                                } else {
                                    
                                    echo '
                                        <li class="page-item">   
                                        <a class="page-link border border-success"  href="#" aria-label="Previous">
                                            <span class="disabled" aria-hidden="true">'. $i .'</span>
                                        </a>
                                    </li>
                                    ';

                                }
                            }
                            if ($page < $nbre_pages) {
                            ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page=<?php echo $page + 1; ?>" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            <?php
                            } else {
                            ?>
                                <li class="page-item">   
                                    <a class="page-link pe-none disabled"  href="?page=<?php echo $page - 1; ?>" aria-label="Previous">
                                        <span class="disabled" aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            <?php
                            }
                            ?>
                            </ul>
                        </nav>
                        </th>
                    </tr>
                </tfoot>

                <tbody>
                  
                     <?php
                        $count=1;
                        

                        if ($searchState) {
                            if (isset($searchQuery) && $searchQuery) {
                                for ($i = 0; $i < 1; $i++) {
                                    $debut++;
                                    
                                    echo '<tr>';                       
                                        
                                            echo '<td class="text-dark">' . $count++ . '</td>';
                                            echo '<td class="text-dark">' . $searchQuery['nom'] . '</td>';
                                            echo '<td>' . $searchQuery['prenom'] . '</td>';
                                            echo '<td>' . $searchQuery['email'] . '</td>';
                                            echo '<td>' . $searchQuery['matricule'] . '</td>';
                                            echo '<td>' . $searchQuery['roles'] . '</td>';
                                            echo '<td>' . $searchQuery['date_inscrit'] . '</td>';
                                    echo '</tr>';
    
                                }
                            } else {
                                echo '
                                    <td class="text-dark">
                                        <span class="badge bg-danger">Introuvable</span>
                                    </td>
                                    <td class="text-dark">
                                        <span class="badge bg-danger">Introuvable</span>
                                    </td>
                                    <td class="text-dark">
                                        <span class="badge bg-danger">Introuvable</span>
                                    </td>
                                    <td class="text-dark">
                                        <span class="badge bg-danger">Introuvable</span>
                                    </td>
                                    <td class="text-dark">
                                        <span class="badge bg-danger">Introuvable</span>
                                    </td>
                                    <td class="text-dark">
                                        <span class="badge bg-danger">Introuvable</span>
                                    </td>
                                    <td class="text-dark">
                                        <span class="badge bg-warning">Aucune action</span>
                                    </td>
                                ';
                            }
                            
                            
                        } else {
                            for ($i = 0; $i < $limite; $i++) {
                                $debut++;
                                
                                echo '<tr>';                       
                                    if ($donnees = $reponse->fetch() ) {
                                        echo '<td class="text-dark">' . $count++ . '</td>';
                                        echo '<td class="text-dark">' . $donnees['nom'] . '</td>';
                                        echo '<td>' . $donnees['prenom'] . '</td>';
                                        echo '<td>' . $donnees['email'] . '</td>';
                                        echo '<td>' . $donnees['matricule'] . '</td>';
                                        echo '<td>' . $donnees['roles'] . '</td>';
                                        echo '<td>' . $donnees['date_inscrit'] . '</td>';
    
                                    } else {
                                       
                                    }
                                echo '</tr>';
                            }
                        }
                    ?>
                </tbody>

            </table>
        </div>
    </div>

    <script src="js/admin.js"></script>

</body>

</html>