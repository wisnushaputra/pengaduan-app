<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php">Sistem Pengaduan</a>
        
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Dashboard</a>
                </li>
                <?php if ($_SESSION['role'] == 'admin') : ?>
                <li class="nav-item">
                    <a class="nav-link" href="users.php">Manajemen User</a>
                </li>
                <?php endif; ?>
            </ul>
            
            <span class="navbar-text text-white">
                Halo, <?= $_SESSION['username'] ?> (<?= $_SESSION['role'] ?>) | 
                <a href="actions/auth.php?act=logout" class="text-danger">Logout</a>
            </span>
        </div>
    </div>
</nav>