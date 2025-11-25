<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Dashboard - ApnaPanda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #4F46E5;
            --secondary-color: #7C3AED;
            --sidebar-width: 260px;
            --header-height: 70px;
        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #F3F4F6;
        }
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: linear-gradient(180deg, #1F2937 0%, #111827 100%);
            color: white;
            overflow-y: auto;
            transition: all 0.3s ease;
            z-index: 1000;
        }
        .sidebar.collapsed {
            width: 80px;
        }
        .sidebar-header {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        .sidebar-header h4 {
            margin: 0;
            font-size: 24px;
            font-weight: bold;
            color: #fff;
        }
        .sidebar-menu {
            padding: 20px 0;
        }
        .menu-item {
            padding: 12px 20px;
            display: flex;
            align-items: center;
            gap: 15px;
            color: #D1D5DB;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .menu-item:hover {
            background-color: rgba(255,255,255,0.1);
            color: white;
        }
        .menu-item.active {
            background: linear-gradient(90deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            border-left: 4px solid #FCD34D;
        }
        .menu-item i {
            font-size: 20px;
            min-width: 20px;
        }
        .menu-item span {
            font-size: 15px;
            font-weight: 500;
        }
        .sidebar.collapsed .menu-item span {
            display: none;
        }
        .menu-section {
            padding: 10px 20px 5px;
            font-size: 12px;
            color: #9CA3AF;
            text-transform: uppercase;
            font-weight: 600;
        }
        .main-header {
            position: fixed;
            left: var(--sidebar-width);
            top: 0;
            right: 0;
            height: var(--header-height);
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            transition: all 0.3s ease;
            z-index: 999;
        }
        .sidebar.collapsed ~ .main-content .main-header {
            left: 80px;
        }
        .header-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .menu-toggle {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: #374151;
        }
        .header-search {
            position: relative;
        }
        .header-search input {
            width: 350px;
            padding: 10px 15px 10px 40px;
            border: 1px solid #E5E7EB;
            border-radius: 25px;
            outline: none;
        }
        .header-search i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #9CA3AF;
        }
        .header-right {
            display: flex;
            align-items: center;
            gap: 25px;
        }
        .header-icon {
            position: relative;
            cursor: pointer;
            font-size: 22px;
            color: #6B7280;
        }
        .badge-notification {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #EF4444;
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .vendor-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
        }
        .vendor-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }
        .vendor-info h6 {
            margin: 0;
            font-size: 14px;
            color: #111827;
        }
        .vendor-info p {
            margin: 0;
            font-size: 12px;
            color: #6B7280;
        }
        .main-content {
            margin-left: var(--sidebar-width);
            margin-top: var(--header-height);
            padding: 30px;
            min-height: calc(100vh - var(--header-height));
            transition: all 0.3s ease;
        }
        .sidebar.collapsed ~ .main-content {
            margin-left: 80px;
        }
        .stats-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            transition: transform 0.3s ease;
        }
        .stats-card:hover {
            transform: translateY(-5px);
        }
        .stats-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            margin-bottom: 15px;
        }
        .stats-value {
            font-size: 32px;
            font-weight: bold;
            color: #111827;
            margin: 10px 0 5px;
        }
        .stats-label {
            color: #6B7280;
            font-size: 14px;
        }
        .stats-change {
            font-size: 13px;
            margin-top: 10px;
        }
        .stats-change.positive {
            color: #10B981;
        }
        .content-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        .content-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #E5E7EB;
        }
        .content-card-title {
            font-size: 20px;
            font-weight: 600;
            color: #111827;
        }
        .btn-primary-custom {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            border: none;
            padding: 10px 25px;
            border-radius: 8px;
            color: white;
            font-weight: 500;
        }
        .status-badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
        .status-badge.online {
            background: #D1FAE5;
            color: #065F46;
        }
        .status-badge.busy {
            background: #FEF3C7;
            color: #92400E;
        }
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.mobile-open {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0;
            }
            .main-header {
                left: 0;
            }
        }
    </style>
</head>