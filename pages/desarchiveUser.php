<?php
    include '../models/model.php';
    
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $request= new ModelUser();
        $add = $request->desArchiveUser($id);
       if(!$add) header('location:archive_admin.php');
    }

?>