<?php
    session_start();
    session_destroy();
    setcookie('id_patner', '', 0, '/');
    header("Location:login");
?>