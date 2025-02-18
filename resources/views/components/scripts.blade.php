<!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

    <script src="assets/vendor/libs/jquery/jquery.js"></script>
    <script src="assets/vendor/libs/popper/popper.js"></script>
    <script src="assets/vendor/js/bootstrap.js"></script>
    <script src="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="assets/vendor/libs/hammer/hammer.js"></script>
    <script src="assets/vendor/libs/flatpickr/flatpickr.js"></script>
    <script src="assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
    <script src="assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
    <script src="assets/vendor/js/menu.js"></script>
    <script src="assets/vendor/libs/select2/select2.js"></script>
    <script src="assets/vendor/libs/toastr/toastr.js"></script>
    <script src="assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.js" />
    // <script src="assets/vendor/libs/apex-charts/apexcharts.js"><script>


    <!-- CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="assets/js/main.js"></script>


    <!-- Custom JS -->
    // <script>
    //     function updateLeadsBadge(count) {
    //         let badge = $("#leads-badge");

    //         if (count > 0) {
    //             badge.text(count).show();  // Show badge with count
    //         } else {
    //             badge.hide();  // Hide badge if count is 0
    //         }
    //     }

    //     // Example Test Cases:
    //     updateLeadsBadge(4);  // Should show badge with "5"
    //     setTimeout(() => updateLeadsBadge(0), 3000);  // Hide badge after 3 seconds
    // </script>


<script>
        function updateLeadsBadge() {
            $.ajax({
                url: "{{ route('leads.countInquiry') }}",
                type: "GET",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    let individualBadge = $("#leadsIndividualTabBadge");
                    if (response.inquiryIndividual > 0) {
                        individualBadge.text(response.inquiryIndividual).show();
                    } else {
                        individualBadge.hide();
                    }

                    let fleetBadge = $("#leadsFleetTabBadge");
                    if (response.inquiryFleet > 0) {
                        fleetBadge.text(response.inquiryFleet).show();
                    } else {
                        fleetBadge.hide();
                    }

                    let governmentBadge = $("#leadsGovernmentTabBadge");
                    if (response.inquiryGovernment > 0) {
                        governmentBadge.text(response.inquiryGovernment).show();
                    } else {
                        governmentBadge.hide();
                    }

                    let companyBadge = $("#leadsCompanyTabBadge");
                    if (response.inquiryCompany > 0) {
                        companyBadge.text(response.inquiryCompany).show();
                    } else {
                        companyBadge.hide();
                    }
                    
                }
            });
        }


</script>




