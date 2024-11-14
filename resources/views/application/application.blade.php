@extends('components.app')

@section('content')

<div class="card bg-dark shadow-none mb-4">
    <div class="card-body">
        <h4 class="text-white"><i class='bx bx-list-plus'>&nbsp;</i>Application</h4>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md">
        <div class="card" id="applicationFormCard" style="display: none;">
            <div class="card-header">
                <h5 class="text-primary card-title">Application Form</h5>
            </div>
            <div class="card-body">
                <form id="applicationFormData">
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
                                <small class="text-danger" id="validateAge">Enter Customer Age</small>
                            </div>
                            <div class="col-md">
                                <label for="mobile_number" class="form-label required">Mobile Number</label>
                                <input type="text" class="form-control" id="mobile_number" name="mobile_number" placeholder="09" />
                                <small class="text-danger" id="validateMobileNumber">Enter Valid Mobile Number</small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md">
                                <label for="province" class="form-label required">Province</label>
                                <select class="form-control" id="province" name="province">
                                    <option value="">Select Province</option>
                                </select>
                                <small class="text-danger" id="validateProvince">Please Select a Province</small>
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
                                <small class="text-danger" id="validateVariant">Please Select Variant</small>
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
                            <select class="form-control" id="source" name="source">
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
                            <button type="button" class="btn btn-label-danger" id="cancelApplicationFormButton">Cancel</button>
                            <button type="submit" class="btn btn-success">Add Application</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row mb-2">
    <div class="col-md d-flex justify-content-end">
        <button class="btn btn-primary" id="addNewApplicationButton">Add Application</button>
    </div>
