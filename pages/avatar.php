<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Document</title>
</head>
<body>
   <?php include 'navbar.php' ?> 

  <div class="container py-5 h-100 ">
    <div class="row d-flex justify-content-center align-items-center h-100 ">
      <div class="col col-lg-6 mb-4  mb-lg-0 bg-body ">
        <div class="card mb-3 mt-3" style="border-radius: .5rem;">
          <div class="row g-0 ">
            <div class="col-md-4 shadow bg-primary gradient-custom text-center text-dark"
              style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
              <?php  
                  $db = new PDO('mysql:host=localhost;dbname=test;charset=UTF8', 'root', '');
                  
                  if (isset($_SESSION['id'])) {
                      $id = $_SESSION['id'];
                  }
                  $result = $db->query("SELECT * FROM images WHERE user='.$id.' "); 
                 
                  ?>

                  <?php if($result){ ?> 
                     
                          <?php while($row = $result->fetch()){ ?> 
                              <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['photo']); ?>" alt="Avatar" class="img-fluid my-5 rounded" style="width: 80px;" /> 
                          <?php } ?> 
                     
                  <?php }else{ ?> 
                      <p class="status error">Image(s) not found...</p> 
                  <?php } ?>
              
              <h5 class="text-dark">
                <?php 
                    
                   if (isset($_SESSION['prenom'])) {
                    echo '<p class="text-dark text-bold">'.$_SESSION['prenom'].'</p>';
                    echo '<p class="text-dark">'.$_SESSION['nom'].'</p>';
                   }
                ?>
              </h5>
              <a href="editProfile.php  " title="Modifier">
                <i class="fa fa-edit text-dark " style="font-size:28px;"></i>
              </a>
            </div>
            <div class="col-md-8 ">
              <div class="card-body p-4 shadow">
                <h6>Information</h6>
                <hr class="mt-0 mb-4">
                <div class="row pt-1">
                    <div class="col-6 mb-3">
                        <h6>Email</h6>
                        <?php    
                          if (isset($_SESSION['email'])) {
                            echo '<p class="text-muted">'.$_SESSION['email'].'</p>';
                          }
                        ?>
                    </div>
                    <div class="col-6 mb-3">
                        <h6>Rôle</h6>
                        <?php    
                          if (isset($_SESSION['roles'])) {
                            echo '<p class="text-muted">'.$_SESSION['roles'].'</p>';
                          }
                        ?>
                    </div>
                    <div class="col-6 mb-3">
                      <h6>Matricule</h6>
                      <?php    
                          if (isset($_SESSION['matricule'])) {
                            echo '<p class="text-muted">'.$_SESSION['matricule'].'</p>';
                          }
                        ?>
                    </div>
                  <div class="col-6 mb-3">
                    <h6>Date inscription</h6>
                    <?php    
                        if (isset($_SESSION['date_inscrit'])) {
                          echo '<p class="text-muted">'.$_SESSION['date_inscrit'].'</p>';
                        }
                      ?>
                  </div>
                </div>
              
                <hr class="mt-0 mb-4">
                <div class="row pt-1">
                  <div class="col-10 mb-3">
                    
                    <p class="text-muted">Abdourahmane Diallo ©copyright 2022</p>
                  </div>
                </div>
                <div class="d-flex justify-content-start">
                  <a href="#!"><i class="fab fa-facebook-f fa-lg me-3"></i></a>
                  <a href="#!"><i class="fab fa-twitter fa-lg me-3"></i></a>
                  <a href="#!"><i class="fab fa-instagram fa-lg"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>