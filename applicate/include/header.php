<header class="header">
    <a href="<?php echo BASE_URL ?>">
        <img class="img-logo" src="<?php echo BASE_URL ?>/asset/img/лого.svg" alt="">
    </a>
    <nav class="header_wrapper">
        <ul class="header_ul">
            <?php
            // Получаем имя текущего скрипта
            $current_page = basename($_SERVER['SCRIPT_NAME']);
            $is_admin_page = strpos(dirname($_SERVER['SCRIPT_NAME']), 'admin') !== false;
            ?>
            <li class="header-link">
                <a 
                href="<?php echo BASE_URL ?>" 
                class="<?php echo $current_page === 'index.php' && !$is_admin_page ? 'active' : ''; ?>">
                    Главная
                </a>
            </li>
            <li class="header-link">
                <a 
                href="<?php echo BASE_URL . 'blog.php' ?>" 
                class="<?php echo $current_page === 'blog.php' && !$is_admin_page || $current_page === 'single.php' ? 'active' : ''; ?>">
                    Блог
                </a>
            </li>
            <li class="header-link">
                <?php if (isset($_SESSION['id'])): ?>
                    <ul>
                        <?php if (!empty($_SESSION['admin'])): ?>
                            <li class="header-link">
                                <a 
                                href="<?php echo BASE_URL . 'admin/posts'; ?>" 
                                class="<?php echo $is_admin_page ? 'active' : ''; ?>">
                                    Админ панель
                                </a>
                            </li>
                        <?php else: ?>
                            <li class="header-link">
                                <a 
                                href="<?php echo BASE_URL . 'admin/posts'; ?>" 
                                class="<?php echo $is_admin_page ? 'active' : ''; ?>">
                                    Личный кабинет
                                </a>
                            </li>
                        <?php endif; ?>
                        <li class="header-link">
                            <a href="<?php echo BASE_URL . 'logout.php'; ?>">
                                Выход
                            </a>
                        </li>
                    </ul>
                <?php else: ?>
                    <a href="<?php echo BASE_URL . 'log.php'; ?>" class="<?php echo $current_page === 'log.php' ? 'active' : ''; ?>">
                        Вход
                    </a>
                    <ul>
                        <li class="header-link">
                            <a href="<?php echo BASE_URL . 'reg.php'; ?>" class="<?php echo $current_page === 'reg.php' ? 'active' : ''; ?>">
                                Регистрация
                            </a>
                        </li>
                    </ul>
                <?php endif; ?>
            </li>
        </ul>
    </nav>
</header>
