<?php $CI = &get_instance(); ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold d-flex align-items-center" href="<?= base_url('index.php/dashboard'); ?>">
            <i class="bi bi-controller me-2"></i> Rental PS
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <?php 
                    $segment = $CI->uri->segment(1);
                    function active($page, $segment) {
                        return $page === $segment ? 'active' : '';
                    }
                ?>
                <li class="nav-item">
                    <a class="nav-link px-3 <?= active('dashboard', $segment); ?>" href="<?= base_url('index.php/dashboard'); ?>">
                        <i class="bi bi-house-door me-2"></i>Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3 <?= active('transaksi', $segment); ?>" href="<?= base_url('index.php/transaksi'); ?>">
                        <i class="bi bi-receipt me-2"></i>Transaksi
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3 <?= active('pelanggan', $segment); ?>" href="<?= base_url('index.php/pelanggan'); ?>">
                        <i class="bi bi-people me-2"></i>Pelanggan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3 <?= active('pembayaran', $segment); ?>" href="<?= base_url('index.php/pembayaran'); ?>">
                        <i class="bi bi-wallet2 me-2"></i>Pembayaran
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3 <?= active('laporan', $segment); ?>" href="<?= base_url('index.php/laporan'); ?>">
                        <i class="bi bi-bar-chart me-2"></i>Laporan
                    </a>
                </li>

                <?php if ($CI->session->userdata('logged_in')): ?>
                    <li class="nav-item">
                        <a class="nav-link px-3 text-danger" href="<?= base_url('index.php/auth/login'); ?>">
                            <i class="bi bi-box-arrow-right me-2"></i>Logout
                        </a>
                    </li>
                    <li class="nav-item margin-left-3">
                        <span class="nav-link px-3 text-white fw-bold font-size-2 d-flex align-items-center">
                            <i class="bi bi-person-circle me-2"></i>
                            <?= $CI->session->userdata('nama'); ?>
                        </span>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link px-3 text-warning" href="<?= base_url('index.php/auth/login'); ?>">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Login
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<style>
    .bg-primary { background-color: #007bff !important; }
    .nav-link { color: #ffffff !important; }
    .nav-link:hover { color: #ffdd57 !important; }
    .nav-link.active {
        background-color: #0056b3 !important;
        border-radius: 5px;
        color: #ffffff !important;
    }
</style>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
