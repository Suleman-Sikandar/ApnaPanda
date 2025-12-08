<!-- DataTables CSS (in head) -->
<link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Chart.js for Dashboard Charts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

<!-- SweetAlert2 for Notifications -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Select2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.min.js"></script>

<!-- Admin JS (shared for consistent functionality) -->
<script src="{{ asset('admin/js/admin.js') }}"></script>

<script>
    $(document).ready(function() {
        // ---------------------------
        // DataTables Initialization
        // ---------------------------
        if ($('.data-table').length > 0) {
            var table = $('.data-table').DataTable({
                dom: '<"top"l>rt<"bottom"p><"clear">',
                language: {
                    lengthMenu: "Show _MENU_ entries",
                    paginate: {
                        previous: '<i class="bi bi-chevron-left"></i>',
                        next: '<i class="bi bi-chevron-right"></i>'
                    },
                    info: ""
                },
                pageLength: 10,
                lengthMenu: [
                    [5, 10, 25, 50, -1],
                    [5, 10, 25, 50, "All"]
                ],
                drawCallback: function() {
                    $('.dataTables_paginate .pagination').addClass('custom-pagination');
                }
            });

            $('[id$="SearchInput"], .table-search-input, .role-table-search input, .table-search input').on('keyup', function() {
                table.search(this.value).draw();
            });
        }

        // ---------------------------
        // Sidebar Toggle
        // ---------------------------
        const sidebar = document.getElementById('adminSidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');
        
        if (sidebarToggle && sidebar) {
            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('collapsed');
                if (window.innerWidth <= 768) {
                    sidebar.classList.toggle('active');
                }
            });
        }

        // ---------------------------
        // SweetAlert Success/Error
        // ---------------------------
        @if (Session::has('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ Session::get('success') }}',
                timer: 2000,
                timerProgressBar: true,
                showConfirmButton: false
            });
        @endif

        @if (Session::has('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: '{{ Session::get('error') }}',
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false
            });
        @endif
    });
</script>

@stack('scripts')