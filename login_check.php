<?php
    session_start();


    if(!empty($_POST['account'])){
        $account = $_POST['account'];
    }
    if(!empty($_POST['pw'])){
        $pw = $_POST['pw'];
    }

    $host = 'localhost';     // 主機位址
    $db = 'Tina_11';         // 資料庫名稱
    $db_user = 'Tina_11';    // 帳號
    $db_pw = '0000';         // 密碼

    // 設定連線字串
    $conn = mysqli_connect($host, $db_user, $db_pw, $db);

    // 檢視連線結果
    //    echo var_dump($conn);

    if ($conn) {
        // 設定 SQL 查詢指令
        $sql = "SELECT * FROM admin WHERE admin_account = '$account'";
        // 向資料庫下指令並取回資料
        $data = mysqli_query($conn, $sql);

        // 如果有該帳號
        if(mysqli_num_rows($data)>0){
            $row = mysqli_fetch_assoc($data);
            if(password_verify($pw, $row['admin_pw'])){
                // echo '登入成功';
                $_SESSION['admin_name'] = $row['admin_name'];
                $_SESSION['admin_account'] = $row['admin_account'];
                // echo $_SESSION['admin_name'];
                // echo '<br>';
                // echo $_SESSION['admin_account'];

                // 登入成功後回到管理頁
                header('location: 15.php');
            }else{
                echo '登入錯誤，請檢查密碼';
                // 登入錯誤時, 清空 session
                session_destroy();
            }
        }else{
            echo '查無此帳號';
            // 登入錯誤時, 清空 session
            session_destroy();
        }
    }
?>