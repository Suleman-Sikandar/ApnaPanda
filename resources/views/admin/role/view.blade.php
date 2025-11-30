<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Roles</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background-color: #f5f7fa;
            padding: 20px;
        }

        /* Container for role cards */
        .admin-roles-grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 24px;
            max-width: 1400px;
            margin: 0 auto;
        }

        /* Individual role card */
        .admin-role-card {
            background: #ffffff;
            border-radius: 12px;
            padding: 28px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            border: 1px solid #e8ecef;
            position: relative;
        }

        .admin-role-card:hover {
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.12);
            transform: translateY(-2px);
        }

        /* Card header with title */
        .admin-role-card-header {
            margin-bottom: 20px;
            padding-bottom: 16px;
            border-bottom: 1px solid #e8ecef;
        }

        .admin-role-card-title {
            font-size: 20px;
            font-weight: 600;
            color: #1a1a1a;
            margin-bottom: 4px;
        }

        .admin-role-card-subtitle {
            font-size: 13px;
            color: #6b7280;
            margin-top: 6px;
        }

        /* Modules section */
        .admin-role-modules-section {
            margin-bottom: 20px;
        }

        .admin-role-modules-label {
            font-size: 12px;
            font-weight: 600;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 12px;
            display: block;
        }

        .admin-role-modules-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .admin-role-module-item {
            display: flex;
            align-items: center;
            padding: 8px 0;
            font-size: 14px;
            color: #374151;
        }

        .admin-role-module-item::before {
            content: "−";
            color: #3b82f6;
            font-weight: bold;
            margin-right: 10px;
            font-size: 16px;
        }

        /* Card footer with action buttons */
        .admin-role-card-footer {
            display: flex;
            gap: 10px;
            margin-top: 24px;
            padding-top: 16px;
            border-top: 1px solid #e8ecef;
        }

        .admin-role-action-btn {
            flex: 1;
            padding: 10px 16px;
            border: 1px solid #d1d5db;
            background: #ffffff;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            color: #374151;
        }

        .admin-role-action-btn:hover {
            background: #f9fafb;
            border-color: #9ca3af;
        }

        .admin-role-btn-edit:hover {
            background: #eff6ff;
            border-color: #3b82f6;
            color: #3b82f6;
        }

        .admin-role-btn-delete:hover {
            background: #fef2f2;
            border-color: #ef4444;
            color: #ef4444;
        }

        /* Status badge */
        .admin-role-status-badge {
            position: absolute;
            top: 20px;
            right: 20px;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
        }

        .admin-role-status-active {
            background: #d1fae5;
            color: #065f46;
        }

        .admin-role-status-inactive {
            background: #fee2e2;
            color: #991b1b;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .admin-roles-grid-container {
                grid-template-columns: 1fr;
            }

            .admin-role-card-footer {
                flex-direction: column;
            }

            .admin-role-action-btn {
                width: 100%;
            }
        }

        /* Empty state */
        .admin-roles-empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #6b7280;
        }

        .admin-roles-empty-state i {
            font-size: 48px;
            margin-bottom: 16px;
            opacity: 0.5;
        }
    </style>
</head>
<body>

    <div class="admin-roles-grid-container">
        
        <!-- Role Card 1: Security Admin -->
        <div class="admin-role-card">
            <span class="admin-role-status-badge admin-role-status-active">Active</span>
            
            <div class="admin-role-card-header">
                <h3 class="admin-role-card-title">Security Admin</h3>
                <p class="admin-role-card-subtitle">Total modules assign to this role: 182</p>
            </div>

            <div class="admin-role-modules-section">
                <span class="admin-role-modules-label">Modules:</span>
                <ul class="admin-role-modules-list">
                    <li class="admin-role-module-item">Activity Types</li>
                    <li class="admin-role-module-item">Add Activity</li>
                    <li class="admin-role-module-item">Edit Activity</li>
                    <li class="admin-role-module-item">Update Activity Status</li>
                </ul>
            </div>

            <div class="admin-role-card-footer">
                <button class="admin-role-action-btn admin-role-btn-edit">
                    <i class="bi bi-pencil"></i> Edit Role
                </button>
                <button class="admin-role-action-btn admin-role-btn-delete">
                    <i class="bi bi-trash"></i> Delete Role
                </button>
            </div>
        </div>

        <!-- Role Card 2: Manager -->
        <div class="admin-role-card">
            <span class="admin-role-status-badge admin-role-status-active">Active</span>
            
            <div class="admin-role-card-header">
                <h3 class="admin-role-card-title">Manager</h3>
                <p class="admin-role-card-subtitle">Total modules assign to this role: 1</p>
            </div>

            <div class="admin-role-modules-section">
                <span class="admin-role-modules-label">Modules:</span>
                <ul class="admin-role-modules-list">
                    <li class="admin-role-module-item">Dashboard</li>
                </ul>
            </div>

            <div class="admin-role-card-footer">
                <button class="admin-role-action-btn admin-role-btn-edit">
                    <i class="bi bi-pencil"></i> Edit Role
                </button>
                <button class="admin-role-action-btn admin-role-btn-delete">
                    <i class="bi bi-trash"></i> Delete Role
                </button>
            </div>
        </div>

        <!-- Role Card 3: Content Manager (Example) -->
        <div class="admin-role-card">
            <span class="admin-role-status-badge admin-role-status-inactive">Inactive</span>
            
            <div class="admin-role-card-header">
                <h3 class="admin-role-card-title">Content Manager</h3>
                <p class="admin-role-card-subtitle">Total modules assign to this role: 12</p>
            </div>

            <div class="admin-role-modules-section">
                <span class="admin-role-modules-label">Modules:</span>
                <ul class="admin-role-modules-list">
                    <li class="admin-role-module-item">Posts Management</li>
                    <li class="admin-role-module-item">Media Library</li>
                    <li class="admin-role-module-item">Categories</li>
                    <li class="admin-role-module-item">Tags</li>
                </ul>
            </div>

            <div class="admin-role-card-footer">
                <button class="admin-role-action-btn admin-role-btn-edit">
                    <i class="bi bi-pencil"></i> Edit Role
                </button>
                <button class="admin-role-action-btn admin-role-btn-delete">
                    <i class="bi bi-trash"></i> Delete Role
                </button>
            </div>
        </div>

    </div>

</body>
</html>