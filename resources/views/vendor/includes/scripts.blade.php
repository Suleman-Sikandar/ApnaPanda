<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Cropper.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
<!-- Include SweetAlert CSS & JS -->
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


 @if (Session::has('success'))
     <script>
         Swal.fire({
             icon: 'success',
             title: 'Success!',
             text: '{{ Session::get('success') }}',
             timer: 2000,
             timerProgressBar: true,
             showConfirmButton: false,
             didOpen: () => {
                 const swalContainer = Swal.getPopup();
                 const progress = document.createElement('div');
                 progress.classList.add('swal-progress');
                 swalContainer.appendChild(progress);

                 let width = 100;
                 const interval = setInterval(() => {
                     width -= 100 / (2000 / 50);
                     progress.style.width = width + "%";
                     if (width <= 0) clearInterval(interval);
                 }, 50);
             }
         });
     </script>
 @endif


 @if (Session::has('error'))
     <script>
         Swal.fire({
             icon: 'error',
             title: 'Error!',
             text: '{{ Session::get('error') }}',
             timer: 3000,
             timerProgressBar: true,
             showConfirmButton: false,
             didOpen: () => {
                 const swalContainer = Swal.getPopup();
                 const progress = document.createElement('div');
                 progress.classList.add('swal-progress');
                 swalContainer.appendChild(progress);

                 let width = 100;
                 const interval = setInterval(() => {
                     width -= 100 / (3000 / 50);
                     progress.style.width = width + "%";
                     if (width <= 0) clearInterval(interval);
                 }, 50);
             }
         });
     </script>
 @endif
