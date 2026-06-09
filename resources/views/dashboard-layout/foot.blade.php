
<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="/assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/assets/dist/js/adminlte.min.js"></script>

<!-- Include Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<!-- DataTable script -->

{{--<script>--}}
{{--    $("#example1").DataTable({--}}
{{--        "responsive": true,--}}
{{--        "lengthChange": false,--}}
{{--        "autoWidth": false,--}}
{{--        "searching": true,--}}
{{--        "ordering": true,--}}
{{--        "info": true,--}}
{{--        "paging": true,--}}
{{--        "pageLength": 10, // Set the number of rows per page--}}
{{--        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]--}}
{{--    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');--}}
{{--</script>--}}

<!-- sweet alert script -->
<script>
    $(document).ready(function(){
        $(document).on('click', '.delete-btn', function (e) {
            e.preventDefault();
            let form = $(this).closest("form");
            Swal.fire({
                title: "Are you sure?",
                text: "This action cannot be undone!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });

        // Handle Add button click
        $(document).on('click', '.add-btn', function (e) {
            e.preventDefault();
            let form = $(this).closest("form");
            Swal.fire({
                title: "Add New data",
                text: "Are you sure you want to add a new data?",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, add it!",
                inputValidator: (value) => {
                    // Validate the input
                    if (!value) {
                        return "You need to enter something!";
                    }
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: form.attr("action"),
                        method: form.attr("method"),
                        data: form.serialize(),
                        success: function(response) {
                            Swal.fire({
                                title: "Success",
                                text: "Data added successfully!",
                                icon: "success",
                                confirmButtonColor: "#3085d6",
                            }).then(() => {
                                // Redirect or reload the page
                                window.history.back(); // Go back to the previous page
                                setTimeout(() => {
                                    window.location.reload(); // Reload after going back
                                }, 500); // Add a delay to allow navigation before reloading

                            });
                        },
                        error: function(error) {
                            Swal.fire({
                                title: "Error",
                                text: "An error occurred while adding the data.",
                                icon: "error",
                                confirmButtonColor: "#3085d6",
                            });
                        }
                    });
                    // Redirect to the add page or perform the add action
                    //window.location.href = "/add-item"; // Replace with your actual URL
                }
            });
        });

        // Handle logout button click
        $(document).on('click', '.logout-btn', function (e) {
            e.preventDefault(); // Prevent default navigation
            let logoutUrl = $(this).attr('href'); // Get the logout route from href

            Swal.fire({
                title: "Are you sure you want to log out?",
                text: "You will need to log in again to access your account.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, log out!"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = logoutUrl; // Redirect to logout route
                }
            });
        });
    });
</script>

<!-- Overlay script -->
<script>
    function showOverlay() {
        let overlay = document.getElementById("div");

        // Check if the element exists, if not, create it
        if (!overlay) {
            overlay = document.createElement("div");
            overlay.id = "div";
            document.body.appendChild(overlay);
        }

        overlay.className = "overlay";
        overlay.innerHTML = `
        <i class="fas fa-3x fa-sync-alt fa-spin"></i>
        <div class="text-bold pt-2">Loading...</div>
    `;
        document.body.appendChild(overlay);
    }

    // Listen for the "pageshow" event to handle back/forward navigation
    window.addEventListener('pageshow', (event) => {
        // Check if the page is being restored from the cache
        if (event.persisted) {
            // Remove the overlay if it exists
            const overlay = document.querySelector('.overlay');
            if (overlay) {
                document.body.removeChild(overlay);
            }
        }
    });
</script>

<!-- Overlay script -->
<script>
    function showOverlay() {
        const overlay = document.createElement("div");
        overlay.className = "overlay";
        overlay.innerHTML = `
        <i class="fas fa-3x fa-sync-alt fa-spin"></i>
        <div class="text-bold pt-2">Loading...</div>
    `;
        document.body.appendChild(overlay);
    }

    // Listen for the "pageshow" event to handle back/forward navigation
    window.addEventListener('pageshow', (event) => {
        // Check if the page is being restored from the cache
        if (event.persisted) {
            // Remove the overlay if it exists
            const overlay = document.querySelector('.overlay');
            if (overlay) {
                document.body.removeChild(overlay);
            }
        }
    });


    function showOverlay() {
        document.getElementById('systemOverlay').style.display = 'flex';
    }

    function hideOverlay() {
        document.getElementById('systemOverlay').style.display = 'none';
    }

    // Show overlay on form submit
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function () {
            showOverlay();
        });
    });

    // Hide overlay when page finishes loading
    window.onload = function () {
        hideOverlay();
    };

</script>

<script type="text/javascript">
    function previewFile() {
        const preview = document.getElementById('imgshow');
        const file = document.querySelector('input[type=file]').files[0];
        const reader = new FileReader();

        reader.addEventListener("load", function () {
            // convert image file to base64 string
            preview.src = reader.result;
        }, false);

        if (file) {
            reader.readAsDataURL(file);
        }
    }
</script>
</body>
</html>
