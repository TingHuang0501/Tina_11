<?php
// company/api/register.php
// 接收 register.html 的 POST（支援 form-data 或 raw JSON），並回傳 JSON 格式：{"data": ..., "msg":"success"}

// 回傳 JSON header
header('Content-Type: application/json; charset=utf-8');

// 啟動 session（成功登入後會儲存 member 資訊）
session_start();

// 優先使用 $_POST（form 表單），若為 raw JSON 則解析之
$data = $_POST;

$id  = $data['member_id'];
$pw  = $data['member_pw'];

$host = 'localhost';     // 主機位址
$db = 'Tina_11';         // 資料庫名稱
$db_user = 'Tina_11';    // 帳號
$db_pw = '0000';         // 密碼

// 設定連線字串
$conn = mysqli_connect($host, $db_user, $db_pw, $db);


if($conn){
    
    // 改為使用 mysqli_prepare() 來執行指令較為安全
    $sql = "SELECT * FROM member WHERE member_id = '$id'";
    // 向資料庫下指令並取回資料
    $datas = mysqli_query($conn, $sql);
    // 如果有該帳號
    if(mysqli_num_rows($datas)>0){
        $row = mysqli_fetch_assoc($datas);

        if(password_verify($pw, $row['member_pw'])){
            // 登入成功：儲存 session 並回傳統一格式
            $_SESSION['member'] = array(
                'id' => $row['member_id'],
                'name' => $row['member_name']
            );

            $response = array(
                'msg' => 'success',
                'message' => '登入成功',
                'data' => array('id' => $row['member_id'], 'name' => $row['member_name'])
            );
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
        }else{
            $response = array(
                'msg' => 'error',
                'message' => '登入錯誤，請檢查密碼'
            );
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
        }
    }else{
        $response = array(
            'msg' => 'error',
            'message' => '查無此帳號！'
        );
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
    }
}

?>