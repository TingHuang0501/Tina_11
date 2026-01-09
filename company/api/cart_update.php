<?php
    $cart_id = $_POST['cid'];
    $count = $_POST['count'];
        
    $host = 'localhost';     // 主機位址
    $db = 'Tina_11';         // 資料庫名稱
    $db_user = 'Tina_11';    // 帳號
    $db_pw = '0000';         // 密碼

    // 設定連線字串
    $conn = mysqli_connect($host, $db_user, $db_pw, $db);

    // 檢視連線結果
    // echo var_dump($conn);

    if ($conn) {
        $sql = "UPDATE cart SET cart_count = '$count' WHERE cart_id = '$cart_id'";

        // 向資料庫下指令並取回資料
        $data = mysqli_query($conn, $sql);
        if ($data) {
            $temp['data']="修改成功";
            $temp['msg']='success';
            // 將 $temp 轉換為 JSON 字串, 並存在 $api 中
            $api = json_encode($temp, JSON_UNESCAPED_UNICODE);
            // 將api 列印在頁面上
            echo $api;
        }
    }