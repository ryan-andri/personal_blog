<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3">Admin Panel</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto me-3">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <ul class="dropdown-menu dropdown-menu-end mt-2" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="<?= BASE_URL ?>/panel/logout.php">Logout</a></li>
            </ul>
        </li>
    </ul>
</nav>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Core</div>
                    <a class="nav-link <?= (CURRENT_PAGE == "panel") ? "active" : "" ?>" href="<?= BASE_URL ?>/panel">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <div class="sb-sidenav-menu-heading">Interface</div>
                    <a class="nav-link <?= (CURRENT_PAGE == "admin.php") ? "active" : "" ?>" href="<?= BASE_URL ?>/panel/menu/admin.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-user-alt"></i></div>
                        Admin
                    </a>
                    <a class="nav-link <?= (CURRENT_PAGE == "blog.php") ? "active" : "" ?>" href="<?= BASE_URL ?>/panel/menu/blog.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-blog"></i></div>
                        Blog
                    </a>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                <strong><?= $_SESSION['admin_loged']; ?></strong>
            </div>
        </nav>
    </div>

    <div id="layoutSidenav_content">
        <main>