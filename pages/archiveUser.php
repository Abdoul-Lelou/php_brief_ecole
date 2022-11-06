<?php
    include '../models/model.php';

    // var_dump($_GET['id']);die;
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $request= new ModelUser();
        $add = $request->archiveUser($id);
       if(!$add) header('location:accueil_admin.php');
    }

?>
