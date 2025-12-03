@extends('admin.layouts.master')

@section('title', '403 - Access Denied | ApnaPanda')

@section('content')
<div class="error-page-container">
    <div class="error-content">
        <div class="error-icon">
            <i class="bi bi-shield-x"></i>
        </div>
        <h1 class="error-code">403</h1>
        <h2 class="error-title">Access Denied</h2>
        <p class="error-message">
            You don't have permission to access this resource.
        </p>
        
        @php
            $userModules = getUserModules();
        @endphp

        @if($userModules->count() > 0)
            <p class="error-description">
                Here are the pages you have access to:
            </p>
            <div class="available-modules">
                @foreach($userModules->take(6) as $module)
                    @if($module->route)
                        <a href="{{ url($module->route) }}" class="module-link">
                            @if($module->icon_class)
                                <i class="{{ $module->icon_class }}"></i>
                            @else
                                <i class="bi bi-box"></i>
                            @endif
                            {{ $module->module_name }}
                        </a>
                    @endif
                @endforeach
            </div>
        @else
            <p class="error-description">
                You don't have access to any modules. Please contact your administrator.
            </p>
        @endif

        <div class="error-actions">
            <a href="{{ route('admin.dashboard') }}" class="btn-primary">
                <i class="bi bi-house"></i> Go to Dashboard
            </a>
            <a href="javascript:history.back()" class="btn-secondary">
                <i class="bi bi-arrow-left"></i> Go Back
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
    max-width: 700px;
}

.error-icon {
    font-size: 120px;
    color: #dc3545;
    margin-bottom: 1rem;
}

.error-code {
    font-size: 120px;
    font-weight: 700;
    color: #dc3545;
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
    margin-bottom: 1.5rem;
}

.available-modules {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 1rem;
    margin: 2rem 0;
    padding: 0 1rem;
}

.module-link {
    padding: 1rem;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    text-decoration: none;
    border-radius: 8px;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
    font-size: 14px;
    font-weight: 500;
}

.module-link i {
    font-size: 24px;
}

.module-link:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
    color: white;
}

.error-actions {
    display: flex;
    gap: 1rem;
    justify-content: center;
    flex-wrap: wrap;
    margin-top: 2rem;
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
