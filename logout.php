<?php
    session_start();
    // 刪除所有 session
    session_destroy();

    header('location: 15.php');
?>