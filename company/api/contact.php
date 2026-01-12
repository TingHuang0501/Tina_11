<?php
// company/api/register.php
// 接收 register.html 的 POST（支援 form-data 或 raw JSON），並回傳 JSON 格式：{"data": ..., "msg":"success"}

// 回傳 JSON header
header('Contact-Type: application/json; charset=utf-8');

// 優先使用 $_POST（form 表單），若為 raw JSON 則解析之
$data = $_POST;

$id  = $data['contact_id'];
$pw  = password_hash($data['contact_pw'], PASSWORD_DEFAULT);
$name = $data['contact_name'];
$tel = $data['contact_tel'];
$addr = $data['contact_address'];

$host = 'localhost';     // 主機位址
$db = 'Tina_11';         // 資料庫名稱
$db_user = 'Tina_11';    // 帳號
$db_pw = '0000';         // 密碼

// 設定連線字串
$conn = mysqli_connect($host, $db_user, $db_pw, $db);


if ($conn) {
        // 設定 SQL 查詢指令，並指定 news_id  
        // 下面的語法容易被駭客使用 SQL Injection
        // $sql = "INSERT INTO news (news_title, news_img, news_contact, news_author, news_created) VALUES ('$title', '$filename', '$contact', '$author', '$created')";
        // $data = mysqli_query($conn, $sql);
        
        // 改使用 mysqli_prepare() 來執行較為安全
        $sql = "INSERT INTO contact (contact_name, contact_phone, contact_email, contact_subject, contact_message) VALUES (?, ?, ?, ?, ?)";

        // 向資料庫下指令並取回資料
        $datas = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param(
            $datas, 
            'sssss',
            $id, $pw, $name, $tel, $addr
        );

        // 確認執行後的內容
        $check = mysqli_stmt_execute($datas);
        
        // 判斷是否新增成功
        if($check){
            // 回傳結構：包含 data 與 msg，並提供 success 布林以方便前端判斷
            $response = array(
            'data' => $data,
            'msg' => 'success'
        );
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        }
    }

?>