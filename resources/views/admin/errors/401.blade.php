<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>401 - Unauthorized | ApnaPanda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8fafc;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .error-container {
            text-align: center;
            max-width: 600px;
            padding: 2rem;
            background: white;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.1);
        }

        .error-icon {
            font-size: 100px;
            color: #f59e0b;
            margin-bottom: 1rem;
        }

        .error-code {
            font-size: 96px;
            font-weight: 700;
            color: #f59e0b;
            margin: 0;
            line-height: 1;
        }

        .error-title {
            font-size: 32px;
            font-weight: 600;
            color: #2d3748;
            margin: 1rem 0;
        }

        .error-message {
            font-size: 18px;
            color: #4a5568;
            margin: 1rem 0;
        }

        .error-actions {
            margin-top: 2rem;
        }

        .btn-primary {
            padding: 12px 24px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
            color: white;
        }

        .btn-primary i {
            font-size: 18px;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="error-icon">
            <i class="bi bi-person-x"></i>
        </div>
        <h1 class="error-code">401</h1>
        <h2 class="error-title">Authentication Required</h2>
        <p class="error-message">
            You need to be logged in to access this page.
        </p>

        <div class="error-actions">
            <a href="{{ route('control.login') }}" class="btn-primary">
                <i class="bi bi-box-arrow-in-right"></i> Login
            </a>
        </div>
    </div>
</body>
</html>
