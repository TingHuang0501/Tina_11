<?php
    // 讀取網址上的參數 username
    // 當網址是 http://localhost/Tina_11/14.php?username=Tina
    $name ='';
    if(!empty($_GET['username'])){
        $name = $_GET['username'];
    }
    $q = '';
    if(!empty($_GET['q'])){
        $name = $_GET['q'];
    }

    // $account = '';
    // if(!empty($_POST['account'])){
    //     $account = $_POST['account'];
    // };

    // 三元運算值(同上的意思 但簡化)
    $account = !empty($_POST['account'])?$_POST['account']:'';

    $pw = '';
    if(!empty($_POST['pw'])){
        $pw = $_POST['pw'];
    };

    // 判斷帳號密碼是否正確
    if($account == 'Tina' && $pw == '0501'){
        $msg = '<p style="color:green">登入成功</p>';
    }else{
        $msg = '<p style="color:red">帳號或密碼錯誤，請重新輸入!</p>';
    }

    // 常數的宣告與使用
    define("URL" , 'http://localhost/Tina_11/');

    // 宣告使用台北時間來當日期的計算
    date_default_timezone_set("Asia/Taipei");
    
    // 日期物件
    echo date('Y-m-d H:i:s').'<br>';
    // 利用日期時間 產生不會重複的檔案名稱
    $num = date('YmdHis');
    echo $num.'.jpg';

    
    // echo $account;
    // echo '<br>';
    // echo $pw;
    
    // echo $name;
    


    // 檔案接收
    $upload = '';
    // 設定可允許的檔案陣列
    $allow = ['jpg','jpeg','jpg','png','webp','gif'];
    
    if(!empty($_FILES['upload'])){
        if($_FILES['upload']['error']>0){
            echo '檔案錯誤：'.$_FILES['upload']['error'];
        }else{
            echo '有檔案'.$_FILES['upload']['name'].'('.$_FILES['upload']['tmp_name'].')'.
                $_FILES['upload']['type'];
            // 取得原始檔案的附檔名
            $ext = pathinfo($_FILES['upload']['name'], PATHINFO_EXTENSION);
            if(in_array($ext, $allow)){
                // 使用日期組合出不重複的檔案名稱
                $filename = $num.'.'.$ext;

                //檔案上傳至暫存目錄的檔案 移至網站指定的目錄內並換回原始名稱  
                move_uploaded_file($_FILES['upload']['tmp_name'],'upload/'.$filename);
            }else{
                exit;
            }       
        }
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p><input type="text" name="" placeholder="<?php echo $q ?>" ></p>
    <br><br>

    <form action="" method="post">
        帳號：<input type="text" name="account" id=""><br>
        密碼：<input type="password" name="pw" id=""><br>
        <input type="submit" value="登入">
    </form>
    <div><?php echo $msg ?></div><br>

    <p><a href="<?php echo URL.'resume'; ?>" target="_blank">前往頁面</a></p>

    <form action="" method="post" enctype="multipart/form-data">
        <!-- 透過 accept 設定可選擇的檔案類型 -->
        <input type="file" name="upload" id="" accept=".jpeg,.jpg,.png,.webp,.gif">
        <input type="submit" value="上傳">
    </form>
</body>
</html>