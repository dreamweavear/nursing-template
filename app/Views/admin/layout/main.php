<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Admin Panel') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">


    <link rel="icon" type="image/x-icon" href="<?= base_url('favicon.ico') ?>">
<link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('favicon-32x32.png') ?>">
<link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('favicon-16x16.png') ?>">
<link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('apple-touch-icon.png') ?>">
    <style>
        :root {
            --sidebar-width: 260px;
            --primary-color: #11998e;
            --secondary-color: #38ef7d;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }
        
        /* Sidebar Styles */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: linear-gradient(180deg, #1a1a2e 0%, #16213e 100%);
            color: white;
            overflow-y: auto;
            z-index: 1000;
            transition: all 0.3s;
        }
        
        .sidebar-header {
            padding: 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            text-align: center;
        }
        
        .sidebar-header i {
            font-size: 40px;
            color: var(--primary-color);
            margin-bottom: 10px;
        }
        
        .sidebar-menu {
            padding: 20px 0;
        }
        
        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 12px 25px;
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            transition: all 0.3s;
            border-left: 3px solid transparent;
        }
        
        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background: rgba(255,255,255,0.1);
            color: white;
            border-left-color: var(--primary-color);
        }
        
        .sidebar-menu a i {
            margin-right: 12px;
            font-size: 18px;
        }
        
        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
        }
        
        /* Top Navbar */
        .top-navbar {
            background: white;
            padding: 15px 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .navbar-title {
            font-size: 20px;
            font-weight: 600;
            color: #333;
        }
        
        .user-menu {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .user-menu .dropdown-toggle {
            background: none;
            border: none;
            color: #333;
            font-weight: 500;
        }
        
        /* Content Area */
        .content-area {
            padding: 30px;
        }
        
        /* Cards */
        .dashboard-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.08);
            transition: transform 0.3s;
        }
        
        .dashboard-card:hover {
            transform: translateY(-5px);
        }
        
        .card-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            margin-bottom: 15px;
        }
        
        .card-icon.patients {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        
        .card-icon.doctors {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
        }
        
        .card-icon.staff {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
        }
        
        .card-icon.appointments {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
            color: white;
        }
        
        .card-number {
            font-size: 32px;
            font-weight: 700;
            color: #333;
        }
        
        .card-label {
            color: #6c757d;
            font-size: 14px;
        }
        
        /* Table Styles */
        .table-container {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.08);
        }
        
        .btn-primary-custom {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            border: none;
            padding: 10px 25px;
            border-radius: 8px;
        }
        
        .btn-primary-custom:hover {
            opacity: 0.9;
        }
        
        /* Alert Styles */
        .alert {
            border-radius: 10px;
            border: none;
        }
        
        /* Mobile Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.show {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <i class="bi bi-hospital"></i>
            <h5 class="mb-0"> <?= esc($settings['site_name'] ?? 'Nursing Home') ?></h5>
            <small class="text-white-50">Admin Panel</small>
        </div>
        
        <div class="sidebar-menu">
            <a href="<?= base_url('admin/dashboard') ?>" class="<?= (uri_string() == 'admin/dashboard') ? 'active' : '' ?>">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
            <a href="<?= base_url('admin/patients') ?>" class="<?= (strpos(uri_string(), 'admin/patients') !== false) ? 'active' : '' ?>">
                <i class="bi bi-people"></i> Patients
            </a>
            <a href="<?= base_url('admin/doctors') ?>" class="<?= (strpos(uri_string(), 'admin/doctors') !== false) ? 'active' : '' ?>">
                <i class="bi bi-person-badge"></i> Doctors
            </a>
            <a href="<?= base_url('admin/staff') ?>" class="<?= (strpos(uri_string(), 'admin/staff') !== false) ? 'active' : '' ?>">
                <i class="bi bi-person-workspace"></i> Staff
            </a>
            <a href="<?= base_url('admin/appointments') ?>" class="<?= (strpos(uri_string(), 'admin/appointments') !== false) ? 'active' : '' ?>">
                <i class="bi bi-calendar-check"></i> Appointments
            </a>
            <a href="<?= base_url('admin/bills') ?>" class="<?= (strpos(uri_string(), 'admin/bills') !== false) ? 'active' : '' ?>">
                <i class="bi bi-receipt"></i> Billing
            </a>
            <a href="<?= base_url('admin/inquiries') ?>" class="<?= (strpos(uri_string(), 'admin/inquiries') !== false) ? 'active' : '' ?>">
                <i class="bi bi-envelope"></i> Inquiries
            </a>
            <a href="<?= base_url('admin/profile') ?>" class="<?= (strpos(uri_string(), 'admin/profile') !== false) ? 'active' : '' ?>">
                <i class="bi bi-person-gear"></i> Profile
            </a>
            <a href="<?= base_url('admin/logout') ?>">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>
        </div>
    </div>
    
    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Navbar -->
        <div class="top-navbar">
            <div class="d-flex align-items-center">
                <button class="btn btn-sm btn-outline-secondary d-md-none me-3" id="sidebarToggle">
                    <i class="bi bi-list"></i>
                </button>
                <span class="navbar-title"><?= esc($title ?? 'Dashboard') ?></span>
            </div>
            
            <div class="user-menu">
                <span class="text-muted"><i class="bi bi-person-circle me-2"></i><?= session()->get('name') ?></span>
            </div>
        </div>
        
        <!-- Content Area -->
        <div class="content-area">
            <!-- Flash Messages -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-2"></i><?= session()->getFlashdata('success') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>
            
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-circle me-2"></i><?= session()->getFlashdata('error') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>
            
            <!-- Page Content -->
            <?= $this->renderSection('content') ?>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Mobile sidebar toggle
        document.getElementById('sidebarToggle')?.addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('show');
        });
    </script>
</body>
</html>
