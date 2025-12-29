<?php
    // 啟動 session 功能
    session_start();

    // 判斷 session 是否存在
    if(empty($_SESSION['admin_name']) or empty($_SESSION['admin_account'])){
        header('location: login.php');
    }

    
    $id = $_POST['product_id'];
    $sn = $_POST['product_sn'];
    $type = $_POST['product_type_id'];
    $name = $_POST['product_name'];
    $content = $_POST['product_content'];
    $price = $_POST['product_price'];
    $posted = $_POST['product_posted'];
    // 由於編輯功能不一定會上傳照片，所以必須將檔案名稱抓取原本的舊圖片
    $filename = $_POST['product_img_old'];

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
    
    if(!empty($_FILES['product_img'])){
        if($_FILES['product_img']['error']>0){
            echo '檔案錯誤：'.$_FILES['product_img']['error'];
        }else{
            echo '有檔案'.$_FILES['product_img']['name'].
                '('.$_FILES['product_img']['tmp_name'].')'.
                $_FILES['product_img']['type'];
            // 取得原始檔案的附檔名
            $ext = pathinfo($_FILES['product_img']['name'], PATHINFO_EXTENSION);
            if(in_array($ext, $allow)){
                // 使用日期組合出不重複的檔案名稱 (存進 product_img 的資料為 $filename)
                $filename = $num.'.'.$ext;

                //檔案上傳至暫存目錄的檔案 移至網站指定的目錄內並換回原始名稱  
                move_uploaded_file($_FILES['product_img']['tmp_name'],'../upload/product/'.$filename);
            }else{
                exit;
            }       
        }
    }


    $sql = "UPDATE product SET product_title = '$title', product_img = '$filename', product_content = '$content', product_author = '$author', product_created = '$created' WHERE product.product_id = $id";


    $host = 'localhost';     // 主機位址
    $db = 'Tina_11';         // 資料庫名稱
    $db_user = 'Tina_11';    // 帳號
    $db_pw = '0000';         // 密碼

    // 設定連線字串
    $conn = mysqli_connect($host, $db_user, $db_pw, $db);

    if ($conn) {
        $sql = "UPDATE product SET product_sn = ?,
                                    product_type_id = ?,
                                    product_name = ?,
                                    product_img = ?,
                                    product_content = ?,
                                    product_price = ?,
                                    product_posted = ?
                                    WHERE product_id = ?";
        
        // 向資料庫下指令並取回資料
        $datas = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param(
            $datas, 
            'sisssisi',
            $sn, $type, $name, $filename, $content, $price, $posted,
            $id
        );

        // 確認執行後的內容
        $check = mysqli_stmt_execute($datas);
        
        // 判斷是否新增成功
        if($check){
            // 強制轉址
            header('location: product.php');
        }
    }
?>
