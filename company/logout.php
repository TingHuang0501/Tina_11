<?php
    include_once('include/config.php');
    // 刪除所有 session
    session_destroy();

    header('location: '.URL.'login.php');
?>