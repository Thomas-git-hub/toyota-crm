@extends('components.app')

@section('content')

<div class="row mb-4">
    <div class="col-md">
        <div class="card" id="inquiryFormCard" style="display: none;">
            <div class="card-header">
                <h5 class="text-primary card-title">Inquiry Form</h5>
            </div>
            <div class="card-body">
                <form id="leadFormData">
                    <div class="mb-4">
                        <div class="row mb-2">
                            <div class="col-md">
                                <label for="first_name" class="form-label required">First Name</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="" />
                                <small class="text-danger" id="validateFirstname">Enter Customer First Name</small>
                            </div>
                            <div class="col-md">
                                <label for="last_name" class="form-label required">Last Name</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="" />
                                <small class="text-danger" id="validateLastname">Enter Customer Last Name</small>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md">
                                <label for="gender" class="form-label required">Gender</label>
                                <select class="form-control" id="gender" name="gender">
                                    <option value="">Select Gender</option>
                                    <option value="Female">Female</option>
                                    <option value="Male">Male</option>
                                </select>
                                <small class="text-danger" id="validateGender">Please Select Gender</small>
                            </div>
                            <div class="col-md">
                                <label for="age" class="form-label required">Age</label>
                                <input type="number" class="form-control" id="age" name="age" placeholder="" />
                                <small class="text-danger" id="validateLastname">Enter Customer Age</small>
                            </div>
                            <div class="col-md">
                                <label for="mobile_number" class="form-label required">Mobile Number</label>
                                <input type="text" class="form-control" id="mobile_number" name="mobile_number" placeholder="09" />
                                <small class="text-danger" id="validateMobileNumber">Enter Valid Mobile Number</small>
                            </div>

                            
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="row mb-2">
                            <div class="col-md">
                                <label for="car_unit" class="form-label required">Unit</label>
                                <select class="form-control" id="car_unit" name="car_unit">
                                    <option value="">Select Unit</option>
                                </select>
                                <small class="text-danger" id="validateUnit">Please Select Unit</small>
                            </div>
                            <div class="col-md">
                                <label for="car_variant" class="form-label required">Variants</label>
                                <select class="form-control" id="car_variant" name="car_variant">
                                    <option value="">Select Variants</option>
                                </select>
                                <small class="text-danger" id="validateVariant required">Please Select Variant</small>
                            </div>
                            <div class="col-md">
                                <label for="car_color" class="form-label required">Color</label>
                                <select class="form-control" id="car_color" name="car_color">
                                    <option value="">Select Color</option>
                                </select>
                                <small class="text-danger" id="validateColor">Please Select Color</small>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md">
                            <label for="province" class="form-label required">Province</label>
                            <select class="form-control" id="province" name="province">
                                <option value="">Select Province</option>
                            </select>
                            <small class="text-danger" id="validateProvince">Please Select a Province</small>
                        </div>
                        <div class="col-md">
                            <label for="transaction" class="form-label required">Transactions</label>
                            <select class="form-control" id="transaction" name="transaction">
                                <option value="">Select Transactions</option>
                                <option value="cash">Cash</option>
                                <option value="po">PO</option>
                                <option value="financing">Financing</option>
                            </select>
                            <small class="text-danger" id="validateTransaction">Please Select Transaction</small>
                        </div>
                        <div class="col-md">
                            <label for="source" class="form-label required">Source</label>
                            <select class="form-control" id="source" name="source" >
                                <option value="">Select Source</option>
                                <option value="Social-Media">Social-Media</option>
                                <option value="Referal">Referal</option>
                                <option value="Mall Duty">Mall Duty</option>
                                <option value="Show Room">Show Room</option>
                                <option value="Saturation">Saturation</option>
                            </select>
                            <small class="text-danger" id="validateSource">Please Select Source</small>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md">
                            <label for="additional_info" class="form-label">Remarks</label>
                            <textarea class="form-control" placeholder="Message" id="remarks" name="additional_info" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md d-flex justify-content-end gap-2">
                            <button type="button" class="btn btn-label-danger" id="cancelInquiryFormButton">Cancel</button>
                            <button type="submit" class="btn btn-success">Add Inquiry</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

 <div class="row mb-2">
    <div class="col-md d-flex justify-content-end">
        <button class="btn btn-primary" id="addNewInquiryButton">Add New Inquiry</button>
    </div>
 </div>

 <div class="row mb-2">
    <div class="col">
        <div class="card custom-card">
            <div class="card-body">
                <div class="row">
                    <div class="d-flex w-50 gap-2">
                        <div class="col-md-6">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="date" id="start_date" class="form-control form-control-sm" />
                        </div>
                        <div class="col-md-6">
                            <label for="end_date" class="form-label">End Date</label>
                            <input type="date" id="end_date" class="form-control form-control-sm" />
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="inquiryTable" class="table table-striped table-hover" style="width:100%">
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('components.specific_page_scripts')
<script>



    // DataTable initialization
    const inquiryTable = $('#inquiryTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("leads.list") }}',
            pageLength: 10,
            paging: true,
            responsive: false,
            dom: '<"top"lf>rt<"bottom"ip>',
            language: {
                search: "",
                searchPlaceholder: "Search..."
            },
        columns: [
            { data: 'team', name: 'team', title: 'Team' },
            { data: 'agent', name: 'agent', title: 'Agent' },
            { data: 'customer_name', name: 'customer_name', title: 'Customer Name' },
            { data: 'contact_number', name: 'contact_number', title: 'Contact No.' },
            { data: 'unit', name: 'unit', title: 'Unit' },
            { data: 'variant', name: 'variant', title: 'Variant' },
            { data: 'color', name: 'color', title: 'Color' },
            { data: 'transaction', name: 'transaction', title: 'Transaction' },
            { data: 'gender', name: 'gender', title: 'Gender' },
            { data: 'age', name: 'age', title: 'Age' },
            { data: 'source', name: 'source', title: 'Source' },
            { data: 'province', name: 'province', title: 'Province' },
            { data: 'remarks', name: 'remarks', title: 'Remarks' },
            { data: 'date', name: 'date', title: 'Date' },
            {
                data: 'id',
                title: 'Action',
                orderable: false,
                searchable: false,
                render: function(data) {
                    return `
                        <div class="d-flex">
                            <button type="button" class="btn btn-icon me-2 btn-label-success" data-bs-toggle="modal" data-bs-target="#editThesisEntiresModal">
                                <span class="tf-icons bx bx-pencil bx-22px"></span>
                            </button>
                            <button type="button" class="btn btn-icon me-2 btn-label-primary processing-btn" data-id="${data}">
                                <span class="tf-icons bx bxs-check-circle bx-22px"></span>
                            </button>
                            <button type="button" class="btn btn-icon me-2 btn-label-danger delete-btn" data-id="${data}">
                                <span class="tf-icons bx bxs-x-circle bx-22px"></span>
                            </button>
                        </div>
                    `;
                }
            }
        ],
        order: [[0, 'desc']],  // Sort by date created by default
        columnDefs: [
            {
                type: 'created_at',
                targets: [0, 1] // Apply date sorting to date_received and date_on_hold columns
            }
        ],
      
        // data: [{ // Sample data row
        //     id: 1,
        //     team: 'Sales Team',
        //     agent: 'John Doe',
        //     customer_name: 'Jane Smith',
        //     contact_no: '123-456-7890',
        //     unit: 'Unit 1',
        //     variant: 'Variant A',
        //     color: 'Red',
        //     transaction: 'Purchase',
        //     gender: 'Female',
        //     age: '25',
        //     source: 'Website',
        //     province: 'California',
        //     remarks: 'No remarks',
        //     date: '2024-01-10 09:00:00'
        // }]
    });

    // Inquiry Form Validation
    $(document).ready(function () {
        //Load Province
        $.ajax({
            url: '{{ route('leads.getProvince') }}',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                let provinceSelect = $('#province');
                provinceSelect.empty();
                provinceSelect.append('<option value="">Select Province...</option>');
                data.forEach(function(item) {
                    provinceSelect.append(`<option value="${item.id}">${item.province}</option>`);
                });
            },
            error: function(error) {
                console.error('Error loading provinces:', error);
            }
        });

        $.ajax({
            url: '{{ route('leads.getUnit') }}',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                let unitSelect = $('#car_unit');
                unitSelect.empty();
                unitSelect.append('<option value="">Select Unit...</option>');
                data.forEach(function(item) {
                    unitSelect.append(`<option value="${item.unit}">${item.unit}</option>`);
                });
            },
            error: function(error) {
                console.error('Error loading unit:', error);
            }
        });

         // Load variants and colors based on selected unit
        $('#car_unit').on('change', function() {
            const selectedUnit = $(this).val();
            console.log(selectedUnit);
            if (selectedUnit) {
                $.ajax({
                    url: '{{ route("leads.getVariantsAndColors") }}', // New route
                    type: 'GET',
                    data: { unit: selectedUnit },
                    dataType: 'json',
                    success: function(data) {
                        // Populate the car_variant and car_color selects
                        let variantSelect = $('#car_variant');
                        let colorSelect = $('#car_color');
                        variantSelect.empty();
                        colorSelect.empty();
                        variantSelect.append('<option value="">Select Variants...</option>');
                        colorSelect.append('<option value="">Select Color...</option>');
                        console.log(data.variants);
                        console.log(data.colors);

                        // Check if data.variants is an array or a single value
                        if (Array.isArray(data.variants)) {
                            data.variants.forEach(function(variant) {
                                variantSelect.append(`<option value="${variant}">${variant}</option>`);
                            });
                        } else {
                            variantSelect.append(`<option value="${data.variants}">${data.variants}</option>`);
                        }

                        // Check if data.colors is an array or a single value
                        if (Array.isArray(data.colors)) {
                            data.colors.forEach(function(color) {
                                colorSelect.append(`<option value="${color}">${color}</option>`);
                            });
                        } else {
                            colorSelect.append(`<option value="${data.colors}">${data.colors}</option>`);
                        }
                    },
                    error: function(error) {
                        console.error('Error loading variants and colors:', error);
                    }
                });
            } else {
                console.log('here');
                // Clear the selects if no unit is selected
                $('#car_variant').empty().append('<option value="">Select Variants...</option>');
                $('#car_color').empty().append('<option value="">Select Color...</option>');
            }
        });
        // Hide warning messages initially
        $("small").hide();

        // Helper function to capitalize first letter of each word
        function capitalizeWords(str) {
            return str.replace(/\b\w/g, function (txt) {
                return txt.toUpperCase();
            });
        }

        // Validation function
        function validateField(field, message) {
            const $field = $(field);
            const $errorMsg = $field.siblings('small');
            
            if (!$field.val()) {
                $field.addClass('is-invalid border-danger');
                $errorMsg.show();
                return false;
            }
            
            $field.removeClass('is-invalid border-danger');
            $errorMsg.hide();
            return true;
        }

        // Validate form on submit
        $("#leadFormData").on("submit", function (e) {
            e.preventDefault();
            let isValid = true;

             // Validate required fields
            isValid = validateField('#first_name', 'Enter Customer First Name') && isValid;
            isValid = validateField('#last_name', 'Enter Customer Last Name') && isValid;
            isValid = validateField('#age', 'Enter Customer Age') && isValid;
            isValid = validateField('#mobile_number', 'Enter Valid Mobile Number') && isValid;
            isValid = validateField('#car_unit', 'Please Select Unit') && isValid;
            isValid = validateField('#car_variant', 'Please Select Variant') && isValid;
            isValid = validateField('#car_color', 'Please Select Color') && isValid;
            isValid = validateField('#transaction', 'Please Select Transaction') && isValid;
            isValid = validateField('#source', 'Please Select Source') && isValid;
            isValid = validateField('#gender', 'Please Select Gender') && isValid;
            isValid = validateField('#car_variant', 'Please Select a Variant') && isValid;
            isValid = validateField('#province', 'Please Select a Province') && isValid;

            // Special validation for mobile number
            const mobileNumber = $('#mobile_number').val();
            if (mobileNumber && !mobileNumber.match(/^09\d{9}$/)) {
                $('#mobile_number').addClass('is-invalid border-danger');
                $('#validateMobileNumber').show();
                isValid = false;
            }

            if (isValid) {
                const formData = $(this).serialize();
                $.ajax({
                    url: '{{ route("leads.store") }}',
                    type: 'POST',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                             Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: response.message,
                            });
                            // Reset form and hide it
                            $("#leadFormData")[0].reset();
                            $("#inquiryFormCard").hide();
                            $("#addNewInquiryButton").show();
                           
                            // Clear all validation states
                            $(".text-danger").hide();
                            $("input, select").removeClass("is-invalid border-danger");
                            inquiryTable.ajax.reload();   
                        }
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: xhr.responseJSON?.message || 'Something went wrong!'
                        });
                    }
                });
            }
        });

        $('#leadFormData input, #leadFormData select').on('input change', function() {
            validateField(this);
        });

        // Real-time Capitalization
        $("input[type='text']").on("input", function () {
            $(this).val(capitalizeWords($(this).val()));
        });
    });


    // display form
    $(document).ready(function () {
            // Show #inquiryFormCard when #addNewInquiryButton is clicked
            $("#addNewInquiryButton").on("click", function () {
                $("#addNewInquiryButton").hide();
                $("#inquiryFormCard").show(); // Display the form card
                // Clear validation messages
                $(".text-danger").hide();
                $("input, select").removeClass("is-invalid border-danger");
            });

            $("#cancelInquiryFormButton").on("click", function () {
                $("#addNewInquiryButton").show();
                $("#inquiryFormCard").hide(); // Hide the form card
                // Clear all fields in the form
                $("#inquiryFormCard input[type=text], textarea").val("");
                $("#inquiryFormCard select").val("");
                // Clear validation messages
                $(".text-danger").hide();
                $("input, select").removeClass("is-invalid border-danger"); 
            });
    });

    $(document).on('click', '.processing-btn', function() {
        const leadId = $(this).data('id');
        
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to mark this lead as processing?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, process it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ route("leads.processing") }}',
                    type: 'POST',
                    data: {
                        id: leadId
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire(
                                'Updated!',
                                response.message,
                                'success'
                            );
                            inquiryTable.ajax.reload();
                        }
                    },
                    error: function(xhr) {
                        Swal.fire(
                            'Error!',
                            xhr.responseJSON?.message || 'Something went wrong!',
                            'error'
                        );
                    }
                });
            }
        });
    });

    $(document).on('click', '.delete-btn', function() {
        const leadId = $(this).data('id');

        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to delete this lead?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ route("leads.destroy") }}', // Ensure this route is defined in your routes
                    type: 'DELETE',
                    data: {
                        id: leadId,
                        _token: '{{ csrf_token() }}' // Include CSRF token
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire(
                                'Deleted!',
                                response.message,
                                'success'
                            );
                            inquiryTable.ajax.reload(); // Reload the DataTable
                        }
                    },
                    error: function(xhr) {
                        Swal.fire(
                            'Error!',
                            xhr.responseJSON?.message || 'Something went wrong!',
                            'error'
                        );
                    }
                });
            }
        });
    });

   
</script>


@endsection
