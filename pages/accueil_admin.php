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
    <script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.3/bootbox.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.3/bootbox.js"></script>
    <title>page d'accueil</title>
    <title>List_Planing</title>
</head>

<body class="bg-body">
    <header class="head">
        <?php
        session_start();
        include('navbar.php');
        if (isset($_SESSION['email'])) {
            $email_login = $_SESSION['email'];
        }
        $bdd = new PDO('mysql:host=localhost;dbname=test;charset=UTF8', 'root', '');
        $reponse = $bdd->query('SELECT COUNT(*) AS total FROM `user` WHERE `etat`= 1');
        $total_lignes = $reponse->fetch()['total'];
        $limite = 5;
        $nbre_pages = ceil($total_lignes / $limite);

        $page = (isset($_GET['page']) and $_GET['page'] > 0) ? $_GET['page'] : 1;
        $page = (isset($_GET['page']) and $_GET['page'] > $nbre_pages) ? $nbre_pages : $page;
        $debut = ($page - 1) * $limite;



        $reponse = $bdd->prepare('SELECT * FROM user WHERE `etat`= 1  ORDER BY ID ASC LIMIT :debut, :limite');
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
    </header>

    <?php


    ?>


    <div class="col-md-12  d-flex justify-content-center tableParent ">

        <div class="table-responsive shadow border  col-md-8">
            <form action="accueil_admin.php" method="post" class="d-flex justify-content-end pb-4   needs-validation m-4" novalidate>
                <div class="col-md-3 p-2 shadow position-fixed">
                    <input type='text' name='search' placeholder="search...matricule" class="form-control" id="validationServer01" required>
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
                        <th scope="col">Actions</th>
                    </tr>
                </thead>

                <tfoot>
                    <tr>
                        <th colspan="7">
                            <nav aria-label="Page navigation example d-flex justify-content-center">
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
                                                        <span class="disabled" aria-hidden="true">' . $i . '</span>
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
                                            <a class="page-link pe-none disabled" href="?page=<?php echo $page - 1; ?>" aria-label="Previous">
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
                    $count = 1;

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
                                echo "<td>  

                                <span class='d-flex'>                       
                                    <button id='edit' data-id='".$searchQuery['id']."' data-toggle='modal' data-target='.bd-edit-modal-sm'  class=' edit btn btn-outline-success' title='Modifier'><i class='bi bi-pen'></i></button>                    
                                    <button  class='archive btn btn-outline-info' data-id='".$searchQuery['id']."' data-toggle='modal' data-target='.bd-archive-modal-sm'  title='Archiver'><i class='bi bi-archive'></i></button>";
                                    if ($searchQuery["roles"] == "admin")
                                        echo "<button data-id='".$searchQuery['id']."' data-toggle='modal' data-target='.bd-role-modal-sm'  class='role btn btn-outline-warning' title='Switch role'><i class='bi bi-toggle-on'></i></button>";
                                    else  echo "<button data-id='".$searchQuery['id']."' data-toggle='modal' data-target='.bd-role-modal-sm'  class='role btn btn-outline-danger' title='Switch role'><i class='bi bi-toggle-off'></i></button>";
                                "</span>";


                                "</td>";

                                
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
                            if ($donnees = $reponse->fetch()) {
                                echo '<td class="text-dark">' . $count++ . '</td>';
                                echo '<td class="text-dark">' . $donnees['nom'] . '</td>';
                                echo '<td>' . $donnees['prenom'] . '</td>';
                                echo '<td>' . $donnees['email'] . '</td>';
                                echo '<td>' . $donnees['matricule'] . '</td>';
                                echo '<td>' . $donnees['roles'] . '</td>';
                                echo "<td>  

                                <span class='d-flex'>                       
                                    <button id='edit' data-id='".$donnees['id']."' data-toggle='modal' data-target='.bd-edit-modal-sm'  class=' edit btn btn-outline-success' title='Modifier'><i class='bi bi-pen'></i></button>                    
                                    <button  class='archive btn btn-outline-info' data-id='".$donnees['id']."' data-toggle='modal' data-target='.bd-archive-modal-sm'  title='Archiver'><i class='bi bi-archive'></i></button>";
                                    if ($donnees["roles"] == "admin")
                                        echo "<button data-id='".$donnees['id']."' data-toggle='modal' data-target='.bd-role-modal-sm'  class='role btn btn-outline-warning' title='Switch role'><i class='bi bi-toggle-on'></i></button>";
                                    else  echo "<button data-id='".$donnees['id']."' data-toggle='modal' data-target='.bd-role-modal-sm'  class='role btn btn-outline-danger' title='Switch role'><i class='bi bi-toggle-off'></i></button>";
                                "</span>";


                                "</td>";
                            } else {
                            }
                            echo '</tr>';
                        }
                    }


                    ?>
                </tbody>

            </table>
            

            <div class="modal fade bd-archive-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content p-4">

                        <div class="col-md-12">
                            <h3>Voulez-vous archiver</h3>
                            <div class="d-flex justify-content-center">
                                <span class="m-1">
                                    <a type="submit" class=" confirmArchive m-2 btn btn-outline-danger col-md-12">Archiver</a>
                                </span>
                                <span class="m-1">
                               
                                    <a  data-dismiss="modal" class=" m-2 btn btn-outline-primary col-md-12">Annuler</a>
                                </span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="modal fade bd-edit-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content p-4">

                        <div class="col-md-12">
                            <h3>Voulez-vous modifier</h3>
                            <div class="d-flex justify-content-center">
                                <span class="m-1">
                                    <a type="submit" class=" confirmEdit m-2 btn btn-outline-danger col-md-12">Modifier</a>
                                </span>
                                <span class="m-1">
                               
                                    <a  data-dismiss="modal" class=" m-2 btn btn-outline-primary col-md-12">Annuler</a>
                                </span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="modal fade bd-role-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content p-4">

                        <div class="col-md-12">
                            <h3>Voulez-vous switcher </h3>
                            <div class="d-flex justify-content-center">
                                <span class="m-1">
                                    <a type="submit" class=" confirmRole m-2 btn btn-outline-danger col-md-12">Oui</a>
                                </span>
                                <span class="m-1">
                                    <a  data-dismiss="modal" class=" m-2 btn btn-outline-primary col-md-12">Annuler</a>
                                </span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="js/admin.js"></script>
    <script>
        $(document).ready(function() {
            let id=""
            
            $(".edit").on("click", function() {
               id = $(this).attr("data-id");    
            });

            $(".confirmEdit").on("click", function() {
                document.location = "editUser.php?id=" +id;
            });

            $(".archive").on("click", function() {
               id = $(this).attr("data-id");    
            });

            $(".confirmArchive").on("click", function() {
                document.location = "archiveUser.php?id=" +id;
            });

            $(".role").on("click", function() {
               id = $(this).attr("data-id");    
            });

            $(".confirmRole").on("click", function() {
                document.location = "switchRole.php?id=" +id;
            });
        });
    </script>

</body>

</html>
