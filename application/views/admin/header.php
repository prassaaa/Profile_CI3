<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Dashboard Admin' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/admin.css') ?>">
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2c3e50;
            --sidebar-width: 250px;
            --header-height: 60px;
            --success-color: #2ecc71;
            --warning-color: #f39c12;
            --danger-color: #e74c3c;
            --light-bg: #f8f9fa;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            overflow-x: hidden;
        }
        
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100%;
            background-color: var(--secondary-color);
            color: white;
            z-index: 1000;
            transition: all 0.3s;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        
        .sidebar-header {
            height: var(--header-height);
            display: flex;
            align-items: center;
            padding: 0 20px;
            background-color: rgba(0,0,0,0.1);
        }
        
        .sidebar-header h3 {
            font-size: 1.2rem;
            margin: 0;
            font-weight: 700;
        }
        
        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .sidebar-menu li {
            position: relative;
        }
        
        .sidebar-menu li a {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: #ddd;
            text-decoration: none;
            transition: all 0.3s;
        }
        
        .sidebar-menu li a:hover,
        .sidebar-menu li a.active {
            background-color: rgba(255,255,255,0.1);
            color: white;
        }
        
        .sidebar-menu li a i {
            margin-right: 10px;
            font-size: 1.1rem;
            width: 30px;
            text-align: center;
        }
        
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            transition: all 0.3s;
        }
        
        .header {
            height: var(--header-height);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            background-color: white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            position: sticky;
            top: 0;
            z-index: 100;
        }
        
        .toggle-sidebar {
            background: none;
            border: none;
            color: #555;
            font-size: 1.5rem;
            cursor: pointer;
        }
        
        .user-dropdown {
            position: relative;
        }
        
        .user-dropdown .dropdown-menu {
            position: absolute;
            right: 0;
            left: auto;
            box-shadow: 0 5px 10px rgba(0,0,0,0.1);
        }
        
        .card {
            border-radius: 10px;
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            margin-bottom: 20px;
        }
        
        .card-header {
            border-bottom: 1px solid #eee;
            background-color: white;
            padding: 15px 20px;
            border-top-left-radius: 10px !important;
            border-top-right-radius: 10px !important;
        }
        
        .card-body {
            padding: 20px;
        }
        
        .badge {
            padding: 5px 10px;
            border-radius: 30px;
            font-weight: 500;
        }
        
        .btn-custom {
            background-color: var(--primary-color);
            color: white;
            border-radius: 5px;
            padding: 8px 15px;
            border: none;
            transition: all 0.3s;
        }
        
        .btn-custom:hover {
            background-color: var(--secondary-color);
            color: white;
        }
        
        .form-floating > .form-control:focus ~ label,
        .form-floating > .form-control:not(:placeholder-shown) ~ label {
            color: var(--primary-color);
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(52, 152, 219, 0.25);
        }
        
        .stat-card {
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            background-color: white;
        }
        
        .stat-card h3 {
            font-size: 1.5rem;
            margin-bottom: 0;
        }
        
        .stat-card p {
            color: #888;
            margin-bottom: 0;
        }
        
        .stat-card i {
            font-size: 2rem;
            opacity: 0.8;
        }
        
        .stat-primary {
            background-color: rgba(52, 152, 219, 0.1);
            color: var(--primary-color);
        }
        
        .stat-success {
            background-color: rgba(46, 204, 113, 0.1);
            color: var(--success-color);
        }
        
        .stat-warning {
            background-color: rgba(243, 156, 18, 0.1);
            color: var(--warning-color);
        }
        
        .stat-danger {
            background-color: rgba(231, 76, 60, 0.1);
            color: var(--danger-color);
        }
        
        .collapsed .main-content {
            margin-left: 0;
        }
        
        .collapsed .sidebar {
            transform: translateX(-100%);
        }
        
        .tab-content {
            padding: 20px 0;
        }
        
        .nav-tabs .nav-link.active {
            border-color: transparent;
            border-bottom: 2px solid var(--primary-color);
            color: var(--primary-color);
        }
        
        .nav-tabs .nav-link {
            border: none;
            color: #555;
        }
        
        .nav-tabs .nav-link:hover {
            border-color: transparent;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .sidebar.active {
                transform: translateX(0);
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h3>Admin Panel</h3>
        </div>
        
        <ul class="sidebar-menu">
            <li>
                <a href="<?= base_url('admin') ?>" class="<?= $this->uri->segment(1) == 'admin' && $this->uri->segment(2) == '' ? 'active' : '' ?>">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="<?= base_url('admin/profile') ?>" class="<?= $this->uri->segment(2) == 'profile' ? 'active' : '' ?>">
                    <i class="fas fa-user"></i>
                    <span>Profil</span>
                </a>
            </li>
            <li>
                <a href="<?= base_url('admin/achievements') ?>" class="<?= $this->uri->segment(2) == 'achievements' ? 'active' : '' ?>">
                    <i class="fas fa-trophy"></i>
                    <span>Prestasi</span>
                </a>
            </li>
            <li>
                <a href="<?= base_url('admin/education') ?>" class="<?= $this->uri->segment(2) == 'education' ? 'active' : '' ?>">
                    <i class="fas fa-graduation-cap"></i>
                    <span>Pendidikan</span>
                </a>
            </li>
            <li>
                <a href="<?= base_url('admin/skills') ?>" class="<?= $this->uri->segment(2) == 'skills' ? 'active' : '' ?>">
                    <i class="fas fa-code"></i>
                    <span>Keahlian</span>
                </a>
            </li>
            <li>
                <a href="<?= base_url('admin/projects') ?>" class="<?= $this->uri->segment(2) == 'projects' ? 'active' : '' ?>">
                    <i class="fas fa-project-diagram"></i>
                    <span>Proyek</span>
                </a>
            </li>
            <li>
                <a href="<?= base_url('admin/messages') ?>" class="<?= $this->uri->segment(2) == 'messages' ? 'active' : '' ?>">
                    <i class="fas fa-envelope"></i>
                    <span>Pesan</span>
                    <?php if(isset($unread_count) && $unread_count > 0): ?>
                        <span class="badge bg-danger rounded-pill ms-auto"><?= $unread_count ?></span>
                    <?php endif; ?>
                </a>
            </li>
            <li>
                <a href="<?= base_url('admin/settings') ?>" class="<?= $this->uri->segment(2) == 'settings' ? 'active' : '' ?>">
                    <i class="fas fa-cog"></i>
                    <span>Pengaturan</span>
                </a>
            </li>
            <li>
                <a href="<?= base_url('auth/logout') ?>">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Keluar</span>
                </a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header">
            <button class="toggle-sidebar" id="toggleSidebar">
                <i class="fas fa-bars"></i>
            </button>
            <div class="d-flex align-items-center">
                <a href="<?= base_url() ?>" class="btn btn-sm btn-outline-primary me-3" target="_blank">
                    <i class="fas fa-eye me-1"></i>
                    Lihat Website
                </a>
                <div class="dropdown">
                    <button class="btn dropdown-toggle d-flex align-items-center" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="me-2"><?= $this->session->userdata('username') ?></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="<?= base_url('admin/settings') ?>"><i class="fas fa-cog me-2"></i>Pengaturan</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="<?= base_url('auth/logout') ?>"><i class="fas fa-sign-out-alt me-2"></i>Keluar</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Page Content -->
        <div class="container-fluid py-4">
            <?php if($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= $this->session->flashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php endif; ?>
            
            <?php if($this->session->flashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= $this->session->flashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php endif; ?>
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0"><?= $title ?? 'Dashboard' ?></h2>
            </div>
