<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vidéothèque - Dashboard</title>

    <!-- CSS Bootstrap et FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.css">
    
    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3f37c9;
            --success: #2ecc71;
            --danger: #e74c3c;
            --warning: #f39c12;
            --info: #3498db;
            --dark: #1a2537;
            --light: #f8f9fa;
            --sidebar-width: 260px;
            --sidebar-collapsed-width: 70px;
            --transition-speed: 0.3s;
        }
        
        body {
            font-family: 'Inter', 'Segoe UI', Roboto, sans-serif;
            background-color: #f5f7fa;
            color: #333;
            overflow-x: hidden;
        }
        
        .wrapper {
            display: flex;
            width: 100%;
            height: 100vh;
        }
        
        /* Sidebar styling */
        #sidebar {
            min-width: var(--sidebar-width);
            max-width: var(--sidebar-width);
            background: linear-gradient(180deg, var(--dark) 0%, #2c394f 100%);
            color: var(--light);
            position: fixed;
            height: 100vh;
            z-index: 1000;
            transition: all var(--transition-speed) ease;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        
        #sidebar.collapsed {
            min-width: var(--sidebar-collapsed-width);
            max-width: var(--sidebar-collapsed-width);
        }
        
        #sidebar .sidebar-header {
            padding: 20px;
            background: rgba(0, 0, 0, 0.2);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
        }
        
        #sidebar .sidebar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            color: white;
            margin-left: 12px;
            transition: opacity var(--transition-speed);
        }
        
        #sidebar.collapsed .sidebar-brand {
            opacity: 0;
            display: none;
        }
        
        #sidebar .nav-item {
            margin-bottom: 5px;
        }
        
        #sidebar .nav-link {
            padding: 12px 20px;
            color: rgba(255, 255, 255, 0.7);
            border-radius: 6px;
            margin: 5px 10px;
            transition: all var(--transition-speed);
            display: flex;
            align-items: center;
        }
        
        #sidebar .nav-link:hover {
            color: white;
            background: rgba(255, 255, 255, 0.1);
            transform: translateX(5px);
        }
        
        #sidebar .nav-link.active {
            background: var(--primary);
            color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        
        #sidebar .nav-text {
            margin-left: 10px;
            transition: opacity var(--transition-speed);
        }
        
        #sidebar.collapsed .nav-text {
            opacity: 0;
            display: none;
        }
        
        #sidebar .nav-icon {
            min-width: 20px;
            display: flex;
            justify-content: center;
            font-size: 1.1rem;
        }
        
        #sidebar .sidebar-footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            padding: 15px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        /* Content styling */
        #content {
            width: calc(100% - var(--sidebar-width));
            min-height: 100vh;
            transition: all var(--transition-speed);
            margin-left: var(--sidebar-width);
            position: relative;
        }
        
        #content.expanded {
            width: calc(100% - var(--sidebar-collapsed-width));
            margin-left: var(--sidebar-collapsed-width);
        }
        
        .navbar-dashboard {
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 0.8rem 1.5rem;
            position: sticky;
            top: 0;
            z-index: 900;
        }
        
        .dropdown-toggle::after {
            display: none; /* Remove bootstrap dropdown arrow */
        }
        
        .hamburger-btn {
            background: none;
            border: none;
            cursor: pointer;
            color: #555;
            padding: 8px;
            border-radius: 4px;
            transition: all 0.3s;
        }
        
        .hamburger-btn:hover {
            color: var(--primary);
            background-color: rgba(67, 97, 238, 0.1);
        }
        
        .search-wrapper {
            position: relative;
        }
        
        .search-input {
            padding-left: 38px;
            border-radius: 20px;
            border: 1px solid #eee;
            background-color: #f8f9fa;
            transition: all 0.3s;
        }
        
        .search-input:focus {
            box-shadow: 0 0 0 0.2rem rgba(67, 97, 238, 0.2);
            background-color: white;
            border-color: var(--primary);
        }
        
        .search-icon {
            position: absolute;
            left: 14px;
            top: 10px;
            color: #999;
        }
        
        .user-dropdown img {
            border: 2px solid white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        
        /* Dashboard cards */
        .main-content {
            padding: 30px;
        }
        
        .page-header {
            margin-bottom: 25px;
        }
        
        .page-title {
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 10px;
        }
        
        .breadcrumb {
            background: transparent;
            padding-left: 0;
        }
        
        .stat-card {
            border-radius: 12px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
            border: none;
            transition: transform 0.3s, box-shadow 0.3s;
            overflow: hidden;
            height: 100%;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.12);
        }
        
        .stat-card-header {
            position: relative;
            padding: 20px;
            border-bottom: none;
        }
        
        .stat-card-body {
            padding: 20px;
            position: relative;
        }
        
        .stat-card-value {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 5px;
            color: var(--dark);
            display: inline-block;
        }
        
        .stat-card-label {
            font-size: 0.9rem;
            color: #6c757d;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
        }
        
        .stat-card-icon {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
        
        .progress-thin {
            height: 4px;
            margin-top: 15px;
            margin-bottom: 5px;
            border-radius: 2px;
            overflow: hidden;
        }
        
        .card {
            border-radius: 12px;
            border: none;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
            margin-bottom: 25px;
            overflow: hidden;
        }
        
        .card-header {
            background-color: white;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding: 20px;
            font-weight: 600;
        }
        
        .table th {
            font-weight: 600;
            border-top: none;
            padding: 15px 20px;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #6c757d;
        }
        
        .table td {
            padding: 15px 20px;
            vertical-align: middle;
            color: #333;
        }
        
        .table-hover tbody tr {
            transition: background-color 0.2s;
        }
        
        .table-hover tbody tr:hover {
            background-color: rgba(67, 97, 238, 0.05);
        }
        
        .actions-dropdown .dropdown-menu {
            min-width: auto;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border: none;
            border-radius: 8px;
        }
        
        .dropdown-item {
            padding: 10px 15px;
            transition: all 0.2s;
        }
        
        .dropdown-item:hover {
            background-color: rgba(67, 97, 238, 0.1);
            color: var(--primary);
        }
        
        .user-list-item {
            padding: 15px;
            transition: all 0.2s;
        }
        
        .user-list-item:hover {
            background-color: rgba(67, 97, 238, 0.05);
        }
        
        .badge-online, .badge-offline {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 5px;
        }
        
        .badge-online {
            background-color: var(--success);
            box-shadow: 0 0 0 2px rgba(46, 204, 113, 0.3);
        }
        
        .badge-offline {
            background-color: #ccc;
        }
        
        .btn-action {
            border-radius: 6px;
            padding: 6px 12px;
            font-size: 0.85rem;
            font-weight: 600;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: all 0.2s;
        }
        
        .btn-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.15);
        }
        
        .quick-action-card {
            transition: all 0.3s;
            margin-bottom: 15px;
            border-radius: 10px;
        }
        
        .quick-action-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }
        
        .quick-action-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            margin-right: 15px;
        }
        
        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translate3d(0, 30px, 0);
            }
            to {
                opacity: 1;
                transform: translate3d(0, 0, 0);
            }
        }
        
        .fadeInUp {
            animation: fadeInUp 0.5s ease forwards;
        }
        
        @keyframes countUp {
            0% {
                transform: translateY(10px);
                opacity: 0;
            }
            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }
        
        .count-animation {
            animation: countUp 1s ease-out forwards;
        }
        
        /* Activity pulse effect */
        .activity-pulse {
            position: relative;
        }
        
        .activity-pulse::before {
            content: '';
            display: block;
            position: absolute;
            top: 8px;
            right: 8px;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: var(--success);
            border: 2px solid white;
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% {
                transform: scale(0.95);
                box-shadow: 0 0 0 0 rgba(46, 204, 113, 0.7);
            }
            70% {
                transform: scale(1);
                box-shadow: 0 0 0 10px rgba(46, 204, 113, 0);
            }
            100% {
                transform: scale(0.95);
                box-shadow: 0 0 0 0 rgba(46, 204, 113, 0);
            }
        }
        
        /* CSS for Charts */
        .chart-container {
            position: relative;
            margin: auto;
            height: 250px;
            width: 100%;
        }
        
        .chart-info-card {
            padding: 15px;
            background-color: rgba(67, 97, 238, 0.03);
            border-radius: 8px;
            margin-top: 15px;
        }
        
        .chart-info-title {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 5px;
        }
        
        .chart-info-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
        }
        
        .chart-info-text {
            font-size: 0.85rem;
            color: #6c757d;
        }
        
        /* Mobile responsive styles */
        @media (max-width: 991.98px) {
            #sidebar {
                min-width: var(--sidebar-collapsed-width);
                max-width: var(--sidebar-collapsed-width);
            }
            
            #sidebar .sidebar-brand,
            #sidebar .nav-text {
                opacity: 0;
                display: none;
            }
            
            #content {
                width: calc(100% - var(--sidebar-collapsed-width));
                margin-left: var(--sidebar-collapsed-width);
            }
            
            .stat-card-value {
                font-size: 1.8rem;
            }
        }
        
        @media (max-width: 767.98px) {
            .main-content {
                padding: 15px;
            }
            
            .table th, .table td {
                padding: 10px;
            }
            
            .stat-card-icon {
                width: 40px;
                height: 40px;
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
<div class="wrapper">
    <!-- Sidebar -->
    <nav id="sidebar">
        <!-- Sidebar Header -->
        <div class="sidebar-header">
            <i class="fas fa-film fs-4"></i>
            <span class="sidebar-brand">Vidéothèque</span>
        </div>
        
        <!-- Sidebar Navigation -->
        <ul class="nav flex-column mt-4">
            <!-- Tableau de bord -->
            <li class="nav-item">
                <a href="{{ route('videos.create') }}" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                    <span class="nav-icon"><i class="fas fa-tachometer-alt"></i></span>
                    <span class="nav-text">Tableau de bord</span>
                </a>
            </li>

            <!-- Vidéos -->
            <li class="nav-item">
                <a href="{{ route('videos.index') }}" class="nav-link {{ request()->is('videos*') ? 'active' : '' }}">
                    <span class="nav-icon"><i class="fas fa-video"></i></span>
                    <span class="nav-text">Vidéos</span>
                </a>
            </li>

            <!-- Catégories -->
            <li class="nav-item">
                <a href="{{ route('categories.index') }}" class="nav-link {{ request()->is('categories*') ? 'active' : '' }}">
                    <span class="nav-icon"><i class="fas fa-folder"></i></span>
                    <span class="nav-text">Catégories</span>
                </a>
            </li>

            <!-- Pathologies -->
            <li class="nav-item">
                <a href="{{ route('pathologies.index') }}" class="nav-link {{ request()->is('pathologies*') ? 'active' : '' }}">
                    <span class="nav-icon"><i class="fas fa-tags"></i></span>
                    <span class="nav-text">Pathologies</span>
                </a>
            </li>

            <!-- Types d'opérations -->
            <li class="nav-item">
                <a href="{{ route('type-operations.index') }}" class="nav-link {{ request()->is('operations*') ? 'active' : '' }}">
                    <span class="nav-icon"><i class="fas fa-list-alt"></i></span>
                    <span class="nav-text">Types d'opérations</span>
                </a>
            </li>

          

            <!-- Paramètres -->
            <li class="nav-item">
                <a href="{{ route('videos.index') }}" class="nav-link {{ request()->is('settings*') ? 'active' : '' }}">
                    <span class="nav-icon"><i class="fas fa-cog"></i></span>
                    <span class="nav-text">Paramètres</span>
                </a>
            </li>

            <!-- Logs du système -->
            <li class="nav-item">
                <a href="{{ route('videos.index') }}" class="nav-link {{ request()->is('logs*') ? 'active' : '' }}">
                    <span class="nav-icon"><i class="fas fa-chart-line"></i></span>
                    <span class="nav-text">Logs du système</span>
                </a>
            </li>

            <!-- Logout -->
            <li class="nav-item mt-auto">
                <div class="sidebar-footer">
                    <a href="{{ route('logout') }}" class="nav-link text-danger">
                        <span class="nav-icon"><i class="fas fa-sign-out-alt"></i></span>
                        <span class="nav-text">Déconnexion</span>
                    </a>
                </div>
            </li>
        </ul>
    </nav>
</div>
        <!-- Content -->
        <div id="content">
            <!-- Navbar -->
            <nav class="navbar navbar-dashboard navbar-expand-lg">
                <div class="container-fluid">
                    <button class="hamburger-btn" id="sidebarToggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    
                    <div class="d-none d-md-block ms-3 search-wrapper">
                        <input type="text" class="form-control search-input" placeholder="Rechercher...">
                        <i class="fas fa-search search-icon"></i>
                    </div>
                    
                    <div class="ms-auto d-flex align-items-center">
                        <!-- Notification dropdown -->
                        <div class="dropdown me-3">
                            <a href="#" class="btn position-relative" data-bs-toggle="dropdown">
                                <i class="fas fa-bell"></i>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    3
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end shadow border-0" style="width: 300px;">
                                <h6 class="dropdown-header">Notifications</h6>
                                <a href="#" class="dropdown-item py-2">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <i class="fas fa-upload text-primary bg-primary bg-opacity-10 p-2 rounded"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <p class="mb-0 fw-medium">Nouvelle vidéo ajoutée</p>
                                            <p class="small text-muted mb-0">Il y a 10 minutes</p>
                                        </div>
                                    </div>
                                </a>
                                <a href="#" class="dropdown-item py-2">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <i class="fas fa-user-plus text-success bg-success bg-opacity-10 p-2 rounded"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <p class="mb-0 fw-medium">Nouvel utilisateur inscrit</p>
                                            <p class="small text-muted mb-0">Il y a 3 heures</p>
                                        </div>
                                    </div>
                                </a>
                                <a href="#" class="dropdown-item py-2">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <i class="fas fa-exclamation-triangle text-warning bg-warning bg-opacity-10 p-2 rounded"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <p class="mb-0 fw-medium">Alerte espace disque</p>
                                            <p class="small text-muted mb-0">Il y a 1 jour</p>
                                        </div>
                                    </div>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item text-center small text-primary">Voir toutes les notifications</a>
                            </div>
                        </div>
                        
                        <!-- User dropdown -->
                        <div class="dropdown">
                            <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle user-dropdown" id="userDropdown" data-bs-toggle="dropdown">
                                <img src="/api/placeholder/40/40" class="rounded-circle activity-pulse" width="40" height="40" alt="Avatar">
                                <div class="ms-2 d-none d-sm-block">
                                    <div class="fw-semibold">Admin</div>
                                    <div class="text-muted small">Administrateur</div>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end border-0 shadow">
                                <div class="px-4 py-3">
                                    <div class="text-center">
                                        <img src="/api/placeholder/60/60" class="rounded-circle mb-3" width="60" height="60" alt="Avatar">
                                        <h6 class="mb-0">Admin</h6>
                                        <p class="text-muted small">admin@videotheque.fr</p>
                                    </div>
                                </div>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user-circle me-2"></i> Mon profil
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cog me-2"></i> Paramètres
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="#">
                                    <i class="fas fa-sign-out-alt me-2"></i> Déconnexion
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
            
            <!-- Main content -->
            <div class="main-content">
                <!-- Page header -->
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h1 class="page-title">Tableau de bord</h1>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Accueil</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Tableau de bord</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-auto">
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary">
                                    <i class="fas fa-plus me-2"></i> Nouvelle vidéo
                                </button>
                                <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">
                                    <span class="visually-hidden">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="#"><i class="fas fa-folder-plus me-2"></i> Nouvelle catégorie</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="fas fa-user-plus me-2"></i> Nouvel utilisateur</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Statistics cards -->
                <div class="row">
                    <div class="col-md-3 mb-4">
                        <div class="card stat-card h-100" style="animation-delay: 0.1s;">
                            <div class="card-body stat-card-body">
                                <div class="stat-card-icon bg-primary">
                                    <i class="fas fa-video"></i>
                                </div>
                                <h4 class="stat-card-value count-value" data-target="156">0</h4>
                                <p class="stat-card-label mb-2">Total Vidéos</p>
                                <div class="progress progress-thin">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 0%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <p class="mt-2 mb-0 text-muted small">
                                    <i class="fas fa-arrow-up text-success me-1"></i>
                                    <span class="text-success fw-medium">9%</span> depuis le mois dernier
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-3 mb-4">
                        <div class="card stat-card h-100" style="animation-delay: 0.2s;">
                            <div class="card-body stat-card-body">
                                <div class="stat-card-icon bg-success">
                                    <i class="fas fa-users"></i>
                                </div>
                                <h4 class="stat-card-value count-value" data-target="42">0</h4>
                                <p class="stat-card-label mb-2">Utilisateurs</p>
                                <div class="progress progress-thin">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 0%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <p class="mt-2 mb-0 text-muted small">
                                    <i class="fas fa-arrow-up text-success me-1"></i>
                                    <span class="text-success fw-medium">2%</span> depuis le mois dernier
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-3 mb-4">
                        <div class="card stat-card h-100" style="animation-delay: 0.3s;">
                            <div class="card-body stat-card-body">
                                <div class="stat-card-icon bg-warning">
                                    <i class="fas fa-folder"></i>
                                </div>
                                <h4 class="stat-card-value count-value" data-target="18">0</h4>
                                <p class="stat-card-label mb-2">Catégories</p>
                                <div class="progress progress-thin">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 0%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <p class="mt-2 mb-0 text-muted small">
                                    <i class="fas fa-minus text-muted me-1"></i>
                                    <span class="text-muted fw-medium">0%</span> pas de changement
                                </p></div>
                        </div>
                    </div>
                    
                    <div class="col-md-3 mb-4">
                        <div class="card stat-card h-100" style="animation-delay: 0.4s;">
                            <div class="card-body stat-card-body">
                                <div class="stat-card-icon bg-info">
                                    <i class="fas fa-eye"></i>
                                </div>
                                <h4 class="stat-card-value count-value" data-target="14827">0</h4>
                                <p class="stat-card-label mb-2">Visionnages</p>
                                <div class="progress progress-thin">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 0%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <p class="mt-2 mb-0 text-muted small">
                                    <i class="fas fa-arrow-up text-success me-1"></i>
                                    <span class="text-success fw-medium">5%</span> depuis le mois dernier
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Charts and activity -->
                <div class="row">
                    <!-- Video view chart -->
                    <div class="col-xl-8 mb-4">
                        <div class="card h-100">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Statistiques de visionnage</h5>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-light" type="button" id="chartOptions" data-bs-toggle="dropdown">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="chartOptions">
                                        <li><a class="dropdown-item" href="#">Derniers 7 jours</a></li>
                                        <li><a class="dropdown-item" href="#">Derniers 30 jours</a></li>
                                        <li><a class="dropdown-item" href="#">Exporter les données</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chart-container">
                                    <canvas id="viewsChart"></canvas>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-4">
                                        <div class="chart-info-card">
                                            <h6 class="chart-info-title">Total vues</h6>
                                            <div class="chart-info-value">5</div>
                                            <div class="chart-info-text">+8% depuis le mois dernier</div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="chart-info-card">
                                            <h6 class="chart-info-title">Temps moyen</h6>
                                            <div class="chart-info-value">12:35</div>
                                            <div class="chart-info-text">-2% depuis le mois dernier</div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="chart-info-card">
                                            <h6 class="chart-info-title">Taux d'engagement</h6>
                                            <div class="chart-info-value">30%</div>
                                            <div class="chart-info-text">+5% depuis le mois dernier</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Activity -->
                    <div class="col-xl-4 mb-4">
                        <div class="card h-100">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Activité récente</h5>
                                <a href="#" class="btn btn-sm btn-light">Voir tout</a>
                            </div>
                            <div class="card-body p-0">
                                <div class="list-group list-group-flush">
                                    <div class="list-group-item border-0 py-3">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <div class="bg-primary bg-opacity-10 text-primary rounded-circle p-2">
                                                    <i class="fas fa-upload"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <div class="fw-medium">Nouvelle vidéo ajoutée</div>
                                                <p class="text-muted mb-0 small">Arthroscopie du genou - Dr. Martin</p>
                                                <p class="text-muted mb-0 small">Il y a 10 minutes</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-group-item border-0 py-3">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <div class="bg-success bg-opacity-10 text-success rounded-circle p-2">
                                                    <i class="fas fa-user-plus"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <div class="fw-medium">Nouvel utilisateur inscrit</div>
                                                <p class="text-muted mb-0 small">Dr. Sophie Laurent</p>
                                                <p class="text-muted mb-0 small">Il y a 3 heures</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-group-item border-0 py-3">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <div class="bg-info bg-opacity-10 text-info rounded-circle p-2">
                                                    <i class="fas fa-play-circle"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <div class="fw-medium">Vidéo visionnée</div>
                                                <p class="text-muted mb-0 small">Prothèse totale de hanche - Dr. Dubois</p>
                                                <p class="text-muted mb-0 small">Il y a 5 heures</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-group-item border-0 py-3">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <div class="bg-warning bg-opacity-10 text-warning rounded-circle p-2">
                                                    <i class="fas fa-exclamation-triangle"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <div class="fw-medium">Alerte espace disque</div>
                                                <p class="text-muted mb-0 small">Espace disque à 85% d'utilisation</p>
                                                <p class="text-muted mb-0 small">Il y a 1 jour</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    
    <!-- Recent Videos -->
    <div class="row">
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Vidéos récentes</h5>
                    <!-- Lien pour voir toutes les vidéos -->
                    <a href="{{ route('videos.index') }}" class="btn btn-sm btn-primary">Voir toutes les vidéos</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Titre</th>
                                    <th>Catégorie</th>
                                    <th>Pathologie</th>
                                    <th>Date d'ajout</th>
                                    <th>Vues</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="/api/placeholder/50/30" class="me-3 rounded" alt="Thumbnail">
                                            <div>
                                                <div class="fw-medium">Arthroscopie du genou</div>
                                                <div class="small text-muted">Dr. Martin</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Orthopédie</td>
                                    <td>Lésion méniscale</td>
                                    <td>27 Avr 2025</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-eye text-muted me-1"></i> 32
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown actions-dropdown">
                                            <button class="btn btn-sm btn-light" type="button" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="#"><i class="fas fa-eye me-2"></i>Voir</a>
                                                <a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i>Modifier</a>
                                                <a class="dropdown-item text-danger" href="#"><i class="fas fa-trash-alt me-2"></i>Supprimer</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <!-- Autres vidéos (répéter les lignes de tableau similaires) -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick actions and storage -->
    <div class="row">
        <!-- Quick actions -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="mb-0">Actions rapides</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Ajouter une vidéo -->
                        <div class="col-sm-6">
                            <a href="{{ route('videos.create') }}" class="card quick-action-card bg-primary bg-opacity-10 border-0">
                                <div class="card-body p-3">
                                    <div class="d-flex align-items-center">
                                        <div class="quick-action-icon bg-primary">
                                            <i class="fas fa-upload"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Ajouter une vidéo</h6>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Ajouter un nouvel utilisateur -->
                        <div class="col-sm-6">
                            <a href="{{ route('videos.create') }}" class="card quick-action-card bg-success bg-opacity-10 border-0">
                                <div class="card-body p-3">
                                    <div class="d-flex align-items-center">
                                        <div class="quick-action-icon bg-success">
                                            <i class="fas fa-user-plus"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Nouvel utilisateur</h6>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                    <!-- Ajouter une nouvelle catégorie -->
                    <div class="col-sm-6">
                        <a href="{{ route('categories.create') }}" class="card quick-action-card bg-info bg-opacity-10 border-0">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center">
                                    <div class="quick-action-icon bg-info">
                                        <i class="fas fa-folder-plus"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0">Nouvelle catégorie</h6>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 
                    <!-- Storage info -->
                    <div class="col-md-6 mb-4">
                        <div class="card h-100">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Utilisation de l'espace</h5>
                                <button class="btn btn-sm btn-light">Gérer</button>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-3">
                                    <div>
                                        <h6 class="mb-0">Espace total</h6>
                                        <p class="text-muted mb-0">500 Go</p>
                                    </div>
                                    <div>
                                        <h6 class="mb-0 text-end">Espace utilisé</h6>
                                        <p class="text-muted mb-0 text-end">425 Go (85%)</p>
                                    </div>
                                </div>
                                <div class="progress mb-4" style="height: 10px;">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="storage-details">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div class="d-flex align-items-center">
                                            <div class="storage-icon bg-primary" style="width: 10px; height: 10px; border-radius: 50%; margin-right: 10px;"></div>
                                            <div>Vidéos</div>
                                        </div>
                                        <div>385 Go</div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div class="d-flex align-items-center">
                                            <div class="storage-icon bg-success" style="width: 10px; height: 10px; border-radius: 50%; margin-right: 10px;"></div>
                                            <div>Documents</div>
                                        </div>
                                        <div>25 Go</div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div class="d-flex align-items-center">
                                            <div class="storage-icon bg-warning" style="width: 10px; height: 10px; border-radius: 50%; margin-right: 10px;"></div>
                                            <div>Images</div>
                                        </div>
                                        <div>15 Go</div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <div class="storage-icon bg-secondary" style="width: 10px; height: 10px; border-radius: 50%; margin-right: 10px;"></div>
                                            <div>Autres</div>
                                        </div>
                                        <div>5 Go</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- JavaScript files -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
    
    <script>
        // Toggle sidebar
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('collapsed');
            document.getElementById('content').classList.toggle('expanded');
        });
        
        // Animation for count values
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                document.querySelectorAll('.progress-bar').forEach(function(bar) {
                    const targetWidth = bar.getAttribute('aria-valuenow') + '%';
                    bar.style.width = targetWidth;
                });
            }, 500);
            
            document.querySelectorAll('.count-value').forEach(function(element) {
                const target = parseInt(element.getAttribute('data-target'));
                const duration = 2000;
                const step = target / (duration / 50);
                let current = 0;
                const timer = setInterval(function() {
                    current += step;
                    if (current >= target) {
                        element.textContent = target;
                        clearInterval(timer);
                    } else {
                        element.textContent = Math.round(current);
                    }
                }, 50);
            });
        });
        
        // Chart.js
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('viewsChart').getContext('2d');
            const gradient = ctx.createLinearGradient(0, 0, 0, 300);
            gradient.addColorStop(0, 'rgba(67, 97, 238, 0.5)');
            gradient.addColorStop(1, 'rgba(67, 97, 238, 0.0)');
            
            const chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'],
                    datasets: [{
                        label: 'Visionnages',
                        data: [248, 520, 470, 890, 750, 450, 680],
                        backgroundColor: gradient,
                        borderColor: '#4361ee',
                        borderWidth: 2,
                        pointBackgroundColor: '#ffffff',
                        pointBorderColor: '#4361ee',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                drawBorder: false,
                                color: 'rgba(0, 0, 0, 0.05)'
                            },
                            ticks: {
                                font: {
                                    size: 12
                                }
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                font: {
                                    size: 12
                                }
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: '#1a2537',
                            titleFont: {
                                size: 14
                            },
                            bodyFont: {
                                size: 13
                            },
                            padding: 12,
                            cornerRadius: 8
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>