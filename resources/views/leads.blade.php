@extends('components.app')

@section('content')

<div class="row mb-4">
    <div class="col-md">
        <div class="card" id="inquiryFormCard" style="display: none;">
            <div class="card-header">
                <h5 class="text-primary card-title">Inquiry Form</h5>
            </div>
            <div class="card-body">
                <form action="" method="">
                    @csrf
                    <div class="mb-4">
                        <div class="row mb-2">
                            <div class="col-md">
                                <label for="first_name" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="" />
                                <small class="text-danger" id="validateFirstname">Enter Customer First Name</small>
                            </div>
                            <div class="col-md">
                                <label for="last_name" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="" />
                                <small class="text-danger" id="validateLastname">Enter Customer Last Name</small>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md">
                                <label for="age" class="form-label">Age</label>
                                <input type="number" class="form-control" id="age" name="age" placeholder="" />
                                <small class="text-danger" id="validateLastname">Enter Customer Age</small>
                            </div>
                            <div class="col-md">
                                <label for="mobile_number" class="form-label">Mobile Number</label>
                                <input type="text" class="form-control" id="mobile_number" name="mobile_number" placeholder="09" />
                                <small class="text-danger" id="validateMobileNumber">Enter Valid Mobile Number</small>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="row mb-2">
                            <div class="col-md">
                                <label for="car_unit" class="form-label">Unit</label>
                                <select class="form-control" id="car_unit" name="car_unit">
                                    <option value="">Select Unit</option>
                                    <option value="vios">Vios</option>
                                    <option value="wigo">Wigo</option>
                                    <option value="lancer">Lancer</option>
                                    <option value="fortuner">Fortuner</option>
                                </select>
                                <small class="text-danger" id="validateUnit">Please Select Unit</small>
                            </div>
                            <div class="col-md">
                                <label for="car_variant" class="form-label">Variants</label>
                                <select class="form-control" id="car_variant" name="car_variant">
                                    <option value="" disabled>Select Variants</option>
                                    <option value="vios">Vios</option>
                                    <option value="wigo">Wigo</option>
                                    <option value="lancer">Lancer</option>
                                    <option value="fortuner">Fortuner</option>
                                </select>
                                <small class="text-danger" id="validateVariant">Please Select Variant</small>
                            </div>
                            <div class="col-md">
                                <label for="car_color" class="form-label">Color</label>
                                <select class="form-control" id="car_color" name="car_color">
                                    <option value="">Select Color</option>
                                    <option value="black">Black</option>
                                    <option value="red">Red</option>
                                    <option value="silver">Silver</option>
                                    <option value="white">White</option>
                                </select>
                                <small class="text-danger" id="validateColor">Please Select Color</small>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md">
                            <label for="transaction" class="form-label">Transactions</label>
                            <select class="form-control" id="transaction" name="transaction">
                                <option value="">Select Transactions</option>
                                <option value="cash">Cash</option>
                                <option value="po">PO</option>
                                <option value="financing">Financing</option>
                            </select>
                            <small class="text-danger" id="validateTransaction">Please Select Transaction</small>
                        </div>
                        <div class="col-md">
                            <label for="source" class="form-label">Source</label>
                            <input type="text" class="form-control" id="source" name="source" placeholder="" />
                            <small class="text-danger" id="validateSource">Add Source</small>
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
    columns: [
        { data: 'team', name: 'team', title: 'Team' },
        { data: 'agent', name: 'agent', title: 'Agent' },
        { data: 'customer_name', name: 'customer_name', title: 'Customer Name' },
        { data: 'contact_no', name: 'contact_no', title: 'Contact No.' },
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
                        <button type="button" class="btn btn-icon me-2 btn-label-primary">
                            <span class="tf-icons bx bxs-check-circle bx-22px"></span>
                        </button>
                        <button type="button" class="btn btn-icon me-2 btn-label-danger">
                            <span class="tf-icons bx bxs-x-circle bx-22px"></span>
                        </button>
                    </div>
                `;
            }
        }
    ],
    order: [[14, 'desc']], // Sort by date created by default
    responsive: false,
    data: [{ // Sample data row
        id: 1,
        team: 'Sales Team',
        agent: 'John Doe',
        customer_name: 'Jane Smith',
        contact_no: '123-456-7890',
        unit: 'Unit 1',
        variant: 'Variant A',
        color: 'Red',
        transaction: 'Purchase',
        gender: 'Female',
        age: '25',
        source: 'Website',
        province: 'California',
        remarks: 'No remarks',
        date: '2024-01-10 09:00:00'
    }]
});

// Inquiry Form Validation
    $(document).ready(function () {
        // Hide warning messages initially
        $("small").hide();

        // Helper function to capitalize first letter of each word
        function capitalizeWords(str) {
            return str.replace(/\b\w/g, function (txt) {
                return txt.toUpperCase();
            });
        }

        // Validate form on submit
        $("form").on("submit", function (e) {
            let isValid = true;

            // First Name Validation
            const firstName = $("#first_name").val().trim();
            if (!firstName) {
                $("#validateFirstname").show();
                isValid = false;
            } else {
                $("#validateFirstname").hide();
                $("#first_name").val(capitalizeWords(firstName));
            }

            // Last Name Validation
            const lastName = $("#last_name").val().trim();
            if (!lastName) {
                $("#validateLastname").show();
                isValid = false;
            } else {
                $("#validateLastname").hide();
                $("#last_name").val(capitalizeWords(lastName));
            }

            // Age Validation
            const age = $("#age").val().trim();
            if (!age || isNaN(age) || age <= 0) {
                $("#validateAge").show();
                isValid = false;
            } else {
                $("#validateAge").hide();
            }

            // Validate Philippine mobile number format
            $("#mobile_number").on("keyup", function () {
                const mobileNumber = $(this).val().trim();
                const validPattern = /^(09|\+63)\d*$/;

                // Allow only numbers after +63 or 09 and prevent invalid inputs
                if (!validPattern.test(mobileNumber)) {
                    $(this).val(mobileNumber.slice(0, -1));  // remove last invalid character
                    $("#validateMobileNumber").show();
                } else {
                    $("#validateMobileNumber").hide();
                }
            });

            // Car Unit Validation
            const carUnit = $("#car_unit").val();
            if (!carUnit) {
                $("#validateUnit").show();
                isValid = false;
            } else {
                $("#validateUnit").hide();
            }

            // Car Variant Validation
            const carVariant = $("#car_variant").val();
            if (!carVariant) {
                $("#validateVariant").show();
                isValid = false;
            } else {
                $("#validateVariant").hide();
            }

            // Car Color Validation
            const carColor = $("#car_color").val();
            if (!carColor) {
                $("#validateColor").show();
                isValid = false;
            } else {
                $("#validateColor").hide();
            }

            // Transaction Validation
            const transaction = $("#transaction").val();
            if (!transaction) {
                $("#validateTransaction").show();
                isValid = false;
            } else {
                $("#validateTransaction").hide();
            }

            // Source Validation
            const source = $("#source").val().trim();
            if (!source) {
                $("#validateSource").show();
                isValid = false;
            } else {
                $("#validateSource").hide();
                $("#source").val(capitalizeWords(source));
            }

            // Prevent form submission if validation fails
            if (!isValid) {
                e.preventDefault();
            }
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
        });

        $("#cancelInquiryFormButton").on("click", function () {
            $("#addNewInquiryButton").show();
            $("#inquiryFormCard").hide(); // Hide the form card
            // Clear all fields in the form
            $("#inquiryFormCard input[type=text], textarea").val("");
            $("#inquiryFormCard select").val("");
        });
});
</script>


@endsection
