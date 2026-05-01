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
