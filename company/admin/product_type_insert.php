<?php

    // 啟動 session 功能
    session_start();

    // 判斷 session 是否存在
    if(empty($_SESSION['admin_name']) or empty($_SESSION['admin_account'])){
        header('location: login.php');
    }

    
    $product_type = $_POST['product_type'];

    $host = 'localhost';     // 主機位址
    $db = 'Tina_11';         // 資料庫名稱
    $db_user = 'Tina_11';    // 帳號
    $db_pw = '0000';         // 密碼

    // 設定連線字串
    $conn = mysqli_connect($host, $db_user, $db_pw, $db);

    // 檢視連線結果
    //    echo var_dump($conn);

    if ($conn) {  
        // 改使用 mysqli_prepare() 來執行較為安全
        $sql = "INSERT INTO product_type (product_type) VALUES (?)";

        // 向資料庫下指令並取回資料
        $datas = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param(
            $datas, 
            's',
            $product_type
        );

        // 確認執行後的內容
        $check = mysqli_stmt_execute($datas);
        
        // 判斷是否新增成功
        if($check){
            // 強制轉址
            header('location: product_type.php');
        }
    }
?>
