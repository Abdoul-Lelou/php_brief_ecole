<?php
    include '../models/model.php';


    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $request= new ModelUser();
        $add = $request->switchRole($id);
        if(!$add) header('location:accueil_admin.php');
    }

?>