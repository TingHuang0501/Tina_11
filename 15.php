<?php
$host = 'localhost';     // 主機位址
$db = 'Tina_11';         // 資料庫名稱
$db_user = 'Tina_11';    // 帳號
$db_pw = '0000';         // 密碼

// 設定連線字串
$conn = mysqli_connect($host, $db_user, $db_pw, $db);

// 檢視連線結果
//    echo var_dump($conn);

if ($conn) {
    // 設定 SQL 查詢指令
    $sql = 'SELECT * FROM news';
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
    <header>
        <div class="container py-5">
            <h1>新聞管理</h1>
        </div>
    </header>
    <main>
        <div class="container py-5">
            <div class="row">
                <div class="col-12">
                    <table class="table table-bordered">
                        <tr>
                            <th>編號</th>
                            <th>新聞標題</th>
                            <th width="100">焦點圖片</th>
                            <!-- <th>新聞內容</th> -->
                            <th>新聞日期</th>
                            <th>發佈人</th>
                        </tr>

                        <?php
                        if (mysqli_num_rows($data) > 0) {
                            // 將資料表的內容 一筆筆抓到 $row 中
                            while ($row = mysqli_fetch_assoc($data)) {
                                echo '<tr>';
                                echo '<td>'.$row['news_id'].'</td>';
                                echo '<td><a href="15-1.php?id='.$row['news_id'].'">'.$row['news_title'].'</a></td>';
                                echo '<td><img class="img-fluid" src="upload/'. $row['news_img'].'" alt=""></td>';
                                
                                // echo '<td>'.$row['news_content'].'</td>';
                                echo '<td>'.$row['news_created'].'</td>';
                                echo '<td>'.$row['news_author'].'</td>';
                                echo '<td><a href="16-1.php?id='.$row['news_id'].'" class="btn btn-info">編輯</a></td>';
                                echo '</tr>';
                            }
                        }
                        ?>      
                    </table>
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