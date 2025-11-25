@extends('rider.master')

@section('title', 'Rider Dashboard - ApnaPanda')

@section('sidebar')
    @include('rider.include.sidebar')
@endsection
@section('navbar')
    @include('rider.include.navbar')
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <h2 class="mb-4">Dashboard</h2>
    </div>
</div>

<!-- Stats Row -->
<div class="row">
    <div class="col-md-3">
        <div class="stat-card">
            <div class="icon" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <i class="fas fa-clipboard-list"></i>
            </div>
            <h3>32</h3>
            <p>Today's Deliveries</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div class="icon" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                <i class="fas fa-dollar-sign"></i>
            </div>
            <h3>Rs 324423</h3>
            <p>Today's Earnings</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div class="icon" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                <i class="fas fa-star"></i>
            </div>
            <h3>3</h3>
            <p>Average Rating</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div class="icon" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
                <i class="fas fa-check-circle"></i>
            </div>
            <h3>3223</h3>
            <p>Total Completed</p>
        </div>
    </div>
</div>

<!-- Pending Tasks -->
<div class="row mt-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>Pending Tasks</h4>
            <button class="btn btn-primary-custom" id="refreshTasks">
                <i class="fas fa-sync-alt"></i> Refresh
            </button>
        </div>
    </div>
</div>

<div class="row" id="tasksContainer">
    {{-- @forelse($pendingTasks ?? [] as $task) --}}
    <div class="col-md-6">
        <div class="task-card">
            <div class="task-header">
                <div>
                    <div class="order-id">#</div>
                    <small class="text-muted">23-3-23</small>
                </div>
                <span class="task-status badge bg-warning">Pending</span>
            </div>
            
            <div class="task-details">
                <div class="mb-2">
                    <i class="fas fa-store text-primary"></i>
                    <strong>Vendor:</strong> ALI
                </div>
                <div class="mb-2">
                    <i class="fas fa-map-marker-alt text-danger"></i>
                    <strong>Pickup:</strong>lahore
                </div>
                <div class="mb-2">
                    <i class="fas fa-location-arrow text-success"></i>
                    <strong>Delivery:</strong>islamabad
                </div>
                <div class="mb-3">
                    <i class="fas fa-route text-info"></i>
                    <strong>Distance:</strong> 500km
                </div>
                <div class="d-flex justify-content-between">
                    <span class="text-muted">Delivery Fee: <strong>Rs 3434</strong></span>
                    <div>
                        <button class="btn btn-success btn-sm" onclick="acceptTask(#)">
                            <i class="fas fa-check"></i> Accept
                        </button>
                        <button class="btn btn-danger btn-sm" onclick="rejectTask(#)">
                            <i class="fas fa-times"></i> Reject
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- @empty --}}
    <div class="col-12">
        <div class="alert alert-info text-center">
            <i class="fas fa-info-circle fa-2x mb-2"></i>
            <p class="mb-0">No pending tasks available at the moment.</p>
        </div>
    </div>
    {{-- @endforelse --}}
</div>

<!-- Active Deliveries -->
<div class="row mt-4">
    <div class="col-12">
        <h4 class="mb-3">Active Deliveries</h4>
    </div>
</div>

