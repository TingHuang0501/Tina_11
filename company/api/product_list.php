<?php
        
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
        $n = 9;
        $m = isset($_GET['p']) ? ($_GET['p'] - 1) * $n : 0;
        $sql = "SELECT * FROM product INNER JOIN product_type USING(product_type_id) WHERE product_posted = '上架' LIMIT $m, $n";

        // 向資料庫下指令並取回資料
        $data = mysqli_query($conn, $sql);

        // 取得每筆資料放進 $row 中(一維陣列)
        $i = 0;
        while($row = mysqli_fetch_assoc($data)){
            // 組合出 $rows 的資料表格(二維陣列)
            $rows[$i]['id']=$row['product_id'];
            $rows[$i]['sn']=$row['product_sn'];
            $rows[$i]['type']=$row['product_type'];
            $rows[$i]['name']=$row['product_name'];
            $rows[$i]['img']=$row['product_img'];
            // $rows[$i]['content']=$row['product_content'];
            $rows[$i]['price']=$row['product_price'];
            // $rows[$i]['posted']=$row['product_posted'];
            // 增加一列
            $i++;
        }
        // 預計JSON格式 $temp={data:[{0},{1},{2}...],msg:success}
        $temp['data']=$rows;
        $temp['msg']='success';

        // 將 $temp 轉換為 JSON 字串, 並存在 $api 中
        $api = json_encode($temp, JSON_UNESCAPED_UNICODE);
        // 將api 列印在頁面上
        echo $api;
    }
?>