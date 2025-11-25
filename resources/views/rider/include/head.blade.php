<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Rider Dashboard - ApnaPanda')</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #e91e63;
            --secondary-color: #ff4081;
            --success-color: #4caf50;
            --warning-color: #ff9800;
            --danger-color: #f44336;
            --info-color: #2196f3;
            --dark-color: #212529;
            --light-bg: #f8f9fa;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--light-bg);
        }

        /* Sidebar Styles */
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            transition: all 0.3s;
            z-index: 1000;
        }

        .sidebar.collapsed {
            width: 70px;
        }

        .sidebar-brand {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar-brand h4 {
            margin: 0;
            font-weight: bold;
        }

        .sidebar.collapsed .brand-text {
            display: none;
        }

        .nav-menu {
            padding: 20px 0;
        }

        .nav-item {
            margin: 5px 0;
        }

        .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 12px 20px;
            display: flex;
            align-items: center;
            text-decoration: none;
            transition: all 0.3s;
        }

        .nav-link:hover {
            background-color: rgba(255,255,255,0.1);
            color: white;
        }

        .nav-link.active {
            background-color: rgba(255,255,255,0.2);
            color: white;
            border-left: 4px solid white;
        }

        .nav-link i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        .sidebar.collapsed .nav-link span {
            display: none;
        }

        /* Main Content */
        .main-content {
            margin-left: 250px;
            transition: all 0.3s;
        }

        .main-content.expanded {
            margin-left: 70px;
        }

        /* Top Navigation */
        .top-nav {
            background: white;
            padding: 15px 30px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .toggle-btn {
            background: none;
            border: none;
            font-size: 24px;
            color: var(--dark-color);
            cursor: pointer;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .status-toggle {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .status-badge {
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        .status-badge.online {
            background-color: var(--success-color);
            color: white;
        }

        .status-badge.offline {
            background-color: var(--danger-color);
            color: white;
        }

        /* Stats Cards */
        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }

        .stat-card .icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: white;
            margin-bottom: 10px;
        }

        .stat-card h3 {
            font-size: 28px;
            font-weight: bold;
            margin: 10px 0;
        }

        .stat-card p {
            color: #666;
            margin: 0;
            font-size: 14px;
        }

        /* Task Cards */
        .task-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 15px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            transition: all 0.3s;
        }

        .task-card:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        .task-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .order-id {
            font-weight: bold;
            font-size: 18px;
            color: var(--primary-color);
        }

        .task-status {
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            transition: all 0.3s;
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 70px;
            }
            .main-content {
                margin-left: 70px;
            }
            .sidebar .brand-text,
            .sidebar .nav-link span {
                display: none;
            }
        }
    </style>
    @yield('styles')
</head>