<?php
    // 啟動 session 功能
    include_once('include/config.php');
        
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
    <title>Title</title>
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
        <?php include_once('navbar.php') ?>

    </header>
    <main>
        <section id="news">
            <div class="container">
                <div class="row">
                    <?php
                    if (mysqli_num_rows($data) > 0) {
                        // 將資料表的內容 一筆筆抓到 $row 中
                        while ($row = mysqli_fetch_assoc($data)) {
                    ?>
                            <div class="col-md-4 d-flex mt-5 mb-2">
                                <div class="card flex-fill">
                                    <a href="news_content.php?id=<?= $row['news_id'] ?>">
                                        <div class="ratio ratio-16x9">
                                            <img class="card-img-top" src="upload/news/<?= $row['news_img'] ?>" alt="Title" />
                                        </div>
                                    </a>
                                    <div class="card-body">
                                        <p class="card-text"><?= $row['news_created'] ?></p>
                                        <h4 class="card-title"><?= $row['news_title'] ?></h4>
                                    </div>
                                </div>

                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </section>
    </main>
    
    <footer class="bg-dark">
        <?php include_once('footer.php') ?>
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