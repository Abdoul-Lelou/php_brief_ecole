<?php
    session_start();
    session_destroy();
    sleep(2000);
    header("location:/ecole_project/")
?>