
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JS -->
    <script>
        // Toggle Sidebar
        const toggleBtn = document.getElementById('toggleBtn');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');

        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('expanded');
        });

        // Status Toggle
        const statusSwitch = document.getElementById('statusSwitch');
        const statusBadge = document.getElementById('statusBadge');

        statusSwitch.addEventListener('change', function() {
            if (this.checked) {
                statusBadge.textContent = 'Online';
                statusBadge.classList.remove('offline');
                statusBadge.classList.add('online');
                // Call API to update status
                updateRiderStatus('online');
            } else {
                statusBadge.textContent = 'Offline';
                statusBadge.classList.remove('online');
                statusBadge.classList.add('offline');
                // Call API to update status
                updateRiderStatus('offline');
            }
        });

        function updateRiderStatus(status) {
            // API call to update rider status
            fetch('/rider/update-status', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ status: status })
            })
            .then(response => response.json())
            .then(data => {
                console.log('Status updated:', data);
            })
            .catch(error => {
                console.error('Error updating status:', error);
            });
        }
    </script>