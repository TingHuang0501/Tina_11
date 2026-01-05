<?php
    $type_id = isset($_GET['type']) ? $_GET['type'] : '%';
        
    $host = 'localhost';     // 主機位址
    $db = 'Tina_11';         // 資料庫名稱
    $db_user = 'Tina_11';    // 帳號
    $db_pw = '0000';         // 密碼

    // 設定連線字串
    $conn = mysqli_connect($host, $db_user, $db_pw, $db);

    // 檢視連線結果
    // echo var_dump($conn);

    if ($conn) {
        // LIMIT 有兩種寫法
        // 1:LIMIT n，這是取最得前面的 n 筆資料
        // 2:LIMIT m,n，這是先省略 m 筆資料，再取得最前面的 n 筆資料
        // 也就是可以把 n 當成每頁取得筆數，m/每頁筆數+1=目前的頁數
        $n = 20; // 每頁取 20 筆
        $m = isset($_GET['p']) ? ($_GET['p'] - 1) * $n : 0;
        $sql = "SELECT * FROM product WHERE product_posted = '上架' AND product_type_id LIKE '$type_id'";

        // 向資料庫下指令並取回資料
        $data = mysqli_query($conn, $sql);
        // 取得資料總筆數
        $r = mysqli_num_rows($data);
        // 顯示總筆數
        // echo 'Total Rows: '.$r.'<br>';
        // 計算種頁數， ceil() 函數為無條件進位
        $pages = ceil($r / $n);
        // echo 'Total Rows: '.$pages.'<br>';

        $temp['data']=$pages;
        $temp['msg']='success';
        $api = json_encode($temp, JSON_UNESCAPED_UNICODE);
        echo $api;
    }
?>