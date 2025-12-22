<?php

    // 啟動 session 功能
    session_start();

    // 判斷 session 是否存在
    if(empty($_SESSION['admin_name']) or empty($_SESSION['admin_account'])){
        header('location: login.php');
    }

    
    $title = $_POST['news_title'];
    $content = $_POST['news_content'];
    $author = $_POST['news_author'];
    $created = $_POST['news_created'];

    // 宣告使用台北時間來當日期的計算
    date_default_timezone_set("Asia/Taipei");
    
    // 日期物件
    echo date('Y-m-d H:i:s').'<br>';
    // 利用日期時間 產生不會重複的檔案名稱
    $num = date('YmdHis');
    echo $num.'.jpg';

    // 檔案接收
    $upload = '';
    // 設定可允許的檔案陣列
    $allow = ['jpg','jpeg','jpg','png','webp','gif'];
    
    if(!empty($_FILES['news_img'])){
        if($_FILES['news_img']['error']>0){
            echo '檔案錯誤：'.$_FILES['news_img']['error'];
        }else{
            echo '有檔案'.$_FILES['news_img']['name'].
                '('.$_FILES['news_img']['tmp_name'].')'.
                $_FILES['news_img']['type'];
            // 取得原始檔案的附檔名
            $ext = pathinfo($_FILES['news_img']['name'], PATHINFO_EXTENSION);
            if(in_array($ext, $allow)){
                // 使用日期組合出不重複的檔案名稱 (存進 news_img 的資料為 $filename)
                $filename = $num.'.'.$ext;

                //檔案上傳至暫存目錄的檔案 移至網站指定的目錄內並換回原始名稱  
                move_uploaded_file($_FILES['news_img']['tmp_name'],'../upload/news/'.$filename);
            }else{
                exit;
            }       
        }
    }

    echo '<br>';
    echo $title.'<br>';
    echo $content.'<br>';
    echo $author.'<br>';
    echo $created.'<br>';
    echo $filename;


    $host = 'localhost';     // 主機位址
    $db = 'Tina_11';         // 資料庫名稱
    $db_user = 'Tina_11';    // 帳號
    $db_pw = '0000';         // 密碼

    // 設定連線字串
    $conn = mysqli_connect($host, $db_user, $db_pw, $db);

    // 檢視連線結果
    //    echo var_dump($conn);

    if ($conn) {
        // 設定 SQL 查詢指令，並指定 news_id  
        // 下面的語法容易被駭客使用 SQL Injection
        // $sql = "INSERT INTO news (news_title, news_img, news_content, news_author, news_created) VALUES ('$title', '$filename', '$content', '$author', '$created')";
        // $data = mysqli_query($conn, $sql);
        
        // 改使用 mysqli_prepare() 來執行較為安全
        $sql = "INSERT INTO news (news_title, news_img, news_content, news_author, news_created) VALUES (?, ?, ?, ?, ?)";

        // 向資料庫下指令並取回資料
        $datas = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param(
            $datas, 
            'sssss',
            $title, $filename, $content, $author, $created
        );

        // 確認執行後的內容
        $check = mysqli_stmt_execute($datas);
        
        // 判斷是否新增成功
        if($check){
            // 強制轉址
            header('location: news.php');
        }
    }
?>
