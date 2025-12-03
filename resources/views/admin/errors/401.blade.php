@extends('admin.layouts.master')

@section('title', '401 - Unauthorized | ApnaPanda')

@section('content')
<div class="error-page-container">
    <div class="error-content">
        <div class="error-icon">
            <i class="bi bi-person-x"></i>
        </div>
        <h1 class="error-code">401</h1>
        <h2 class="error-title">Authentication Required</h2>
        <p class="error-message">
            You need to be logged in to access this page.
        </p>
        <p class="error-description">
            Please log in with your credentials to continue.
        </p>
        <div class="error-actions">
            <a href="{{ route('admin.login') }}" class="btn-primary">
                <i class="bi bi-box-arrow-in-right"></i> Login
            </a>
            <a href="{{ url('/') }}" class="btn-secondary">
                <i class="bi bi-house"></i> Go Home
            </a>
        </div>
    </div>
</div>

<style>
.error-page-container {
    min-height: 80vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem;
}

.error-content {
    text-align: center;
    max-width: 600px;
}

.error-icon {
    font-size: 120px;
    color: #f59e0b;
    margin-bottom: 1rem;
}

.error-code {
    font-size: 120px;
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

.error-description {
    font-size: 14px;
    color: #718096;
    margin-bottom: 2rem;
}

.error-actions {
    display: flex;
    gap: 1rem;
    justify-content: center;
    flex-wrap: wrap;
}

.btn-primary, .btn-secondary {
    padding: 12px 24px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
}

.btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
}

.btn-secondary {
    background: #e2e8f0;
    color: #2d3748;
}

.btn-secondary:hover {
    background: #cbd5e0;
}
</style>
@endsection
