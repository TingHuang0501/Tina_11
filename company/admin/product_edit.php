<?php
// 啟動 session 功能
    include_once('../include/config.php');

    // 判斷 session 是否存在
    if(empty($_SESSION['admin_name']) or empty($_SESSION['admin_account'])){
        header('location: '.URL.'login.php');
        // echo "<script>alert('test')</script>";
    }

if (!empty($_GET['id'])) {
    $id = $_GET['id'];
} else {
    echo '查無資料!';
    exit;
}

$host = 'localhost';     // 主機位址
$db = 'Tina_11';         // 資料庫名稱
$db_user = 'Tina_11';    // 帳號
$db_pw = '0000';         // 密碼

// 設定連線字串
$conn = mysqli_connect($host, $db_user, $db_pw, $db);

if ($conn) {
    // 設定 SQL 查詢指令(查詢指定編號的資料)
    $sql = "SELECT * FROM product WHERE product_id = $id";
    // 向資料庫下指令並取回資料
    $data = mysqli_query($conn, $sql);

    // 設定 SQL 查詢指令(查詢產品分類的資料)
    $sql = 'SELECT * FROM product_type';
    // 向資料庫下指令並取回資料
    $types = mysqli_query($conn, $sql);
}
?>

<!doctype html>
<html lang="en">

<head>
    <?php include_once('../navbar.php') ?>
    <title>產品編輯</title>
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
            <h1>產品編輯</h1>
        </div>
    </header>
    <main>
        <div class="container py-5">
            <?php
            if (mysqli_num_rows($data) > 0) {
                // 將資料表的內容 一筆筆抓到 $row 中
                while ($row = mysqli_fetch_assoc($data)) {
            ?>

            <form action="product_update.php" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-2 mb-3 pt-1 text-end">
                        產品編號
                    </div>
                    <div class="col-md-10 mb-3">
                        <input type="text" class="form-control" name="product_sn" id="" value="<?php echo $row['product_sn']?>" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 mb-3 pt-1 text-end">
                        產品名稱
                    </div>
                    <div class="col-md-10 mb-3">
                        <input type="text" class="form-control" name="product_name" id="" value="<?php echo $row['product_name']?>" required>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-2 mb-3 pt-1 text-end">
                        產品圖片
                    </div>
                    <div class="col-md-10 mb-3">
                        <input type="file" class="form-control" name="product_img" id="">
                    </div>
                    <div class="col-md-10 offset-md-2 mb-3">
                        <img src="../upload/product/<?php echo $row['product_img'] ?>" class="w-50" alt="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 mb-3 pt-1 text-end">
                        產品內容
                    </div>
                    <div class="col-md-10 mb-3">
                        <textarea class="form-control" name="product_content" id="" rows="15" required><?php echo $row['product_content']?></textarea>
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
                            if (mysqli_num_rows($types) > 0) {
                            // 將資料表的內容 一筆筆抓到 $row 中
                            while ($row_type = mysqli_fetch_assoc($types)) {
                            echo '<option value="'.$row_type['product_type_id'].'" '.($row['product_type_id']==$row_type['product_type_id'] ? 'selected' : '').'>'.$row_type['product_type'].'</option>';
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
                        <input type="number" class="form-control" name="product_price" id="" value="<?=$row['product_price'] ?>" required>
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
                            <option value="下架" <?php if($row['product_posted'] == "下架") echo "selected"; ?>>下架</option>
                            <option value="上架" <?php if($row['product_posted'] == "上架") echo "selected"; ?>>上架</option>
                         </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-end">
                        <input type="hidden" name="product_id" value="<?php echo $row['product_id'] ?>">
                        <input type="hidden" name="product_img_old" value="<?= $row['product_img'] ?>">
                        <input type="submit" class="btn btn-success" value="儲存">
                    </div>
                </div>
                
            </form>

            <?php
                }
            }
            ?>
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