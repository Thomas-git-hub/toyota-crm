@extends('components.app')

@section('content')

{{-- Title Header --}}
<div class="card bg-dark shadow-none mb-4">
    <div class="card-body">
        <div class="d-flex align-items-center">
            <i class='bx bxs-car-garage text-white' style="font-size: 24px;">&nbsp;</i>
            <h4 class="text-white mb-0">Vehicle Inventory</h4>
        </div>
    </div>
</div>

{{-- Edit Inventory Data Modal --}}
<div class="modal fade" id="editInventoryFormModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            </button>
        </div>
        <div class="modal-body">
            <form id="editInventoryFormData">
                @csrf
                <div class="row mb-3">
                    <div class="col-md">
                        <label for="car_unit" class="form-label required">Unit</label>
                        <select class="form-control" id="edit_car_unit" name="car_unit">
                            <option value="">Select Unit</option>
                        </select>
                        <small class="text-danger" id="validateUnit">Please Select Unit</small>
                    </div>
                    <div class="col-md">
                        <label for="car_variant" class="form-label required">Variants</label>
                        <select class="form-control" id="edit_car_variant" name="car_variant">
                            <option value="">Select Variants</option>
                        </select>
                        <small class="text-danger" id="validateVariant">Please Select Variant</small>
                    </div>
                    <div class="col-md">
                        <label for="car_color" class="form-label required">Color</label>
                        <select class="form-control" id="edit_car_color" name="car_color">
                            <option value="">Select Color</option>
                        </select>
                        <small class="text-danger" id="validateColor">Please Select Color</small>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md">
                        <label for="car_unit" class="form-label required">Year Model</label>
                        <select class="form-control" id="editYearModel" name="year_model">
                            <option value="">Select Year</option>
                        </select>
                        <small class="text-danger" id="validateYearModel">Please Select Year Model</small>
                    </div>
                    <div class="col-md">
                        <label for="exampleFormControlInput1" class="form-label required">CS Number</label>
                        <input type="email" class="form-control" id="editCsNumber" placeholder="" />
                        <small class="text-danger" id="validateCSNumber">Input CS Number</small>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md">
                        <label for="flatpickr-date" class="form-label required">Actual Invoice Date</label>
                        <input type="text" class="form-control" placeholder="YYYY-MM-DD" id="editActualInvoiceDate" />
                        <small class="text-danger" id="validateInvoiceDate">Pick Actual Invoice Date</small>

                    </div>
                    <div class="col-md">
                        <label for="flatpickr-date" class="form-label required">Delivery Date</label>
                        <input type="text" class="form-control" placeholder="YYYY-MM-DD" id="editDeliveryDate" />
                        <small class="text-danger" id="validateDeliveryDate">Pick Delivery Date</small>

                    </div>
                    <div class="col-md">
                        <label for="exampleFormControlInput1" class="form-label required">Invoice Number</label>
                        <input type="email" class="form-control" id="editInvoiceNumber" placeholder="" />
                        <small class="text-danger" id="validateInvoiceNumber">Input Invoice Number</small>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md">
                        <label for="exampleFormControlTextarea1" class="form-label">Remarks</label>
                        <textarea class="form-control" id="editRemarks" rows="3"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-label-danger" id="cancelEditInventoryFormButton">Cancel</button>
                        <button type="submit" class="btn btn-dark" id="addEditInventoryFormButton">Add to Inventory</button>
                    </div>
                </div>
            </form>
        </div>
      </div>
    </div>
</div>

<!-- Vehicle Incoming Status Modal -->
<div class="modal fade" id="incomingStatusModal" tabindex="-1" aria-labelledby="incomingStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Vehicle Transportation Status</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            </button>
        </div>
        <div class="modal-body">
            <form action="">
                <div class="row mb-4">
                    <div class="col-md">
                        <label for="select_agent" class="form-label required">Update Icoming Status</label>
                        <select class="form-control" id="selectIncomingStatus" name="incoming_status">
                            <option value="">Select Status</option>
                        </select>
                        <small class="text-danger" id="validateIncomingStatus">Please select Incoming Status</small>
                    </div>
                    <input type="hidden" class="form-control" id="incomingStatus" name="incomingStatus" placeholder="" />
                </div>
                <div class="row">
                    <div class="col-md d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-label-danger" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-dark" id="UpdateIncomingStatusModalButton">Update Incoming Status</button>
                    </div>
                </div>
            </form>
        </div>
      </div>
    </div>
