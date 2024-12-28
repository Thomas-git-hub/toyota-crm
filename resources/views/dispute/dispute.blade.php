@extends('components.app')
@section('content')

{{-- Page Title --}}
<div class="card bg-dark shadow-none mb-4">
    <div class="card-body">
        <div class="d-flex align-items-center">
            <i class='bx bxs-x-square text-white' style="font-size: 24px;">&nbsp;</i>
            <h4 class="text-white mb-0">Disputes</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md">
        <div class="card">
            <div class="card-body">
                <div class="row mb-2">
                    <div class="d-flex w-50 gap-2">
                        <div class="mb-3">
                            <div class="input-group">
                                <input type="text" id="date-range-picker" class="form-control" placeholder="Select date range">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="disputeTable" class="table table-bordered table-hover" style="width:100%">
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
                    inquiryTable.ajax.reload(null, false);
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
                inquiryTable.ajax.reload(null, false); // Reload the tables
            });

            // Add event listener to close the calendar
            closeButton.addEventListener("click", function() {
                instance.close(); // Close the flatpickr calendar
            });
        }
    });

    // Datatable Initilization
    const teamTable = $('#disputeTable').DataTable({
            processing: true,
            serverSide: false,
            columns: [
                { data: 'id', name: 'id', title: 'ID', visible: false },
                { data: 'agent', name: 'agent', title: 'Agent 1' },
                { data: 'updated_at', name: 'updated_at', title: 'Created At' },
                { data: 'updated_by', name: 'updated_by', title: 'Created By' },
                { data: 'status', name: 'status', title: 'Status' },
                {
                    data: 'action',
                    name: 'action',
                    title: 'Action',
                    render: function (data, type, row) {
                        return `
                            <button type="button" class="btn btn-icon me-2 btn-success edit-btn" data-bs-toggle="modal" data-bs-target="#editTeamModal" data-id="${row.id}" data-name="${row.name}" data-status="${row.status}" data-created-by="${row.created_by}" data-updated-by="${row.updated_by}">
                                <span class="tf-icons bx bx-pencil bx-22px"></span>
                            </button>
                        `;
                    }
                }
            ],
            order: [[2, 'desc']],
        });
</script>
@endsection
