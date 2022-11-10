<?php
    session_start();
    class ModelUser 
    {
        var $db;
        public function __construct()
        { 
            try
            {

                $this->db= new PDO('mysql:host=127.0.0.1;dbname=test;','root','');
            }catch(Exception $e){
                die("Connection erreur du à ".$e->getMessage());
            }
        }  
        
        
        public function login($email,$passwords){
            
            try {
                $sql = $this->db->prepare('SELECT id,email,passwords,roles,nom,prenom,matricule,etat,date_inscrit FROM user WHERE email=:email');
                $sql->execute(['email' => $email]);
                $donnee = $sql->fetch();
                    if (!$donnee) {
                        return "Ce compte n'existe pas!";
                    }
                     $verifyPassword = password_verify($passwords, $donnee['passwords']);
                    if ($donnee['email'] == $email &&  $verifyPassword && $donnee['etat'] == 1) {              
                        $_SESSION['id'] = $donnee['id'];
                        $_SESSION['roles'] = $donnee['roles'];
                        $_SESSION['email'] = $donnee['email'];
                        $_SESSION['nom'] = $donnee['nom'];
                        $_SESSION['password'] = $donnee['passwords'];
                        $_SESSION['prenom'] = $donnee['prenom'];
                        $_SESSION['matricule'] = $donnee['matricule'];
                        $_SESSION['date_inscrit'] = $donnee['date_inscrit'];
                        
                        if($donnee['roles'] =='admin')
                            header('location:pages/accueil_admin.php');
                        else
                            header('location:pages/accueil_user.php');
                    }elseif (!$verifyPassword) {
                        return "Mot de passe incorrect!";
                    }elseif ($donnee['email'] != $email) {
                        return "Email incorrect!";
                    }else{
                        return "Vous êtez archivé!";
                    }
                    
            }catch(\Throwable $th) {
                echo $th->getMessage();
                $sql->closeCursor();
            }
        }

        function generateMatricule($n=3) {
            $characters = '0123456789ABCDEFGHIJKLMNOPKRSTUVWXYZ';
            $randomString = '';
            for ($i = 0; $i < $n; $i++) {
                $index = rand(0, strlen($characters) - 1);
                $randomString .= $characters[$index];
            }

            return $randomString;
        }
        
        public function addUser($nom,$prenom,$email,$passwords,$roles){
            $etat = 1;
   
            $roles =='admin' ? $matricule = 'MAD'.$this->generateMatricule() :  $matricule = 'MEM'.$this->generateMatricule();
            $date_inscription = date("Y-m-d H:i:s");
            try {

                $sql=$this->db->prepare('INSERT INTO `user` ( `nom`, `prenom`,`passwords`,`roles`,`matricule`,`email`,`date_inscrit`,`etat`)
                                            VALUES (:nom,:prenom,:passwords,:roles,:matricule,:email,:date_inscrit,:etat)');
                
                $checkMail =$this->db->prepare('SELECT 1 FROM user WHERE email=:email');
                $checkMail->bindParam(":email",$email);

                $checkMail->execute();

                $row = $checkMail->fetch(PDO::FETCH_ASSOC); 
                if ($row == 0 ) {                   
                    $sql->execute(array(
                        
                        'nom' =>$nom,
                        'prenom' => $prenom,
                        'passwords' => password_hash($passwords,PASSWORD_DEFAULT),
                        'roles' => $roles,
                        'matricule' => $matricule,
                        'email' => $email,
                        'date_inscrit' => $date_inscription,
                        'etat' => $etat
                    ));

                    // $userId = 

                    return "Utilisateur ajouté";
                }else{
                    return "email existe déjà";
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

        public function updateUser($matricule,$nom,$prenom,$email){
            $date_modif = date("Y-m-d H:i:s");
            try {

                $sql=$this->db->prepare("UPDATE `user` SET `nom`='$nom',`prenom`='$prenom',`email`='$email', `date_modif`='$date_modif' WHERE matricule='$matricule'");
                
                $checkMail =$this->db->prepare('SELECT email FROM user WHERE email=:email and matricule !=:matricule');
                $checkMail->bindParam(":email",$email);
                $checkMail->bindParam(":matricule",$matricule);


                $checkMail->execute();

                $row = $checkMail->fetch(PDO::FETCH_ASSOC);
               
                if (!$row) {   
                    $sql->execute();
                    return $sql;
                }else {
                    return null;
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

        public function updatePassword($oldPassword,$newPassword){
            $date_modif = date("Y-m-d H:i:s");
            $newPassword = password_hash($newPassword,PASSWORD_DEFAULT);
            if (isset($_SESSION['password'], $_SESSION['id'])) {
                $verifyPassword = password_verify($oldPassword, $_SESSION['password']);
                $id = $_SESSION['id'];
            }

            if($verifyPassword){
                try {
                    $sql=$this->db->prepare("UPDATE `user` SET `passwords`='$newPassword', `date_modif`='$date_modif' WHERE id='$id'");               
                    $sql->execute();
                    return "Password modifié";                      
                } catch (\Throwable $th) {

                    echo ' 
                            <div   class="d-flex justify-content-center" role="alert">
                                <span class="badge bg-danger border border-danger">'.$th->getMessage().'</span>
                            </div>          
                        ';
                }
            }else{
                return "Password incorrect!";
            }
        }
       
        public function archiveUser($id){
            try{
                $sql=$this->db->query("UPDATE `user` SET `etat` = '0', `date_archive`= now() WHERE `user`.`id` ='$id'");
                return $sql->fetch();
            } catch(\Throwable $th) {
                return "erreur survenue ".$th->getMessage();
            }
        }

        public function desArchiveUser($id){
            try{
                $sql=$this->db->prepare('UPDATE user SET etat=1 WHERE id=:id');
                $sql->execute(['id'=>$id]);

                 return $sql();
            } catch(\Throwable $th) {
                echo $th->getMessage();
                $sql->closeCursor();
            }
        }

        public function switchRole($id){
            try{
               
                $checkMail =$this->db->query('SELECT roles FROM user WHERE id ='.$id.'');
                $checkMail->execute();
                $roles= $checkMail->fetch();
                $roleEmployer = $roles['roles'];
                if ($roleEmployer =='admin') {
                        $sql=$this->db->query("UPDATE `user` SET `roles` = 'employer' WHERE `user`.`id` ='$id'");
                        $sql->execute();
                        return $sql->fetch();
                    }else{
                        $sql=$this->db->query("UPDATE `user` SET `roles` = 'admin' WHERE `user`.`id` ='$id'");
                        $sql->execute();
                        return $sql->fetch();
                    }                   
            } catch(\Throwable $th) {
                return "erreur survenue ".$th->getMessage();
            }
        }

        public function getUserById($id){
            try{
                $sql=$this->db->prepare('SELECT * FROM user where id=:id LIMIT 1');
                $sql->execute(['id'=>$id]);
        
                return $sql->fetch();
            } catch(\Throwable $th) {
                echo $th->getMessage();
                $sql->closeCursor();
            }
        }

        public function getUserByRole($roles){
            try {
                $sql=$this->db->prepare('SELECT * FROM user WHERE roles =:roles ');
                $sql->execute(array('roles'=>$roles));

                return $sql->fetch();
             
            } catch (\Throwable $th) {
                echo $th->getMessage();
                $sql->closeCursor();
            }

        }
    
    }