</div>

<!-- Ear Marked Modal -->
<div class="modal fade" id="earmarkModal" tabindex="-1" aria-labelledby="earMarkModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ear Mark</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            </button>
        </div>
        <div class="modal-body">
            <form action="">
                <div class="row mb-4">
                    <div class="col-md">
                        <label for="select_agent" class="form-label required">Select the Agent to be Earmarked</label>
                        <select class="form-control" id="earmarkAgent" name="earmark">
                            <option value="">Select Agent</option>
                        </select>
                        <small class="text-danger" id="validateEarMarkAgent">Please select agent</small>
                    </div>
                    <input type="hidden" class="form-control" id="inquiry_type_id" name="inquiry_type_id" placeholder="" />
                </div>
                <div class="row">
                    <div class="col-md d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-label-danger" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-dark" id="tagAgentModalButton">Tag Agent</button>
                    </div>
                </div>
            </form>
        </div>
      </div>
    </div>
</div>

{{-- Datatables --}}
<div class="row mb-4">
    <div class="col-md">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md">
                        <div class="card shadow-none border custom-card">
                            <div class="card-body">
                                <h5>Available Units</h5>
                                <div class="table-responsive">
                                    <table id="availableUnitsTable" class="table table-bordered table-hover" style="width:100%">
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="card shadow-none border custom-card">
                            <div class="card-body">
                                <h5>Status</h5>
                                <div class="table-responsive">
                                    <table id="statusTable" class="table table-bordered table-hover" style="width:100%">
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="card shadow-none border custom-card">
                            <div class="card-body">
                                <h5>Incoming Units</h5>
                                <div class="table-responsive">
                                    <table id="incomingUnitsTable" class="table table-bordered table-hover" style="width:100%">
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="card shadow-none bg-transparent w-100 h-100 d-flex justify-content-center align-items-center">
                            <div class="card-body text-center">
                                <h1 class="text-primary"><b>Total Inventory</b></h1>
                                <h1 class="text-primary" style="font-size: clamp(15rem, 6vw, 3rem);"><b id="totalInventory" >0</b></h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Vehicle Form --}}
<div class="row mb-4">
    <div class="col-md">
        <div class="card" id="vehicleFormCard" style="display: none;">
            <div class="card-header">
                <h5 class="text-primary card-title">Vehicle Form</h5>
            </div>
            <div class="card-body">
                <form id="vehicleFormData">
                    @csrf
                    <div class="row mb-2">
                        <div class="col-md">
                            <label for="unit" class="form-label">Unit</label>
                            <input type="text" class="form-control" id="unit" name="unit" required />
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md">
                            <label for="variant" class="form-label">Variant</label>
                            <input type="text" class="form-control" id="variant" name="variant" required />
                        </div>
                        <div class="col-md">
                            <label for="color" class="form-label">Color</label>
                            <input type="text" class="form-control" id="color" name="color" required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md d-flex justify-content-end gap-2">
                            <button type="button" class="btn btn-label-danger" id="cancelVehicleFormButton">Cancel</button>
                            <button type="submit" class="btn btn-dark">Add Vehicle</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Inventory Form --}}
