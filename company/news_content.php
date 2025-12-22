<?php
    include_once('include/config.php');

    // 判斷 session 是否存在
    if(empty($_SESSION['admin_name']) or empty($_SESSION['admin_account'])){
        header('location: login.php');
    }

    
    if(empty($_GET['id'])){
        echo '查無資料';
        exit;
    }else{
        $id = $_GET['id'];
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
        // 設定 SQL 查詢指令，並指定 news_id  
        $sql = 'SELECT * FROM news WHERE news_id = '.$id;
        // 向資料庫下指令並取回資料
        $data = mysqli_query($conn, $sql);
    }
?>

<!doctype html>
<html lang="en">

<head>
    <title>新聞管理</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous" />
</head>

<body>
    <head>
        <?php include_once('navbar.php') ?>
    </head>
    <main>
        <div class="container py-5">
            <div class="row">
                <div class="col-12">
                    
                        <?php
                        // 先判斷是否有資料
                        if (mysqli_num_rows($data) > 0) {
                            // 將資料表的內容 一筆筆抓到 $row 中
                            while ($row = mysqli_fetch_assoc($data)) {
                                echo '<h1>'.$row['news_title'].'</h1>';
                                echo '<p>撰稿人：'.$row['news_author'].'</p>';
                                echo '<p>日期 ：'.$row['news_created'].'</p>';
                                echo '<p><img class="img-fluid" src="upload/news/'.$row['news_img'].'" alt=""></p>';
                                echo '<p>'.nl2br($row['news_content']).'</p>';  // nl2br($str)函數將 \n 自動轉為 <br>
                            }
                        }
                        ?>

                </div>
            </div>
        </div>
    </main>
    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script
        src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>

</html>