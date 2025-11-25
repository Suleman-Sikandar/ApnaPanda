<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const sidebar = document.getElementById('sidebar');
        const menuToggle = document.getElementById('menuToggle');
        menuToggle.addEventListener('click', function() {
            sidebar.classList.toggle('collapsed');
        });
        if (window.innerWidth <= 768) {
            menuToggle.addEventListener('click', function() {
                sidebar.classList.toggle('mobile-open');
            });
        }
        const menuItems = document.querySelectorAll('.menu-item');
        menuItems.forEach(function(item) {
            item.addEventListener('click', function() {
                menuItems.forEach(function(mi) {
                    mi.classList.remove('active');
                });
                item.classList.add('active');
            });
        });
    </script>