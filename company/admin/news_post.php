<?php 
    //引入設定檔
    include_once('../include/config.php');

    // 判斷 session 是否存在
    if(empty($_SESSION['admin_name']) or empty($_SESSION['admin_account'])){
        header('location: login.php');
    }


?>

<!doctype html>
<html lang="en">

<head>
    
    <title>新聞發布</title>
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
            <h1>新聞發布</h1>
        </div>
    </header>
    <main>
        <div class="container py-5">
            <form action="news_insert.php" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-2 mb-3 pt-1 text-end">
                        新聞標題
                    </div>
                    <div class="col-md-10 mb-3">
                        <input type="text" class="form-control" name="news_title" id="" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 mb-3 pt-1 text-end">
                        焦點圖片
                    </div>
                    <div class="col-md-10 mb-3">
                        <input type="file" class="form-control" name="news_img" id="" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 mb-3 pt-1 text-end">
                        新聞內容
                    </div>
                    <div class="col-md-10 mb-3">
                        <textarea class="form-control" name="news_content" id="" rows="15" required></textarea>
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
                            <option value="Tina">Tina</option>
                            <option value="Niki">Niki</option>
                            <option value="Nina">Nina</option>
                         </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 mb-3 pt-1 text-end">
                        發布日期
                    </div>
                    <div class="col-md-10 mb-3">
                        <input type="datetime-local" class="form-control" name="news_created" id="" required>
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