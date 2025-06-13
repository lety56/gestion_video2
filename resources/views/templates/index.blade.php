<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vidéothèque - Dashboard</title>
    
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #5a67d8;
            --primary-light: #7f9cf5;
            --secondary-color: #9f7aea;
            --success-color: #48bb78;
            --danger-color: #f56565;
            --warning-color: #ed8936;
            --info-color: #4299e1;
            --dark-color: #2d3748;
            --light-color: #f7fafc;
            --gray-100: #f8f9fa;
            --gray-200: #e9ecef;
            --gray-500: #adb5bd;
            --sidebar-width: 260px;
            --header-height: 70px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: #f8fafc;
            color: #2d3748;
            line-height: 1.6;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: linear-gradient(180deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            z-index: 1000;
            transition: all 0.3s ease;
            overflow-y: auto;
            box-shadow: 4px 0 15px rgba(0, 0, 0, 0.1);
        }

        .sidebar-header {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-header h3 {
            font-size: 1.5rem;
            font-weight: 700;
            color: white;
            margin-top: 10px;
        }

        .sidebar-menu {
            padding: 20px 0;
        }

        .menu-item {
            margin-bottom: 5px;
        }

        .menu-link {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: rgba(255, 255, 255, 0.85);
            text-decoration: none;
            transition: all 0.3s ease;
            border-radius: 0;
            font-weight: 500;
        }

        .menu-link:hover,
        .menu-link.active {
            background-color: rgba(255, 255, 255, 0.15);
            color: white;
            transform: translateX(5px);
        }

        .menu-link i {
            width: 24px;
            margin-right: 12px;
            font-size: 1rem;
            text-align: center;
        }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            transition: all 0.3s;
        }

        .top-header {
            background: white;
            height: var(--header-height);
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .search-box {
            position: relative;
            width: 350px;
        }

        .search-box input {
            width: 100%;
            padding: 10px 40px 10px 15px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            background-color: #f7fafc;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }

        .search-box input:focus {
            outline: none;
            border-color: var(--primary-light);
            box-shadow: 0 0 0 3px rgba(90, 103, 216, 0.1);
        }

        .search-box i {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-500);
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .notification-btn {
            position: relative;
            background: none;
            border: none;
            font-size: 1.2rem;
            color: var(--dark-color);
            cursor: pointer;
            transition: all 0.2s;
        }

        .notification-btn:hover {
            color: var(--primary-color);
        }

        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: var(--danger-color);
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 0.7rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .user-avatar:hover {
            transform: scale(1.05);
        }

        /* Dashboard Content */
        .dashboard-content {
            padding: 30px;
        }

        .page-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .page-title i {
            color: var(--primary-color);
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
            position: relative;
            overflow: hidden;
            border-left: 4px solid var(--primary-color);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .stat-icon {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: white;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 5px;
            font-family: 'Inter', sans-serif;
        }

        .stat-label {
            color: #718096;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .stat-change {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 0.8rem;
            margin-top: 10px;
            font-weight: 500;
        }

        .stat-change.positive {
            color: var(--success-color);
        }

        .stat-change.negative {
            color: var(--danger-color);
        }

        /* Charts and Tables */
        .content-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 25px;
            margin-bottom: 30px;
        }

        .chart-card,
        .activity-card,
        .recent-videos-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            border: 1px solid var(--gray-200);
        }

        .card-header {
            padding: 18px 25px;
            border-bottom: 1px solid var(--gray-200);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--dark-color);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .card-title i {
            color: var(--primary-color);
            font-size: 0.9rem;
        }

        .card-body {
            padding: 20px;
        }

        /* Activity Feed */
        .activity-item {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            padding: 15px 0;
            border-bottom: 1px solid var(--gray-200);
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-icon {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.9rem;
            flex-shrink: 0;
        }

        .activity-content {
            flex: 1;
        }

        .activity-content h6 {
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .activity-content p {
            font-size: 0.8rem;
            color: #718096;
            margin: 0;
        }

        .activity-time {
            color: var(--gray-500);
            font-size: 0.75rem;
            margin-top: 3px;
        }

        /* Recent Videos Table */
        .videos-table {
            width: 100%;
            border-collapse: collapse;
        }

        .videos-table th {
            background-color: var(--gray-100);
            padding: 12px 15px;
            text-align: left;
            color: #4a5568;
            font-weight: 600;
            font-size: 0.8rem;
            border-bottom: 1px solid var(--gray-200);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .videos-table td {
            padding: 15px;
            border-bottom: 1px solid var(--gray-200);
            vertical-align: middle;
            font-size: 0.9rem;
        }

        .videos-table tr:last-child td {
            border-bottom: none;
        }

        .videos-table tr:hover {
            background-color: var(--gray-100);
        }

        .video-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .video-thumbnail {
            width: 50px;
            height: 35px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            flex-shrink: 0;
        }

        .video-details h6 {
            font-size: 0.9rem;
            font-weight: 600;
            margin: 0 0 2px 0;
        }

        .video-details span {
            font-size: 0.8rem;
            color: #718096;
        }

        .badge {
            padding: 5px 10px;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .badge-primary {
            background-color: rgba(90, 103, 216, 0.1);
            color: var(--primary-color);
        }

        .badge-success {
            background-color: rgba(72, 187, 120, 0.1);
            color: var(--success-color);
        }

        .badge-warning {
            background-color: rgba(237, 137, 54, 0.1);
            color: var(--warning-color);
        }

        /* Action Buttons */
        .action-btn {
            background: none;
            border: none;
            padding: 6px;
            border-radius: 6px;
            cursor: pointer;
            color: var(--gray-500);
            transition: all 0.2s ease;
            width: 30px;
            height: 30px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .action-btn:hover {
            background-color: var(--gray-100);
            color: var(--primary-color);
        }

        .action-btn.delete:hover {
            color: var(--danger-color);
        }

        /* View All Button */
        .view-all-btn {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 0.8rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s;
        }

        .view-all-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(90, 103, 216, 0.2);
            color: white;
        }

        /* Chart Container */
        .chart-container {
            position: relative;
            height: 300px;
            width: 100%;
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .content-grid {
                grid-template-columns: 1fr;
            }
            
            .sidebar {
                width: 220px;
            }
            
            .main-content {
                margin-left: 220px;
            }
        }

        @media (max-width: 992px) {
            .search-box {
                width: 250px;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                width: 280px;
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .dashboard-content {
                padding: 20px;
            }

            .search-box {
                width: 200px;
            }

            .stats-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 576px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .search-box {
                display: none;
            }
            
            .top-header {
                padding: 0 15px;
            }
        }

        /* Animation for numbers */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .stat-card {
            animation: fadeIn 0.5s ease-out forwards;
        }

        .stat-card:nth-child(1) { animation-delay: 0.1s; }
        .stat-card:nth-child(2) { animation-delay: 0.2s; }
        .stat-card:nth-child(3) { animation-delay: 0.3s; }
        .stat-card:nth-child(4) { animation-delay: 0.4s; }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <i class="fas fa-film" style="font-size: 2rem; color: rgba(255, 255, 255, 0.9);"></i>
            <h3>Vidéothèque</h3>
        </div>
        
        <nav class="sidebar-menu">
            <div class="menu-item">
                {{-- <a href="{{ route('dashboard') }}" class="menu-link active">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Tableau de bord</span>
                </a> --}}
            </div>
            <div class="menu-item">
                <a href="{{ route('videos.index') }}" class="menu-link">
                    <i class="fas fa-video"></i>
                    <span>Vidéos</span>
                </a>
            </div>
            <div class="menu-item">
                <a href="{{ route('categories.index') }}" class="menu-link">
                    <i class="fas fa-folder"></i>
                    <span>Catégories</span>
                </a>
            </div>
            <div class="menu-item">
                <a href="{{ route('pathologies.index') }}" class="menu-link">
                    <i class="fas fa-tags"></i>
                    <span>Pathologies</span>
                </a>
            </div>
            <div class="menu-item">
                <a href="{{ route('type-operations.index') }}" class="menu-link">
                    <i class="fas fa-procedures"></i>
                    <span>Types d'opérations</span>
                </a>
            </div>
            <div class="menu-item">
                <a href="#" class="menu-link">
                    <i class="fas fa-users-cog"></i>
                    <span>Utilisateurs</span>
                </a>
            </div>
           <div class="menu-item">
            <a href="{{ route('commentaires.index') }}" class="menu-link">
                <i class="fas fa-comment-medical"></i>
                <span>Commentaires</span>
            </a>
        </div>

           <div class="menu-item">
            <a href="{{ route('notes.index') }}" class="menu-link">
                <i class="fas fa-star"></i>
                <span>Notations</span>
            </a>
        </div>

            <div class="menu-item">
                <a href="#" class="menu-link">
                    <i class="fas fa-cog"></i>
                    <span>Paramètres</span>
                </a>
            </div>
            <div class="menu-item" style="margin-top: auto;">
                <a href="{{ route('logout') }}" class="menu-link" style="color: #ffb8b8;">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Déconnexion</span>
                </a>
            </div>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Header -->
        <header class="top-header">
            <button class="btn d-lg-none" id="sidebarToggle">
                <i class="fas fa-bars"></i>
            </button>
            
            <div class="search-box">
                <input type="text" placeholder="Rechercher des vidéos, utilisateurs...">
                <i class="fas fa-search"></i>
            </div>
            
            <div class="user-profile">
                <button class="notification-btn">
                    <i class="fas fa-bell"></i>
                    <span class="notification-badge">3</span>
                </button>
                <div class="user-avatar">
                    <i class="fas fa-user-md"></i>
                </div>
            </div>
        </header>

        <!-- Dashboard Content -->
        <div class="dashboard-content">
            <h1 class="page-title">
                <i class="fas fa-tachometer-alt"></i>
                Tableau de bord
            </h1>
            
            <!-- Statistics Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon">
                            <i class="fas fa-video"></i>
                        </div>
                    </div>
                    <div class="stat-number" data-target="{{ $totalVideos ?? 0 }}">0</div>
                    <div class="stat-label">Total Vidéos</div>
                    <div class="stat-change positive">
                        <i class="fas fa-arrow-up"></i>
                        <span>12% ce mois</span>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon" style="background: linear-gradient(135deg, var(--success-color), #38a169);">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                    <div class="stat-number" data-target="{{ $totalUsers ?? 0 }}">0</div>
                    <div class="stat-label">Utilisateurs Actifs</div>
                    <div class="stat-change positive">
                        <i class="fas fa-arrow-up"></i>
                        <span>8% ce mois</span>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon" style="background: linear-gradient(135deg, var(--warning-color), #dd6b20);">
                            <i class="fas fa-folder-open"></i>
                        </div>
                    </div>
                    <div class="stat-number" data-target="{{ $totalCategories ?? 0 }}">0</div>
                    <div class="stat-label">Catégories</div>
                    <div class="stat-change">
                        <i class="fas fa-equals"></i>
                        <span>Stable</span>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon" style="background: linear-gradient(135deg, var(--info-color), #3182ce);">
                            <i class="fas fa-eye"></i>
                        </div>
                    </div>
                    <div class="stat-number" data-target="{{ $totalViews ?? 0 }}">0</div>
                    <div class="stat-label">Total Vues</div>
                    <div class="stat-change positive">
                        <i class="fas fa-arrow-up"></i>
                        <span>24% ce mois</span>
                    </div>
                </div>
            </div>

            <!-- Content Grid -->
            <div class="content-grid">
                <!-- Chart Section -->
                <div class="chart-card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-chart-line"></i>
                            Statistiques de visionnage
                        </h3>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="chartDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                Ce mois
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="chartDropdown">
                                <li><a class="dropdown-item" href="#">Cette semaine</a></li>
                                <li><a class="dropdown-item" href="#">Ce mois</a></li>
                                <li><a class="dropdown-item" href="#">Cette année</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="viewsChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Activity Feed -->
                <div class="activity-card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-bell"></i>
                            Activité récente
                        </h3>
                        <a href="#" class="btn btn-sm btn-outline-primary">Voir tout</a>
                    </div>
                    <div class="card-body">
                        <div class="activity-item">
                            <div class="activity-icon" style="background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));">
                                <i class="fas fa-upload"></i>
                            </div>
                            <div class="activity-content">
                                <h6>Nouvelle vidéo ajoutée</h6>
                                <p>Arthroscopie du genou - Dr. Martin</p>
                                <p class="activity-time">Il y a 2 heures</p>
                            </div>
                        </div>
                        
                        <div class="activity-item">
                            <div class="activity-icon" style="background: linear-gradient(135deg, var(--success-color), #38a169);">
                                <i class="fas fa-user-plus"></i>
                            </div>
                            <div class="activity-content">
                                <h6>Nouvel utilisateur</h6>
                                <p>Dr. Sophie Laurent s'est inscrit</p>
                                <p class="activity-time">Il y a 5 heures</p>
                            </div>
                        </div>
                        
                        <div class="activity-item">
                            <div class="activity-icon" style="background: linear-gradient(135deg, var(--info-color), #3182ce);">
                                <i class="fas fa-play"></i>
                            </div>
                            <div class="activity-content">
                                <h6>Vidéo visionnée</h6>
                                <p>Prothèse totale de hanche</p>
                                <p class="activity-time">Il y a 1 jour</p>
                            </div>
                        </div>
                        
                        <div class="activity-item">
                            <div class="activity-icon" style="background: linear-gradient(135deg, var(--warning-color), #dd6b20);">
                                <i class="fas fa-comment"></i>
                            </div>
                            <div class="activity-content">
                                <h6>Nouveau commentaire</h6>
                                <p>Sur "Chirurgie laparoscopique"</p>
                                <p class="activity-time">Il y a 2 jours</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Videos -->
            <div class="recent-videos-card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-history"></i>
                        Vidéos récentes
                    </h3>
                    <a href="{{ route('videos.index') }}" class="view-all-btn">
                        Voir tout <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
                <div class="card-body" style="padding: 0;">
                    <table class="videos-table">
                        <thead>
                            <tr>
                                <th>Vidéo</th>
                                <th>Catégorie</th>
                                <th>Pathologie</th>
                                <th>Date</th>
                                <th>Vues</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="video-info">
                                        <div class="video-thumbnail">
                                            <i class="fas fa-play"></i>
                                        </div>
                                        <div class="video-details">
                                            <h6>Arthroscopie du genou</h6>
                                            <span>Dr. Martin Dubois</span>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="badge badge-primary">Orthopédie</span></td>
                                <td>Lésion méniscale</td>
                                <td>28 Mai 2025</td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 5px;">
                                        <i class="fas fa-eye" style="color: #a0aec0;"></i>
                                        <span>127</span>
                                    </div>
                                </td>
                                <td>
                                    <button class="action-btn" title="Voir">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="action-btn" title="Éditer">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-btn delete" title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="video-info">
                                        <div class="video-thumbnail">
                                            <i class="fas fa-play"></i>
                                        </div>
                                        <div class="video-details">
                                            <h6>Prothèse totale de hanche</h6>
                                            <span>Dr. Claire Bernard</span>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="badge badge-success">Chirurgie</span></td>
                                <td>Arthrose sévère</td>
                                <td>27 Mai 2025</td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 5px;">
                                        <i class="fas fa-eye" style="color: #a0aec0;"></i>
                                        <span>89</span>
                                    </div>
                                </td>
                                <td>
                                    <button class="action-btn" title="Voir">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="action-btn" title="Éditer">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-btn delete" title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="video-info">
                                        <div class="video-thumbnail">
                                            <i class="fas fa-play"></i>
                                        </div>
                                        <div class="video-details">
                                            <h6>Chirurgie laparoscopique</h6>
                                            <span>Dr. Ahmed Hassan</span>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="badge badge-warning">Gastro</span></td>
                                <td>Appendicite</td>
                                <td>26 Mai 2025</td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 5px;">
                                        <i class="fas fa-eye" style="color: #a0aec0;"></i>
                                        <span>156</span>
                                    </div>
                                </td>
                                <td>
                                    <button class="action-btn" title="Voir">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="action-btn" title="Éditer">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-btn delete" title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    
    <script>
        // Toggle sidebar on mobile
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('active');
        });

        // Animate count up for statistics
        document.addEventListener('DOMContentLoaded', function() {
            const counters = document.querySelectorAll('.stat-number');
            const animationDuration = 1500;
            
            counters.forEach(counter => {
                const target = parseInt(counter.getAttribute('data-target'));
                const start = 0;
                const increment = target / (animationDuration / 16);
                let current = start;
                
                const timer = setInterval(() => {
                    current += increment;
                    if (current >= target) {
                        counter.textContent = target.toLocaleString();
                        clearInterval(timer);
                    } else {
                        counter.textContent = Math.floor(current).toLocaleString();
                    }
                }, 16);
            });
            
            // Initialize Chart
            const ctx = document.getElementById('viewsChart').getContext('2d');
            const viewsChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    datasets: [{
                        label: 'Vues mensuelles',
                        data: [1200, 1900, 1500, 2200, 1800, 2500, 3000, 2800, 3200, 3500, 4000, 4500],
                        backgroundColor: 'rgba(90, 103, 216, 0.1)',
                        borderColor: 'rgba(90, 103, 216, 1)',
                        borderWidth: 2,
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: 'white',
                        pointBorderColor: 'rgba(90, 103, 216, 1)',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            titleFont: { size: 14 },
                            bodyFont: { size: 12 },
                            padding: 12,
                            usePointStyle: true,
                            callbacks: {
                                label: function(context) {
                                    return context.parsed.y.toLocaleString() + ' vues';
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            },
                            ticks: {
                                callback: function(value) {
                                    return value.toLocaleString();
                                }
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>