<div class="row mb-4">
    <div class="col-md">
        <div class="card" id="inventoryFormCard" style="display: none;">
            <div class="card-header">
                <h5 class="text-primary card-title">Inventory Form</h5>
            </div>
            <div class="card-body">
                <form id="inventoryFormData">
                    @csrf
                    <div class="row mb-3">
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
                    <div class="row mb-2">
                        <div class="col-md">
                            <label for="car_unit" class="form-label required">Year Model</label>
                            <select class="form-control" id="yearModel" name="year_model">
                                <option value="">Select Year</option>
                            </select>
                            <small class="text-danger" id="validateYearModel">Please Select Year Model</small>
                        </div>
                        <div class="col-md">
                            <label for="exampleFormControlInput1" class="form-label required">CS Number</label>
                            <input type="email" class="form-control" id="csNumber" placeholder="" />
                            <small class="text-danger" id="validateCSNumber">Input CS Number</small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md">
                            <label for="flatpickr-date" class="form-label required">Actual Invoice Date</label>
                            <input type="text" class="form-control" placeholder="YYYY-MM-DD" id="actualInvoiceDate" />
                            <small class="text-danger" id="validateInvoiceDate">Pick Actual Invoice Date</small>

                        </div>
                        <div class="col-md">
                            <label for="flatpickr-date" class="form-label required">Delivery Date</label>
                            <input type="text" class="form-control" placeholder="YYYY-MM-DD" id="deliveryDate" />
                            <small class="text-danger" id="validateDeliveryDate">Pick Delivery Date</small>

                        </div>
                        <div class="col-md">
                            <label for="exampleFormControlInput1" class="form-label required">Invoice Number</label>
                            <input type="email" class="form-control" id="invoiceNumber" placeholder="" />
                            <small class="text-danger" id="validateInvoiceNumber">Input Invoice Number</small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md">
                            <label for="exampleFormControlTextarea1" class="form-label">Remarks</label>
                            <textarea class="form-control" id="remarks" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md d-flex justify-content-end gap-2">
                            <button type="button" class="btn btn-label-danger" id="cancelInventoryFormButton">Cancel</button>
                            <button type="submit" class="btn btn-dark" id="addInventoryFormButton">Add to Inventory</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Trigger Vehicle and Inventory Form - Button --}}
<div class="row mb-2">
    <div class="col-md d-flex justify-content-end gap-2">
        <button class="btn btn-primary" id="addVehicleButton">Add New Vehicle</button>
        <button class="btn btn-primary" id="addInventoryButton">Add to Inventory</button>
    </div>
</div>

