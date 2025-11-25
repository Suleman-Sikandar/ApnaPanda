@extends('rider.master')

@section('title', 'Earnings & Wallet - ApnaPanda')

@section('sidebar')
    @include('rider.include.sidebar')
@endsection
@section('navbar')
    @include('rider.include.navbar')
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <h2 class="mb-4">Earnings & Wallet</h2>
    </div>
</div>

<!-- Wallet Summary -->
<div class="row">
    <div class="col-md-4">
        <div class="stat-card" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
            <h3 class="text-white">Rs {{ number_format($walletBalance ?? 0, 2) }}</h3>
            <p class="text-white-50">Current Wallet Balance</p>
            <button class="btn btn-light btn-sm mt-2" data-bs-toggle="modal" data-bs-target="#withdrawModal">
                <i class="fas fa-money-bill-wave"></i> Withdraw
            </button>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card">
            <div class="icon" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
                <i class="fas fa-chart-line"></i>
            </div>
            <h3>Rs {{ number_format($monthlyEarnings ?? 0, 2) }}</h3>
            <p>This Month's Earnings</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card">
            <div class="icon" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);">
                <i class="fas fa-coins"></i>
            </div>
            <h3>Rs {{ number_format($totalEarnings ?? 0, 2) }}</h3>
            <p>Total Lifetime Earnings</p>
        </div>
    </div>
</div>

<!-- Earnings Chart -->
<div class="row mt-4">
    <div class="col-12">
        <div class="stat-card">
            <h5 class="mb-3">Earnings Overview</h5>
            <canvas id="earningsChart" height="80"></canvas>
        </div>
    </div>
</div>

<!-- Recent Transactions -->
<div class="row mt-4">
    <div class="col-12">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5>Recent Transactions</h5>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-sm btn-outline-primary active" data-filter="all">All</button>
                    <button type="button" class="btn btn-sm btn-outline-success" data-filter="credit">Credits</button>
                    <button type="button" class="btn btn-sm btn-outline-danger" data-filter="debit">Debits</button>
                </div>
            </div>
            
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Description</th>
                            <th>Order ID</th>
                            <th>Type</th>
                            <th class="text-end">Amount</th>
                        </tr>
                    </thead>
                    <tbody id="transactionsTable">
                        @forelse($transactions ?? [] as $transaction)
                        <tr data-type="{{ $transaction->type }}">
                            <td>{{ $transaction->created_at->format('d M Y, h:i A') }}</td>
                            <td>{{ $transaction->description }}</td>
                            <td>
                                @if($transaction->order_id)
                                    <a href="{{ route('rider.order.details', $transaction->order_id) }}">#{{ $transaction->order_id }}</a>
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if($transaction->type == 'credit')
                                    <span class="badge bg-success">Credit</span>
                                @else
                                    <span class="badge bg-danger">Debit</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <strong class="{{ $transaction->type == 'credit' ? 'text-success' : 'text-danger' }}">
                                    {{ $transaction->type == 'credit' ? '+' : '-' }} Rs {{ number_format($transaction->amount, 2) }}
                                </strong>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">No transactions found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            @if(isset($transactions) && $transactions->hasPages())
            <div class="d-flex justify-content-center mt-3">
                {{ $transactions->links() }}
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Withdraw Modal -->
<div class="modal fade" id="withdrawModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Withdraw Funds</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="withdrawForm">
                @csrf
                <div class="modal-body">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> Available Balance: <strong>Rs {{ number_format($walletBalance ?? 0, 2) }}</strong>
                    </div>
                    
                    <div class="mb-3">
                        <label for="withdrawAmount" class="form-label">Withdrawal Amount</label>
                        <div class="input-group">
                            <span class="input-group-text">Rs</span>
                            <input type="number" class="form-control" id="withdrawAmount" name="amount" 
                                   min="100" max="{{ $walletBalance ?? 0 }}" step="0.01" required>
                        </div>
                        <small class="text-muted">Minimum withdrawal: Rs 100</small>
                    </div>
                    
                    <div class="mb-3">
                        <label for="bankAccount" class="form-label">Bank Account</label>
                        <select class="form-select" id="bankAccount" name="bank_account_id" required>
                            <option value="">Select bank account</option>
                            @foreach($bankAccounts ?? [] as $account)
                            <option value="{{ $account->id }}">
                                {{ $account->bank_name }} - {{ $account->account_number }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="withdrawNote" class="form-label">Note (Optional)</label>
                        <textarea class="form-control" id="withdrawNote" name="note" rows="2"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary-custom">
                        <i class="fas fa-check"></i> Submit Withdrawal Request
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('styles')
<style>
    .table th {
        font-weight: 600;
        background-color: #f8f9fa;
    }
    
    .btn-group .btn {
        border-color: #dee2e6;
    }
    
    .btn-group .btn.active {
        z-index: 1;
    }
</style>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
<script>
    // Earnings Chart
    const ctx = document.getElementById('earningsChart').getContext('2d');
    const earningsChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($chartLabels ?? ['Week 1', 'Week 2', 'Week 3', 'Week 4']),
            datasets: [{
                label: 'Earnings (Rs)',
                data: @json($chartData ?? [5000, 7500, 6200, 8900]),
                borderColor: '#e91e63',
                backgroundColor: 'rgba(233, 30, 99, 0.1)',
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'Rs ' + value.toLocaleString();
                        }
                    }
                }
            }
        }
    });

    // Transaction Filtering
    document.querySelectorAll('[data-filter]').forEach(button => {
        button.addEventListener('click', function() {
            const filter = this.getAttribute('data-filter');
            
            // Update active button
            document.querySelectorAll('[data-filter]').forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            
            // Filter transactions
            const rows = document.querySelectorAll('#transactionsTable tr[data-type]');
            rows.forEach(row => {
                if (filter === 'all') {
                    row.style.display = '';
                } else {
                    row.style.display = row.getAttribute('data-type') === filter ? '' : 'none';
                }
            });
        });
    });

    // Withdraw Form Submission
    document.getElementById('withdrawForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        const submitButton = this.querySelector('button[type="submit"]');
        const originalText = submitButton.innerHTML;
        
        submitButton.disabled = true;
        submitButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
        
        fetch('/rider/wallet/withdraw', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Withdrawal request submitted successfully!');
                location.reload();
            } else {
                alert('Error: ' + data.message);
                submitButton.disabled = false;
                submitButton.innerHTML = originalText;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
            submitButton.disabled = false;
            submitButton.innerHTML = originalText;
        });
    });
</script>
@endsection