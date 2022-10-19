<?php
    class ModelUser 
    {
        var $db;
        public function __construct()
        { 
            try
            {

                $this->db= new PDO('mysql:host=127.0.0.1;dbname=ecole_reussite;','root','');
            }catch(Exception $e){
                die("Connection erreur du à ".$e->getMessage());
            }
        }  
            
        function redirectUrl ($url){
            echo '<script language="javascript">window.location.href ="'.$url.'"</script>';
        }
        
        function setTimeout($fn, $timeout){
            sleep(($timeout/1000));
            $fn();
        }
        
        
        public function connecter($username,$passwords){
            session_start();
            try {
                $sql = $this->db->prepare('SELECT * FROM user');
                $sql->execute();
                while ($donnee = $sql->fetch()) {
                
                    if ($donnee['username'] == $username && $donnee['passwords'] == $passwords && $donnee['etat'] == 0) {              
                        $_SESSION['roles'] = $donnee['roles'];
                        $_SESSION['username'] = $donnee['username'];
                        header('location:pages/accueil.php');
                    } 
                    // elseif ($donnee['username'] != $username) {
                    //     return "username incorrect";
                    // } elseif ($donnee['passwords'] != $passwords) {
                    //     return "password incorrect";
                    // } else {
                    //     return "Vous etes archiver ";
                    // }
            }
            }catch(\Throwable $th) {
                echo $th->getMessage();
                $sql->closeCursor();
            }
        }


        function generateMatricule($n=3) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
            $randomString = '';
        
            for ($i = 0; $i < $n; $i++) {
                $index = rand(0, strlen($characters) - 1);
                $randomString .= $characters[$index];
            }
        
            return 'MAE'.$randomString;
        }
        
        public function addUser($nom,$prenom,$age,$sexe,$username,$passwords,$roles,$matricule,$lieu_naissance,$email,$tel){
            $etat = 0;
            try {

                $sql=$this->db->prepare('INSERT INTO `user` ( `nom`, `prenom`, `age`, `sexe`,`username`,`passwords`,`roles`,`matricule`,`lieu_naissance`,`email`,`tel`,`etat`)
                                            VALUES (:nom,:prenom,:age,:sexe,:username,:passwords,:roles,:matricule,:lieu_naissance,:email,:tel,:etat)');
                
                $checkMail =$this->db->prepare('SELECT 1 FROM user WHERE email=:email');
                $checkTel =$this->db->prepare('SELECT 1 FROM user WHERE tel=:tel');
                $checkMail->bindParam(":email",$email);
                $checkTel->bindParam(":tel",$tel);

                $checkMail->execute();
                $checkTel->execute();

                $row = $checkMail->fetch(PDO::FETCH_ASSOC);
            
                if (!$row) {
                    
                    $sql->execute(array(
                        
                        'nom' =>$nom,
                        'prenom' => $prenom,
                        'age' => $age,
                        'sexe' => $sexe,
                        'username' => $username,
                        'passwords' => $passwords,
                        'roles' => $roles,
                        'matricule' => $matricule,
                        'lieu_naissance' => $lieu_naissance,
                        'email' => $email,
                        'tel' => $tel,
                        'etat' => $etat
                    ));
                    // return $sql;
                    if ($sql) {
                     
                        echo ' 
                            <div class="w-75 h-25 mb-auto d-flex justify-content-center">
                                <div class="alert alert-primary" role="alert">
                                    Inscription reussie!
                                </div>
                            </div>
                            
                             ';
                             $this->setTimeout($this->redirectUrl("http://localhost/ecole_reussite/"),3000);
                        $sql->closeCursor();
                    }
                }else {
                    echo ' 
                            
                                
                            <script>alert("Email existe déjà!")</script>
                             ';
                 

                    
                    $sql->closeCursor();
                }
                

                    
            } catch (\Throwable $th) {

                echo ' 
                        <div   class="d-flex justify-content-center" role="alert">
                            <span class="badge bg-danger border border-danger">'.$th->getMessage().'</span>
                        </div>          
                     ';
                 
                $sql->closeCursor();
            }
        }
       
        public function archiveUser($id){
            try{
                $sql=$this->db->prepare('UPDATE user SET etat=1 WHERE id=:id');
                $sql->execute(['id'=>$id]);

                 return $sql();
            } catch(\Throwable $th) {

            }
        }

        public function desArchiveUser($id){
            try{
                $sql=$this->db->prepare('UPDATE user SET etat=0 WHERE id=:id');
                $sql->execute(['id'=>$id]);

                 return $sql();
            } catch(\Throwable $th) {

            }
        }

        public function getUser(){

        }

        public function getUserById($id){
            try{
                    $sql=$this->db->prepare('SELECT * FROM user where id=:id');
                    $sql->execute(['id'=>$id]);
            
                    return $sql->fetchAll();
            }  catch(\Throwable $th) {
                echo $th->getMessage();
                $sql->closeCursor();
            }
        }

        public function getUserByRole($roles){
            try {
                $sql=$this->db->prepare('SELECT * FROM user WHERE roles =:roles ');
                $sql->execute(array('roles'=>$roles));

                return $sql->fetch();
             
                // return $sql;
            } catch (\Throwable $th) {
                //throw $th;
                $sql->closeCursor();
            }

        }

    
        
    }