<?php
    include_once('../include/config.php');

    // 判斷 session 是否存在
    if(empty($_SESSION['admin_name']) or empty($_SESSION['admin_account'])){
        header('location: '.URL.'login.php');
        // echo "<script>alert('test')</script>";
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
        // 設定 SQL 查詢指令
        $sql = 'SELECT * FROM product INNER JOIN product_type USING(product_type_id)';
        // 向資料庫下指令並取回資料
        $data = mysqli_query($conn, $sql);
    }
?>

<!doctype html>
<html lang="en">

<head>
    <title>產品管理</title>
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
        <?php include_once(dirname(__DIR__).'/navbar.php') ?>
        <div class="container py-5">
            <h1>產品管理</h1>
        </div>
    </header>
    <main>
        <div class="container py-5">
            <div class="row">
                <div class="col-12 text-end pb-3">
                    <a href="product_post.php" class="btn btn-info">新增</a>
                </div>
                <div class="col-12">
                    <table class="table table-bordered">
                        <tr>
                            <th>流水號</th>
                            <th>產品編號</th>
                            <th>產品名稱</th>
                            <th width="100">產品圖片</th>
                            <!-- <th>產品內容</th> -->
                            <th>產品分類</th>
                            <th>是否上架</th>
                            <th>功能</th>
                        </tr>

                        <?php
                        if (mysqli_num_rows($data) > 0) {
                            // 將資料表的內容 一筆筆抓到 $row 中
                            while ($row = mysqli_fetch_assoc($data)) {
                                echo '<tr>';
                                echo '<td>'.$row['product_id'].'</td>';
                                echo '<td>'.$row['product_sn'].'</td>';
                                
                                echo '<td><a href="../product_content.php?id='.$row['product_id'].'">'
                                .$row['product_name'].'</a></td>';
                                echo '<td><img class="img-fluid" src="../upload/product/'. $row['product_img'].'" alt=""></td>';
                                
                                // echo '<td>'.$row['product_content'].'</td>';
                                echo '<td>'.$row['product_type'].'</td>';
                                echo '<td>'.$row['product_posted'].'</td>';
                                echo '<td><a href="product_edit.php?id='.$row['product_id'].'" class="btn btn-info btn-sm">編輯</a>';

                                echo '<btn onclick="del('.$row['product_id'].',\''.$row['product_type'].'\')" class="btn btn-danger btn-sm">刪除</btn></td>';
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

    <script>
        function del(id, title) {
            // 顯示確認視窗
            if(confirm("您確定要刪除「"+title+"」這則產品嗎？")){
                // 指定轉址
                window.location.href = 'product_del.php?id='+id;
            }
        }
    </script>
</body>

</html>