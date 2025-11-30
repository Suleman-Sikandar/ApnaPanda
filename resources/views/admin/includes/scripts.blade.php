<!-- === CSS Links === -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css" rel="stylesheet">

<!-- === JS Scripts === -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.min.js"></script>

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
        // Select2 Initialization
        // ---------------------------

        // Function to initialize Select2
        function initSelect2() {
            $('#role_id').select2({
                width: '100%',   // Important for hidden containers
                dropdownParent: $('#drawerBox') // Important for dropdown inside drawer
            });
        }

        // Initialize Select2 when drawer opens
        $(document).on('click', '#addminAdd', function() {
            // Wait a tiny bit for the drawer to show
            setTimeout(function() {
                initSelect2();
            }, 100); 
        });



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
