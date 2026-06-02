<div class="social_icon">
    <ul>
        <li><a href="#"><img src="/assets/images/fb-icon.png"></a></li>
        <li><a href="#"><img src="/assets/images/twitter-icon.png"></a></li>
        <li><a href="#"><img src="/assets/images/linkdin-icon.png"></a></li>
        <li><a href="#"><img src="/assets/images/instagram-icon.png"></a></li>
    </ul>
</div>
</div>
</div>
<!-- footer section end -->
<!-- Javascript files-->
<script src="/assets/js/jquery.min.js"></script>
<script src="/assets/js/popper.min.js"></script>
<script src="/assets/js/bootstrap.bundle.min.js"></script>
<script src="/assets/js/jquery-3.0.0.min.js"></script>
<script src="/assets/js/plugin.js"></script>
<!-- sidebar -->
<script src="/assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="/assets/js/custom.js"></script>
<!-- javascript -->
<script src="/assets/js/owl.carousel.js"></script>
<script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="/assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="/assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="/assets/plugins/jszip/jszip.min.js"></script>
<script src="/assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="/assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="/assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="/assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="/assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script>
    $(document).ready(function(){
        $(".fancybox").fancybox({
            openEffect: "none",
            closeEffect: "none"
        });


</script>

<!-- DataTable script -->

<script>
    $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "paging": true,
        "pageLength": 10, // Set the number of rows per page
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
</script>

<!-- sweet alert script -->
<script>
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


    // function showOverlay() {
    //     document.getElementById('systemOverlay').style.display = 'flex';
    // }
    //
    // function hideOverlay() {
    //     document.getElementById('systemOverlay').style.display = 'none';
    // }
    //
    // // Show overlay on form submit
    // document.querySelectorAll('form').forEach(form => {
    //     form.addEventListener('submit', function () {
    //         showOverlay();
    //     });
    // });
    //
    // // Hide overlay when page finishes loading
    // window.onload = function () {
    //     hideOverlay();
    // };

</script>
</body>
</html>