{{-- Datatable --}}
<div class="row mb-2">
    <div class="col">
        <div class="card custom-card">
            <div class="card-body">
                <div class="row">
                    <div class="d-flex w-50 gap-2">
                        <div class="mb-3">
                            <div class="input-group">
                                <input type="text" id="date-range-picker" class="form-control" placeholder="Select date range">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md">
                        <div class="btn-group w-100" role="group" aria-label="Basic example">
                            <button id="incoming" type="button" class="btn btn-label-dark active" data-route="">Incoming</button>
                            <button id="inventory" type="button" class="btn btn-label-dark" data-route="">Inventory</button>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="vehicleInventoryTable" class="table table-bordered table-hover" style="width:100%">
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

    // actual invoice date picker
    var flatpickrDate = document.querySelector("#actualInvoiceDate");
        flatpickrDate.flatpickr({
        monthSelectorType: "static"
    });

    // delivery date picker
    var flatpickrDate = document.querySelector("#deliveryDate");
        flatpickrDate.flatpickr({
        monthSelectorType: "static"
    });

    // Count of Total Inventory
    function totalInventory() {
        $.ajax({
            url: '{{ route("vehicle.inventory.getTotalInventory") }}', // Adjust the route as necessary
            type: 'GET',
            success: function(response) {
                if (response.totalInventory !== undefined) {
                    $('#totalInventory').text(response.totalInventory); // Update the count in the HTML
                }
            },
            error: function(xhr) {
                console.error('Error fetching transaction count:', xhr);
            }
        });
    }

    totalInventory();

    //Date filter
    flatpickr("#date-range-picker", {
        mode: "range",
        dateFormat: "m/d/Y",
        onChange: function(selectedDates, dateStr, instance) {
            // Check if both start and end dates are selected
            if (selectedDates.length === 2) {
                // Check if the end date is earlier than or equal to the start date
                if (selectedDates[1] <= selectedDates[0]) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Warning!',
                        text: 'Please select a valid date range.',
                    });
                } else {
                    // Reload the tables if a valid range is selected
                    vehicleInventoryTable.ajax.reload(null, false);
                }
            }
        },
        // Add clear button
        onReady: function(selectedDates, dateStr, instance) {
            // Create a "Clear" button
            const clearButton = document.createElement("button");
            clearButton.innerHTML = "Clear";
            clearButton.classList.add("clear-btn");

            // Create a "Close" button
            const closeButton = document.createElement("button");
            closeButton.innerHTML = "Close";
            closeButton.classList.add("close-btn");

            // Append the buttons to the flatpickr calendar
            instance.calendarContainer.appendChild(clearButton);
            instance.calendarContainer.appendChild(closeButton);

            // Add event listener to clear the date and reload the tables
            clearButton.addEventListener("click", function() {
                instance.clear(); // Clear the date range
                vehicleInventoryTable.ajax.reload(null, false); // Reload the tables
            });

            // Add event listener to close the calendar
            closeButton.addEventListener("click", function() {
                instance.close(); // Close the flatpickr calendar
            });
        }
    });

    // Vehicle Form Submission
    $(document).ready(function() {
        $('#vehicleFormData').on('submit', function(e) {
            e.preventDefault();

            let formData = {
                unit: $('#unit').val(),
                variant: $('#variant').val(),
                color: $('#color').val(),
            };

            $.ajax({
                url: '{{ route("vehicle.store") }}', // Adjust to your route name
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
                        }).then(() => {
                            // Reload the page after success alert is closed
                            location.reload();
                        });
                    }
                },
                error: function(xhr) {
                    let errorMessage = xhr.responseJSON?.message || 'Something went wrong!';
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: errorMessage
                    });

                    // Highlight validation errors if any
                    if (xhr.responseJSON?.errors) {
                        for (const [field, messages] of Object.entries(xhr.responseJSON.errors)) {
                            $(`#${field}`).addClass('is-invalid border-danger');
                            $(`#${field}`).after(`<small class="text-danger">${messages[0]}</small>`);
                        }
                    }
                }
            });
        });
    });


    // Vehicle Form Hide Show
    $(document).ready(function() {
        // Show the #vehicleFormCard when #addVehicleButton is clicked
        $('#addVehicleButton').click(function() {
            $('#vehicleFormCard').show();
            $("#inventoryFormCard").hide(); // Hide the inventory form card
        });

        // Reset all inputs inside #vehicleFormData and hide #vehicleFormCard when #cancelVehicleFormButton is clicked
        $('#cancelVehicleFormButton').click(function() {
            $('#vehicleFormData').find('input').val(''); // Reset all input fields
            $('#vehicleFormCard').hide(); // Hide the form card
        });
    });
    $(document).ready(function () {
        // When #addInventoryButton is clicked
        $("#addInventoryButton").on("click", function () {
            $("#inventoryFormCard").show(); // Display the inventory form card
            $("#vehicleFormCard").hide(); // Hide the vehicle form card
        });

        // When #cancelInventoryFormButton is clicked
        $("#cancelInventoryFormButton").on("click", function () {
            $("#inventoryFormData")[0].reset(); // Clear all fields in the form
            $("#inventoryFormCard").hide(); // Hide the inventory form card
        });
    });


    // DataTable initialization
    const availableUnitsTable = $('#availableUnitsTable').DataTable({
        processing: true,
        serverSide: true, // Use client-side processing since we're providing static data
        ajax: {
                    url: '{{ route("vehicle.reservation.units.list") }}',

                },
        pageLength: 10,
        paging: true,
        responsive: true,
        dom: '<"top"lf>rt<"bottom"ip>',
        language: {
            search: "",
            searchPlaceholder: "Search...",
            info: "", // Remove "Showing X to Y of Z entries"
            infoEmpty: "", // Removes the message when there's no data
            infoFiltered: "", // Removes the "filtered from X entries" part
        },

        columns: [
            { data: 'unit', name: 'unit', title: 'Unit' },
            { data: 'quantity', name: 'quantity', title: 'Quantity' },
        ],
        order: [[0, 'desc']],  // Sort by 'unit' column by default
        columnDefs: [
            {
                targets: [0, 1], // Columns to apply additional formatting (if needed)
            }
        ],
    });

    const statusTable = $('#statusTable').DataTable({
        processing: true,
        serverSide: true, // Use client-side processing since we're providing static data
        ajax: {
            url: '{{ route("vehicle.releases.releasedPerTeam") }}',
        },
        pageLength: 10,
        paging: true,
        responsive: true,
        dom: '<"top"lf>rt<"bottom"ip>',
        language: {
            search: "",
            searchPlaceholder: "Search...",
            info: "", // Remove "Showing X to Y of Z entries"
            infoEmpty: "", // Removes the message when there's no data
            infoFiltered: "", // Removes the "filtered from X entries" part
        },
        data: [
            { team: "EOV", quantity: 5 },
            { team: "JDS", quantity: 3 },
            { team: "IBT", quantity: 2 },
            { team: "EDJ", quantity: 4 },
            { team: "JLB", quantity: 1 },
        ],
        columns: [
            { data: 'team', name: 'team', title: 'Team' },
            { data: 'quantity', name: 'quantity', title: 'Quantity' },
        ],
        order: [[0, 'desc']],  // Sort by 'unit' column by default
        columnDefs: [
            {
                targets: [0, 1], // Columns to apply additional formatting (if needed)
            }
        ],
    });

    const incomingUnitsTable = $('#incomingUnitsTable').DataTable({
        processing: true,
        serverSide: false, // Use client-side processing since we're providing static data
        pageLength: 10,
        paging: true,
        responsive: true,
        dom: '<"top"lf>rt<"bottom"ip>',
        language: {
            search: "",
            searchPlaceholder: "Search...",
            info: "", // Remove "Showing X to Y of Z entries"
            infoEmpty: "", // Removes the message when there's no data
            infoFiltered: "", // Removes the "filtered from X entries" part
        },
        data: [
            { for: "Invoice", quantity: 5 },
            { for: "Pull-Out", quantity: 3 },
            { for: "Transit", quantity: 2 },
        ],
        columns: [
            { data: 'for', name: 'for', title: 'For' },
            { data: 'quantity', name: 'quantity', title: 'Quantity' },
        ],
        order: [[0, 'desc']],  // Sort by 'unit' column by default
        columnDefs: [
            {
                targets: [0, 1], // Columns to apply additional formatting (if needed)
            }
        ],
    });

    const vehicleInventoryTable = $('#vehicleInventoryTable').DataTable({
        processing: true,
        serverSide: true, // Use client-side processing since we're providing static data
        ajax: {
            url: '{{ route("vehicle.inventory.list") }}',
            data: function(d) {
                d.date_range = $('#date-range-picker').val();
            },
        },
        pageLength: 10,
        paging: true,
        responsive: true,
        dom: '<"top"lf>rt<"bottom"ip>',
        language: {
            search: "",
            searchPlaceholder: "Search..."
        },
        // data: [
        //     { unit: "Unit1", model: "Model 1", color: "Red", cs_number: "CS001", actual_invoice_date: "2020-01-01", delivery_date: "2020-01-15", invoice_no: "INV001", tags: "Tag 1", team: "Team 1", date_assigned: "2020-01-01", age: "1 year", status: "Active", remarks: "Remark 1", action: "<button class='process-btn'>Process</button>" },
        //     { unit: "Unit2", model: "Model 2", color: "Blue", cs_number: "CS002", actual_invoice_date: "2021-02-01", delivery_date: "2021-02-15", invoice_no: "INV002", tags: "Tag 2", team: "Team 2", date_assigned: "2021-02-01", age: "2 years", status: "Active", remarks: "Remark 2", action: "<button class='process-btn'>Process</button>" },
        //     { unit: "Unit3", model: "Model 3", color: "Green", cs_number: "CS003", actual_invoice_date: "2022-03-01", delivery_date: "2022-03-15", invoice_no: "INV003", tags: "Tag 3", team: "Team 3", date_assigned: "2022-03-01", age: "3 years", status: "Active", remarks: "Remark 3", action: "<button class='process-btn'>Process</button>" },
        //     { unit: "Unit4", model: "Model 4", color: "Yellow", cs_number: "CS004", actual_invoice_date: "2023-04-01", delivery_date: "2023-04-15", invoice_no: "INV004", tags: "Tag 4", team: "Team 4", date_assigned: "2023-04-01", age: "4 years", status: "Active", remarks: "Remark 4", action: "<button class='process-btn'>Process</button>" },
        //     { unit: "Unit5", model: "Model 5", color: "Purple", cs_number: "CS005", actual_invoice_date: "2024-05-01", delivery_date: "2024-05-15", invoice_no: "INV005", tags: "Tag 5", team: "Team 5", date_assigned: "2024-05-01", age: "5 years", status: "Active", remarks: "Remark 5", action: "<button class='process-btn'>Process</button>" },
        // ],
        columns: [
            { data: 'unit', name: 'unit', title: 'Unit' },
            { data: 'model', name: 'model', title: 'Variant' },
            { data: 'color', name: 'color', title: 'Color' },
            { data: 'year_model', name: 'year_model', title: 'Year Model' },
            { data: 'cs_number', name: 'cs_number', title: 'CS Number' },
            { data: 'actual_invoice_date', name: 'actual_invoice_date', title: 'Actual Invoice Date' },
            { data: 'invoice_number', name: 'invoice_number', title: 'Invoice No.' },
            { data: 'delivery_date', name: 'delivery_date', title: 'Delivery Date' },
            { data: 'tags', name: 'tags', title: 'TAGs' },
            // { data: 'team', name: 'team', title: 'Team' },
            // { data: 'date_assigned', name: 'date_assigned', title: 'Date Assigned' },
            { data: 'age', name: 'age', title: 'Age' },
            { data: 'status', name: 'status', title: 'Status' },
            { data: 'remarks', name: 'remarks', title: 'Remarks' },
            {
                data: '[incoming_status]',
                name: '[incoming_status]',
                title: 'Incoming Status',
                orderable: false,
                searchable: false,
                render: function(data, type, row) {
                    return `<button type="button" class="btn btn-icon me-2 btn-label-dark incoming-btn" data-bs-toggle="modal" data-bs-target="#incomingStatusModal" data-id="${row.id}">
                                <span class="tf-icons bx bxs-truck bx-22px"></span>
                            </button>`;
                }
            },
            {
                data: 'ear_mark',
                name: 'ear_mark',
                title: 'Ear Mark',
                orderable: false,
                searchable: false,
                render: function(data, type, row) {
                    return `<button type="button" class="btn btn-icon me-2 btn-label-dark ear-mark-btn" data-bs-toggle="modal" data-bs-target="#earmarkModal" data-id="${row.id}">
                                <span class="tf-icons bx bx-star bx-22px"></span>
                            </button>`;
                }
            },
            {
                data: 'id',
                name: 'id',
                title: 'Action',
                orderable: false,
                searchable: false,
                render: function(data, type, row) {
                        return `<div class="d-flex">
                                    <button type="button" class="btn btn-icon me-2 btn-success edit-btn" data-bs-toggle="modal" data-bs-target="#editInventoryFormModal" data-id="">
                                    <span class="tf-icons bx bx-pencil bx-22px"></span>
                                </button>
                                </div>`;
                    }
            },
        ],
        order: [[0, 'desc']],  // Sort by 'unit' column by default
        columnDefs: [
            {
                targets: [0, 1], // Columns to apply additional formatting (if needed)
            }
        ],
    });

    // datatables button tabs
    $(document).ready(function() {

        $('.btn-group .btn').on('click', function() {
            $('.btn-group .btn').removeClass('active');
            $(this).addClass('active');
            $('#date-range-picker').val(''); // Clear the date range input
            vehicleInventoryTable.ajax.reload(null, false); // Reload the table without resetting the paging

        });
    });

    // Load units, variants and colors
    $(document).ready(function() {

        $.ajax({
            url: '{{ route('leads.getUnit') }}',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                let unitSelect = $('#car_unit, #edit_car_unit');
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
        $('#car_unit, #edit_car_unit').on('change', function() {
            const selectedUnit = $(this).val();
            if (selectedUnit) {
                $.ajax({
                    url: '{{ route("leads.getVariants") }}',
                    type: 'GET',
                    data: { unit: selectedUnit },
                    dataType: 'json',
                    success: function(data) {
                        let variantSelect = $('#car_variant');
                        variantSelect.empty();
                        variantSelect.append('<option value="">Select Variants...</option>');
                        // Check if data.variants is an array or a single value
                        if (Array.isArray(data.variants)) {
                            data.variants.forEach(function(variant) {
                                variantSelect.append(`<option value="${variant}">${variant}</option>`);
                            });
                        } else {
                            variantSelect.append(`<option value="${data.variants}">${data.variants}</option>`);
                        }
                    },
                    error: function(error) {
                        console.error('Error loading variants and colors:', error);
                    }
                });
            } else {
                // Clear the selects if no unit is selected
                $('#car_variant').empty().append('<option value="">Select Variants...</option>');
            }
        });

        $('#car_variant').on('change', function() {
            const selectedVariant = $(this).val();
            if (selectedVariant) {
                $.ajax({
                    url: '{{ route("leads.getColor") }}',
                    type: 'GET',
                    data: { variant: selectedVariant },
                    dataType: 'json',
                    success: function(data) {

                        let colorSelect = $('#car_color');
                        colorSelect.empty();
                        colorSelect.append('<option value="">Select Color...</option>');
                        // Check if data.colors is an array or a single value
                        if (Array.isArray(data.colors)) {
                            data.colors.forEach(function(color) {
                                colorSelect.append(`<option value="${color}">${color}</option>`);
                            });
                        } else {
                            colorSelect.append(`<option value="${data.colors}">${data.colors}</option>`);
                        }

                        // if (!Array.isArray(data.colors) || !data.colors.includes('Any Color')) {
                        //     colorSelect.append('<option value="Any Color">Any Color</option>');
                        // }
                    },
                    error: function(error) {
                        console.error('Error loading variants and colors:', error);
                    }
                });
            } else {
                // Clear the selects if no unit is selected
                $('#car_color').empty().append('<option value="">Select Color...</option>');
            }
        });

        $('#edit_car_variant').on('change', function() {
            const selectedVariant = $(this).val();
            if (selectedVariant) {
                $.ajax({
                    url: '{{ route("leads.getColor") }}',
                    type: 'GET',
                    data: { variant: selectedVariant },
                    dataType: 'json',
                    success: function(data) {

                        let colorSelect = $('#edit_car_color');
                        colorSelect.empty();
                        colorSelect.append('<option value="">Select Color...</option>');
                        // Check if data.colors is an array or a single value
                        if (Array.isArray(data.colors)) {
                            data.colors.forEach(function(color) {
                                colorSelect.append(`<option value="${color}">${color}</option>`);
                            });
                        } else {
                            colorSelect.append(`<option value="${data.colors}">${data.colors}</option>`);
                        }

                        if (!Array.isArray(data.colors) || !data.colors.includes('Any Color')) {
                            colorSelect.append('<option value="Any Color">Any Color</option>');
                        }

                    },
                    error: function(error) {
                        console.error('Error loading variants and colors:', error);
                    }
                });
            } else {
                // Clear the selects if no unit is selected
                $('#car_color').empty().append('<option value="">Select Color...</option>');
            }
        });

    })

    $(document).ready(function() {
        // Get the current year
        const currentYear = new Date().getFullYear();
        const startYear = 2015;
        const endYear = currentYear + 2; // Add two extra years

        // Populate the year dropdown
        for (let year = startYear; year <= endYear; year++) {
            $("#yearModel").append(new Option(year, year));
        }
    })

    // Inventory Form Validation
    $(document).ready(function () {
            // Hide all validation messages initially
            $(".text-danger").hide();

            $("#addInventoryFormButton").on("click", function (e) {
                e.preventDefault(); // Prevent form submission
                let isValid = true;

                // Validate car unit
                if ($("#yearModel").val() === "") {
                    isValid = false;
                    $("#yearModel").addClass("border-danger");
                    $("#validateYearModel").show();
                } else {
                    $("#yearModel").removeClass("border-danger");
                    $("#validateYearModel").hide();
                }

                // Validate car unit
                if ($("#car_unit").val() === "") {
                    isValid = false;
                    $("#car_unit").addClass("border-danger");
                    $("#validateUnit").show();
                } else {
                    $("#car_unit").removeClass("border-danger");
                    $("#validateUnit").hide();
                }

                // Validate car variant
                if ($("#car_variant").val() === "") {
                    isValid = false;
                    $("#car_variant").addClass("border-danger");
                    $("#validateVariant").show();
                } else {
                    $("#car_variant").removeClass("border-danger");
                    $("#validateVariant").hide();
                }

                // Validate car color
                if ($("#car_color").val() === "") {
                    isValid = false;
                    $("#car_color").addClass("border-danger");
                    $("#validateColor").show();
                } else {
                    $("#car_color").removeClass("border-danger");
                    $("#validateColor").hide();
                }

                // Validate CS Number
                if ($("#yearModel").val() === "") {
                    isValid = false;
                    $("#yearModel").addClass("border-danger");
                    $("#validateYearModel").show();
                } else {
                    $("#yearModel").removeClass("border-danger");
                    $("#validateYearModel").hide();
                }

                // Validate CS Number
                if ($("#csNumber").val() === "") {
                    isValid = false;
                    $("#csNumber").addClass("border-danger");
                    $("#validateCSNumber").show();
                } else {
                    $("#csNumber").removeClass("border-danger");
                    $("#validateCSNumber").hide();
                }

                // Validate Actual Invoice Date
                if ($("#actualInvoiceDate").val() === "") {
                    isValid = false;
                    $("#actualInvoiceDate").addClass("border-danger");
                    $("#validateInvoiceDate").show();
                } else {
                    $("#actualInvoiceDate").removeClass("border-danger");
                    $("#validateInvoiceDate").hide();
                }

                // Validate Actual Invoice Date
                if ($("#deliveryDate").val() === "") {
                    isValid = false;
                    $("#deliveryDate").addClass("border-danger");
                    $("#validateDeliveryDate").show();
                } else {
                    $("#deliveryDate").removeClass("border-danger");
                    $("#validateDeliveryDate").hide();
                }

                // Validate Actual Invoice Date
                if ($("#invoiceNumber").val() === "") {
                    isValid = false;
                    $("#invoiceNumber").addClass("border-danger");
                    $("#validateInvoiceNumber").show();
                } else {
                    $("#invoiceNumber").removeClass("border-danger");
                    $("#validateInvoiceNumber").hide();
                }

                // Additional validations for other fields can be added here

                // Submit the form if all validations pass
                if (isValid) {
                    $("#inventoryFormData").submit();
                }
            });
    });

    // Inventory Form Submission
    $(document).ready(function() {
        $('#inventoryFormData').on('submit', function(e) {
            e.preventDefault();

            let formData = {
                car_unit: $('#car_unit').val(),
                car_variant: $('#car_variant').val(),
                car_color: $('#car_color').val(),
                year_model: $('#yearModel').val(),
                cs_number: $('#csNumber').val(),
                actual_invoice_date: $('#actualInvoiceDate').val(),
                delivery_date: $('#deliveryDate').val(),
                invoice_number: $('#invoiceNumber').val(),
                // Add other fields as necessary
            };

            $.ajax({
                url: '{{ route("inventory.store") }}', // Adjust to your route name
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
                        }).then(() => {
                            // Hide the form card after success alert is closed
                            $('#inventoryFormCard').hide();

                            // Reset the form
                            $('#inventoryFormData')[0].reset();

                            // Optionally reload your inventory table or UI component
                            if (typeof vehicleInventoryTable !== 'undefined') {
                                vehicleInventoryTable.ajax.reload();
                            }
                        });
                    }
                },
                error: function(xhr) {
                    let errorMessage = xhr.responseJSON?.message || 'Something went wrong!';
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: errorMessage
                    });

                    // Highlight validation errors if any
                    if (xhr.responseJSON?.errors) {
                        for (const [field, messages] of Object.entries(xhr.responseJSON.errors)) {
                            $(`#${field}`).addClass('is-invalid border-danger');
                            $(`#${field}`).after(`<small class="text-danger">${messages[0]}</small>`);
                        }
                    }
                }
            });
        });
    });






</script>


@endsection
