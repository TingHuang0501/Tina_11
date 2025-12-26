    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Navbar</a>
            <button
                class="navbar-toggler d-lg-none"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#collapsibleNavId"
                aria-controls="collapsibleNavId"
                aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="<?= URL ?>index.html" aria-current="page">首頁</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= URL ?>news.html">最新消息</a>
                    </li>
                    <?php
                    // 判斷 session 是否存在, 若存在則顯示管理功能
                    if (!empty($_SESSION['admin_name']) and !empty($_SESSION['admin_account'])) {
                      echo  '<li class="nav-item dropdown">
                                <a
                                    class="nav-link dropdown-toggle"
                                    href="#"
                                    id="dropdownId"
                                    data-bs-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false">'.$_SESSION['admin_name'].'</a>
                                <div
                                    class="dropdown-menu"
                                    aria-labelledby="dropdownId">
                                    <a class="dropdown-item" href="'.URL.'admin/news.php">管理後台</a>
                                    <a class="dropdown-item" href="#">產品管理</a>
                                    <a class="dropdown-item" href="'.URL.'logout.php">登出</a>
                                </div>
                              </li>';
                    }

                    ?>
                </ul>
            </div>
        </div>
    </nav>