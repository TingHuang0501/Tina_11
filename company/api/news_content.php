<?php
    $id = isset($_GET['id']) ? $_GET['id'] : '2';
        
    $host = 'localhost';     // 主機位址
    $db = 'Tina_11';         // 資料庫名稱
    $db_user = 'Tina_11';    // 帳號
    $db_pw = '0000';         // 密碼

    // 設定連線字串
    $conn = mysqli_connect($host, $db_user, $db_pw, $db);

    // 檢視連線結果
    // echo var_dump($conn);

    if ($conn) {
        // 設定 SQL 查詢指令
        $sql = "SELECT * FROM news WHERE news_id = $id";
        // 向資料庫下指令並取回資料
        $data = mysqli_query($conn, $sql);

        // 取得每筆資料放進 $row 中(一維陣列)
        $i = 0;
        while($row = mysqli_fetch_assoc($data)){
            // 組合出 $rows 的資料表格(二維陣列)
            $rows[$i]['id']=$row['news_id'];
            $rows[$i]['title']=$row['news_title'];
            $rows[$i]['img']=$row['news_img'];
            $rows[$i]['content']=$row['news_content'];
            $rows[$i]['date']=$row['news_created'];
            $rows[$i]['poster']=$row['news_author'];
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