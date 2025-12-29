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

    if ($conn) {
        // 設定 SQL 查詢指令
        $sql = 'SELECT * FROM product_type';
        // 向資料庫下指令並取回資料
        $data = mysqli_query($conn, $sql);
    }
?>

<!doctype html>
<html lang="en">

<head>
    
    <title>產品發布</title>
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
        <?php include_once('../navbar.php') ?>
        <div class="container py-5">
            <h1>產品發布</h1>
        </div>
    </header>
    <main>
        <div class="container py-5">
            <form action="product_insert.php" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-2 mb-3 pt-1 text-end">
                        產品編號
                    </div>
                    <div class="col-md-10 mb-3">
                        <input type="text" class="form-control" name="product_sn" id="" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 mb-3 pt-1 text-end">
                        產品名稱
                    </div>
                    <div class="col-md-10 mb-3">
                        <input type="text" class="form-control" name="product_name" id="" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 mb-3 pt-1 text-end">
                        產品圖片
                    </div>
                    <div class="col-md-10 mb-3">
                        <input type="file" class="form-control" name="product_img" id="" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 mb-3 pt-1 text-end">
                        產品內容
                    </div>
                    <div class="col-md-10 mb-3">
                        <textarea class="form-control" name="product_content" id="" rows="15" required></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 mb-3 pt-1 text-end">
                        產品分類
                    </div>
                    <div class="col-md-10 mb-3">  

                         <select class="form-select" name="product_type_id" id="" required>
                            <option value="">請選擇</option>
                            <?php
                        if (mysqli_num_rows($data) > 0) {
                            // 將資料表的內容 一筆筆抓到 $row 中
                            while ($row = mysqli_fetch_assoc($data)) {
                            echo '<option value="'.$row['product_type_id'].'">'.$row['product_type'].'</option>';
                            }
                        }
                        ?>
                         </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 mb-3 pt-1 text-end">
                        產品金額
                    </div>
                    <div class="col-md-10 mb-3">
                        <input type="number" class="form-control" name="product_price" id="" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 mb-3 pt-1 text-end">
                        是否上架
                    </div>
                    <div class="col-md-10 mb-3">
                        <!-- 下拉式選單 -->
                         <select class="form-select" name="product_posted" id="" required>
                            <option value="">請選擇</option>
                            <!--  -->
                            <option value="下架" selected>下架</option>
                            <option value="上架">上架</option>
                         </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-end">
                        <input type="submit" class="btn btn-success" value="發布">
                    </div>
                </div>
            </form>
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