<div class="row">
    {{-- @forelse($activeDeliveries ?? [] as $delivery) --}}
    <div class="col-md-6">
        <div class="task-card">
            <div class="task-header">
                <div>
                    <div class="order-id">#32</div>
                    <small class="text-muted">Started 23-2-23</small>
                </div>
                <span class="task-status badge bg-primary">In Progress</span>
            </div>
            
            <div class="task-details">
                <div class="mb-2">
                    <i class="fas fa-store text-primary"></i>
                    <strong>Vendor:</strong>ALI
                </div>
                <div class="mb-2">
                    <i class="fas fa-location-arrow text-success"></i>
                    <strong>Delivery:</strong>Islamabad
                </div>
                <div class="mb-3">
                    <i class="fas fa-user text-info"></i>
                    <strong>Customer:</strong> Ahmad
                </div>
                
                <!-- Progress Steps -->
                <div class="progress-steps mb-3">
                    <div class="step completed">
                        <i class="fas fa-box"></i>
                        <span>Picked Up</span>
                    </div>
                    <div class="step completed">
                        <i class="fas fa-shipping-fast"></i>
                        <span>On The Way</span>
                    </div>
                    <div class="step completed">
                        <i class="fas fa-check-circle"></i>
                        <span>Delivered</span>
                    </div>
                </div>
                
                <div class="d-flex justify-content-between">
                    <a href="#" class="btn btn-primary-custom btn-sm">
                        <i class="fas fa-map-marked-alt"></i> Navigate
                    </a>
                    <button class="btn btn-success btn-sm" onclick="updateStatus(#)">
                        <i class="fas fa-arrow-right"></i> Update Status
                    </button>
                    <a href="tel:0348483824" class="btn btn-info btn-sm">
                        <i class="fas fa-phone"></i> Call
                    </a>
                </div>
            </div>
        </div>
    </div>
    {{-- @empty --}}
    <div class="col-12">
        <div class="alert alert-secondary text-center">
            <i class="fas fa-motorcycle fa-2x mb-2"></i>
            <p class="mb-0">No active deliveries at the moment.</p>
        </div>
    </div>
    {{-- @endforelse --}}
</div>

@endsection

@section('styles')
<style>
    .progress-steps {
        display: flex;
        justify-content: space-between;
        position: relative;
        padding: 20px 0;
    }
    
    .progress-steps::before {
        content: '';
        position: absolute;
        top: 35px;
        left: 0;
        right: 0;
        height: 2px;
        background: #ddd;
        z-index: 0;
    }
    
    .step {
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
        z-index: 1;
        flex: 1;
    }
    
    .step i {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #ddd;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 5px;
    }
    
    .step.completed i {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    
    .step span {
        font-size: 11px;
        text-align: center;
        color: #666;
    }
    
    .step.completed span {
        color: #333;
        font-weight: bold;
    }
</style>
@endsection

@section('scripts')
<script>
    // Accept Task
    function acceptTask(taskId) {
        if (confirm('Are you sure you want to accept this task?')) {
            fetch(`/rider/tasks/${taskId}/accept`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Task accepted successfully!');
                    location.reload();
                } else {
                    alert('Error accepting task: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error accepting task');
            });
        }
    }

    // Reject Task
    function rejectTask(taskId) {
        if (confirm('Are you sure you want to reject this task?')) {
            fetch(`/rider/tasks/${taskId}/reject`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Task rejected');
                    location.reload();
                } else {
                    alert('Error rejecting task: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error rejecting task');
            });
        }
    }

    // Update Delivery Status
    function updateStatus(deliveryId) {
        fetch(`/rider/deliveries/${deliveryId}/update-status`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Status updated successfully!');
                location.reload();
            } else {
                alert('Error updating status: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error updating status');
        });
    }

    // Refresh Tasks
    document.getElementById('refreshTasks').addEventListener('click', function() {
        this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Loading...';
        location.reload();
    });

    // Auto refresh every 30 seconds
    setInterval(function() {
        fetch('/rider/tasks/check-new', {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.hasNewTasks) {
                // Show notification
                if (Notification.permission === "granted") {
                    new Notification("New Delivery Task Available!", {
                        body: "You have a new delivery task waiting for you.",
                        icon: "/images/logo.png"
                    });
                }
                // Optional: Auto reload or show badge
                document.getElementById('refreshTasks').innerHTML = '<i class="fas fa-bell"></i> New Tasks!';
            }
        });
    }, 30000);

    // Request notification permission
    if (Notification.permission !== "granted") {
        Notification.requestPermission();
    }
</script>
@endsection