</div>
<div class="row mb-2">
    <div class="col">
        <div class="card custom-card">
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-md">
                        <label for="dateRangePicker" class="form-label">Date Range</label>
                        <div class="input-group input-daterange w-50" id="bs-datepicker-daterange">
                            <input id="dateRangePicker" type="text" placeholder="MM/DD/YYYY" class="form-control" />
                            <span class="input-group-text">to</span>
                            <input type="text" placeholder="MM/DD/YYYY" class="form-control" />
                          </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md">
                        {{-- <label for="" class="form-label">Tabs</label> --}}
                        <div class="btn-group w-100" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-label-dark active">Pending</button>
                            <button type="button" class="btn btn-label-dark">Approved</button>
                            <button type="button" class="btn btn-label-dark">Denied/Canceled</button>
                            <button type="button" class="btn btn-label-dark">Cash</button>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="applicationTable" class="table table-striped table-hover" style="width:100%">
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
    const applicationTable = $('#applicationTable').DataTable({
        // responsive: true,
        data: [
            {
                "team": "Team A",
                "agent": "John Doe",
                "customer_name": "Jane Smith",
                "unit": "Toyota Corolla",
                "variant": "1.8L",
                "transaction": "Cash",
                "gender": "Female",
                "age": "25",
                "source": "Social-Media",
                "province": "Metro Manila",
                "remarks": "No remarks",
                "status": "Approved",
                "date": "2022-01-01",
                "id": "1"
            }
        ],
        columns: [
            { data: 'team', name: 'team', title: 'Team' },
            { data: 'agent', name: 'agent', title: 'Agent' },
            { data: 'customer_name', name: 'customer_name', title: 'Customer Name' },
            { data: 'unit', name: 'unit', title: 'Unit' },
            { data: 'variant', name: 'variant', title: 'Variant' },
            { data: 'transaction', name: 'transaction', title: 'Transaction' },
            { data: 'gender', name: 'gender', title: 'Gender' },
            { data: 'age', name: 'age', title: 'Age' },
            { data: 'source', name: 'source', title: 'Source' },
            { data: 'province', name: 'province', title: 'Province' },
            { data: 'status', name: 'status', title: 'Status' },
            { data: 'date', name: 'date', title: 'Date' },
            {
                data: 'remarks',
                title: 'Remarks',
                orderable: false,
                searchable: false,
                render: function(data) {
                    return `
                        <div class="d-flex">
                            <button type="button" class="btn btn-icon me-2 btn-info" data-bs-toggle="modal" data-bs-target="#editThesisEntiresModal">
                                <span class="tf-icons bx bx-show-alt bx-22px"></span>
                            </button>
                        </div>`;
                }
            },
            {
                data: 'id',
                title: 'Action',
                orderable: false,
                searchable: false,
                render: function(data) {
                    return `
                        <div class="d-flex">
                            <button type="button" class="btn btn-icon me-2 btn-success" data-bs-toggle="modal" data-bs-target="#editThesisEntiresModal">
                                <span class="tf-icons bx bx-pencil bx-22px"></span>
                            </button>
                        </div>
                    `;
                }
            }
        ]
    });

    $(document).ready(function() {
        $('.btn-group .btn').on('click', function() {
            // Remove 'active' class from all buttons in the group
            $('.btn-group .btn').removeClass('active');
            // Add 'active' class to the clicked button
            $(this).addClass('active');
        });
    });

    // display form
    $(document).ready(function () {
            // Show #inquiryFormCard when #addNewInquiryButton is clicked
            $("#addNewApplicationButton").on("click", function () {
                $("#addNewApplicationButton").hide();
                $("#applicationFormCard").show(); // Display the form card
                // Clear validation messages
                $(".text-danger").hide();
                $("input, select").removeClass("is-invalid border-danger");
            });

            $("#cancelApplicationFormButton").on("click", function () {
                $("#addNewApplicationButton").show();
                $("#applicationFormCard").hide(); // Hide the form card
                // Clear all fields in the form
                $("#applicationFormCard input[type=text], textarea").val("");
                $("#applicationFormCard select").val("");
                // Clear validation messages
                $(".text-danger").hide();
                $("input, select").removeClass("is-invalid border-danger");
            });
    });


    $(document).ready(function () {
    $("#applicationFormData").on("submit", function (event) {
        event.preventDefault(); // Prevent form submission
        let isValid = true;

        // Clear previous error messages
        $("small.text-danger").hide().text("");

        // Helper function to show errors
        function showError(selector, message) {
            $(selector).show().text(message);
            isValid = false;
        }

        // 1. Validate if each input word starts with an uppercase letter
        function validateCapitalization(fieldId, errorId) {
            const value = $(fieldId).val().trim();
            const words = value.split(" ");
            const capitalized = words.every(word => /^[A-Z]/.test(word)); // Check each word starts with uppercase
            if (!capitalized) {
                showError(errorId, "Each word must start with an uppercase letter.");
            }
        }

        validateCapitalization("#first_name", "#validateFirstname");
        validateCapitalization("#last_name", "#validateLastname");

            // // 2. Validate Philippines phone number (must start with 09 and be exactly 11 digits)
            // $("#mobile_number").on("input", function () {
            //     const value = $(this).val();
            //     if (!/^09\d*$/.test(value)) {
            //         // If input doesn't start with "09" or contains non-numeric characters, remove the last input
            //         $(this).val(value.slice(0, -1));
            //     }
            // });

        // 3. Validate required fields
        const requiredFields = [
            { id: "#first_name", errorId: "#validateFirstname", message: "Enter Customer First Name" },
            { id: "#last_name", errorId: "#validateLastname", message: "Enter Customer Last Name" },
            { id: "#gender", errorId: "#validateGender", message: "Please Select Gender" },
            { id: "#age", errorId: "#validateLastname", message: "Enter Customer Age" },
            { id: "#mobile_number", errorId: "#validateMobileNumber", message: "Enter Valid Mobile Number" },
            { id: "#province", errorId: "#validateProvince", message: "Please Select a Province" },
            { id: "#car_unit", errorId: "#validateUnit", message: "Please Select Unit" },
            { id: "#car_variant", errorId: "#validateVariant", message: "Please Select Variant" },
            { id: "#car_color", errorId: "#validateColor", message: "Please Select Color" },
            { id: "#transaction", errorId: "#validateTransaction", message: "Please Select Transaction" },
            { id: "#source", errorId: "#validateSource", message: "Please Select Source" }
        ];

        requiredFields.forEach(field => {
            const value = $(field.id).val().trim();
            if (value === "") {
                showError(field.errorId, field.message);
            }
        });

        // If all validations pass, submit the form
        if (isValid) {
            this.submit();
        }
    });
});

$(document).ready(function () {
    $("#mobile_number").on("input", function () {
        let value = $(this).val();

        // Enforce the number to start with "09" and allow only digits
        if (!/^09/.test(value)) {
            value = "09"; // If it doesn't start with "09", reset to "09"
        } else {
            value = value.replace(/[^0-9]/g, ""); // Remove any non-numeric characters
        }

        // Limit to exactly 11 digits
        if (value.length > 11) {
            value = value.slice(0, 11); // Truncate to 11 characters if exceeded
        }

        // Update the input field with the sanitized value
        $(this).val(value);
    });

    // Form submission event to check final validation
    $("#applicationFormData").on("submit", function (event) {
        const mobileNumber = $("#mobile_number").val();
        if (mobileNumber.length !== 11) {
            event.preventDefault();
            $("#validateMobileNumber").show().text("Mobile number must be exactly 11 digits.");
        }
    });
});


</script>


@endsection
