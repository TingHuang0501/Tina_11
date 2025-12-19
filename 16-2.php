<?php
// 啟動 session 功能
    session_start();

    // 判斷 session 是否存在
    if(empty($_SESSION['user'])){
        header('loaction: login.php');
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
    $sql = "SELECT * FROM news WHERE news_id = $id";
    // 向資料庫下指令並取回資料
    $data = mysqli_query($conn, $sql);
}
?>

<!doctype html>
<html lang="en">

<head>
    <title>新聞編輯</title>
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
            <h1>新聞編輯</h1>
        </div>
    </header>
    <main>
        <div class="container py-5">
            <?php
            if (mysqli_num_rows($data) > 0) {
                // 將資料表的內容 一筆筆抓到 $row 中
                while ($row = mysqli_fetch_assoc($data)) {
            ?>

            <form action="16-3.php" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-2 mb-3 pt-1 text-end">
                        新聞標題
                    </div>
                    <div class="col-md-10 mb-3">
                        <input type="text" class="form-control" name="news_title" id="" value="<?php echo $row['news_title']?>" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 mb-3 pt-1 text-end">
                        焦點圖片
                    </div>
                    <div class="col-md-10 mb-3">
                        <input type="file" class="form-control" name="news_img" id="">
                    </div>
                    <div class="col-md-10 offset-md-2 mb-3">
                        <img src="upload/news/<?php echo $row['news_img'] ?>" class="w-50" alt="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 mb-3 pt-1 text-end">
                        新聞內容
                    </div>
                    <div class="col-md-10 mb-3">
                        <textarea class="form-control" name="news_content" id="" rows="15" required><?php echo $row['news_content']?></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 mb-3 pt-1 text-end">
                        發布人
                    </div>
                    <div class="col-md-10 mb-3">
                        <!-- 文字方塊 -->
                        <!-- <input type="text" class="form-control" name="news_author" id="" required> -->
                        <!-- 選項按鈕 -->
                        <!-- <input type="radio" name="news_author" id="np1" value="Tina"> <label for="np1">Tina</label>
                        <input type="radio" name="news_author" id="np2" value="Niki"> <label for="np2">Niki</label>
                        <input type="radio" name="news_author" id="np3" value="Nina"> <label for="np3">Nina</label> -->

                        <!-- 下拉式選單 -->
                        <select class="form-select" name="news_author" id="" required>
                            <option value="">請選擇</option>
                            <option value="Tina" <?php if($row['news_author']=='Tina') echo 'selected' ?>>Tina</option>
                            <option value="Niki" <?php if($row['news_author']=='Niki') echo 'selected' ?>>Niki</option>
                            <option value="Nina" <?php if($row['news_author']=='Nina') echo 'selected' ?>>Nina</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 mb-3 pt-1 text-end">
                        發布日期
                    </div>
                    <div class="col-md-10 mb-3">
                        <input type="datetime-local" class="form-control" name="news_created" id="" value="<?php echo $row['news_created']?>" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-end">
                        <input type="hidden" name="news_id" value="<?php echo $row['news_id'] ?>">
                        <input type="hidden" name="news_img_old" value="<?= $row['news_img'] ?>">
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