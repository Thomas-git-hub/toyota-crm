@extends('components.app')
@section('content')

{{-- Title Header --}}
<div class="card bg-dark mb-5">
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md d-flex align-items-center">
                <i class='bx bxs-dashboard text-white' style="font-size: 24px;">&nbsp;</i>
                <h4 class="text-white mb-0">Vehicle to Sales</h4>
            </div>
        </div>
    </div>
</div>

{{-- Navlink Include --}}
@include('dashboard.dashboard_navlink')

{{-- Start Date - End Date Filter Group --}}
<div class="row mb-4">
    <div class="col-md d-flex justify-content-end gap-4">
        <div class="form-group text-end">
            <label for="defaultFormControlInput" class="form-label"><small>Select Start to End Date</small></label>
            <input type="text" id="date-range-picker" class="form-control form-control-sm" placeholder="Filter Date">
        </div>
    </div>
</div>

{{-- Card Deliveriesx Releases --}}
<div class="row mb-4">
    <div class="col-md">
        <div class="row">
            <div class="col-md">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="">
                                <label class="fs-4 fw-bold" style="color: #ff0055">Total Deliveries</label><br>
                                <small>Total number of Deliveries</small>
                            </div>
                            <h1 class="fw-bold" id="deliveriesCountCard" style="color: #ff0055">0</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mb-2">
    <div class="col-md">
        <div class="card">
            <div class="card-body">
                {{-- <h5 class="" style="color: #ff0055;">Daily Deliveries</h5> --}}
                <h6 class="">Month of: &nbsp; <b style="color: #ff0055;">February</b></h6>
                <div id="dailyDeliveriesChart"></div>
            </div>
        </div>
    </div>
</div>

<div class="divider">
    <div class="divider-text"><i class='bx bxs-car'></i></div>
</div>

<div class="row mb-4 mt-2">
    <div class="col-md">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="">
                        <label class="fs-4 fw-bold" style="color: #ff0055">Total Releases</label><br>
                        <small>Total number of Releases (Posted & Released)</small>
                    </div>
                    <h1 class="fw-bold" id="releasesCountCard" style="color: #ff0055">0</h1>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mb-2">
    <div class="col-md">
        <div class="card">
            <div class="card-body">
                {{-- <h5 class="" style="color: #ff0055;">Daily Deliveries</h5> --}}
                <h6 class="">Month of: &nbsp; <b style="color: #ff0055;">February</b></h6>
                <div id="dailyReleasesChart"></div>
            </div>
        </div>
    </div>
</div>
@endsection



@section('components.specific_page_scripts')
<script>
    // Initialize flatpickr for date range picker
    flatpickr("#date-range-picker", {
        mode: "range",
        dateFormat: "Y-m-d",
        onChange: function (selectedDates, dateStr, instance) {
            if (selectedDates.length === 2) {
                const startDate = selectedDates[0];
                const endDate = selectedDates[1];

                if (selectedDates[1] <= selectedDates[0]) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Warning!',
                        text: 'Please select a valid date range.',
                    });
                } else {
                    getReleasedToday();
                    totalDeliveriesToday();
                }

                // Update the month and year display
                const startMonth = startDate.toLocaleString('default', { month: 'short' });
                const endMonth = endDate.toLocaleString('default', { month: 'short' });
                const startYear = startDate.getFullYear();
                const endYear = endDate.getFullYear();

                if (startMonth === endMonth && startYear === endYear) {
                    document.getElementById('monthRange').textContent = startMonth;
                } else {
                    const monthRange = `${startMonth} - ${endMonth}`;
                    document.getElementById('monthRange').textContent = monthRange;
                }

                if (startYear === endYear) {
                    document.getElementById('year').textContent = startYear;
                } else {
                    document.getElementById('year').textContent = `${startYear} - ${endYear}`;
                }
            }
        },
        onReady: function (selectedDates, dateStr, instance) {
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
            clearButton.addEventListener("click", function () {
                instance.clear(); // Clear the date range
                getReleasedToday();
                totalDeliveriesToday();
            });

            // Add event listener to close the calendar
            closeButton.addEventListener("click", function () {
                instance.close(); // Close the flatpickr calendar
            });
        }
    });

    function getReleasedToday() {
        $.ajax({
            url: '{{ route("dashboard.vehicle-to-sales-dashboard.getReleasedToday") }}', // Adjust the route as necessary
            type: 'GET',
            data: {
                date_range: $('#date-range-picker').val(),
            },
            success: function(response) {
                if (response.releasedCount !== undefined) {
                    $('#releasesCountCard').text(response.releasedCount); // Update the count in the HTML
                }
            },
            error: function(xhr) {
                console.error('Error fetching transaction count:', xhr);
            }
        });
    }
    getReleasedToday();

    function totalDeliveriesToday() {
        $.ajax({
            url: '{{ route("dashboard.vehicle-to-sales-dashboard.totalDeliveriesToday") }}', // Adjust the route as necessary
            type: 'GET',
            data: {
                date_range: $('#date-range-picker').val(),
            },
            success: function(response) {
                if (response.deliveryCount !== undefined) {
                    $('#deliveriesCountCard').text(response.deliveryCount); // Update the count in the HTML
                }
            },
            error: function(xhr) {
                console.error('Error fetching transaction total:', xhr);
            }
        });
    }
    totalDeliveriesToday();


    // Bar Chart Deliveries
    var options = {
        series: [{
            name: 'Inflation',
            data: [2.3, 3.1, 4.0, 10.1, 4.0, 3.6, 3.2, 2.3, 1.4, 0.8, 0.5, 0.2,
                1.9, 2.8, 3.5, 4.1, 2.0, 2.7, 3.3, 3.9, 2.6, 1.8, 1.5, 0.9,
                0.4, 0.3, 0.7, 1.2, 1.5, 1.8] // Adjust data length to 30 days
        }],
        chart: {
            height: 350,
            type: 'bar',
        },
        plotOptions: {
            bar: {
                borderRadius: 10,
                dataLabels: {
                    position: 'top', // top, center, bottom
                },
            }
        },
        dataLabels: {
            enabled: true,
            formatter: function (val) {
                return val;
            },
            offsetY: -20,
            style: {
                fontSize: '12px',
                colors: ["#ff0055"]
            }
        },
        colors: ['#282830'], // Set the base bar color

        xaxis: {
            categories: Array.from({ length: 30 }, (_, i) => `D-${i + 1}`), // Generates numbers 1-30
            title: {
                text: "DAILY DELIVERIES",
                style: { fontSize: '14px', fontWeight: 'bold' }
            },
            position: 'bottom',
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false
            },
            crosshairs: {
                fill: {
                    type: 'gradient',
                    gradient: {
                        colorFrom: '#D8E3F0',
                        colorTo: '#BED1E6',
                        stops: [0, 100],
                        opacityFrom: 0.4,
                        opacityTo: 0.5,
                    }
                }
            },
            tooltip: {
                enabled: true,
            }
        },
        yaxis: {
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false,
            },
            labels: {
                show: true,
                formatter: function (val) {
                    return val;
                }
            }
        },
        title: {
                text: '',
                floating: true,
                offsetY: 330,
                align: 'center',
                style: {
                    color: '#ff0055'
                }
            },
        labels: {
            style: {
                    colors: '#ff0055', // Set x-axis labels color
                    fontSize: '12px',
                    fontWeight: 'bold'
                }
            },
    };
    var chart = new ApexCharts(document.querySelector("#dailyDeliveriesChart"), options);
    chart.render();


    // Bar Chart Releases
    var options = {
        series: [{
            name: 'Inflation',
            data: [2.3, 3.1, 4.0, 10.1, 4.0, 3.6, 3.2, 2.3, 1.4, 0.8, 0.5, 0.2,
                1.9, 2.8, 3.5, 4.1, 2.0, 2.7, 3.3, 3.9, 2.6, 1.8, 1.5, 0.9,
                0.4, 0.3, 0.7, 1.2, 1.5, 1.8] // Adjust data length to 30 days
        }],
        chart: {
            height: 350,
            type: 'bar',
        },
        plotOptions: {
            bar: {
                borderRadius: 10,
                dataLabels: {
                    position: 'top', // top, center, bottom
                },
            }
        },
        dataLabels: {
            enabled: true,
            formatter: function (val) {
                return val;
            },
            offsetY: -20,
            style: {
                fontSize: '12px',
                colors: ["#FF0055"]
            }
        },
        colors: ['#282830'], // Set the base bar color
        xaxis: {
            categories: Array.from({ length: 30 }, (_, i) => `D-${i + 1}`), // Generates numbers 1-30
            title: {
                text: "DAILY DELIVERIES",
                style: { fontSize: '14px', fontWeight: 'bold' }
            },
            position: 'bottom',
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false
            },
            crosshairs: {
                fill: {
                    type: 'gradient',
                    gradient: {
                        colorFrom: '#D8E3F0',
                        colorTo: '#BED1E6',
                        stops: [0, 100],
                        opacityFrom: 0.4,
                        opacityTo: 0.5,
                    }
                }
            },
            tooltip: {
                enabled: true,
            }
        },
        yaxis: {
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false,
            },
            labels: {
                show: true,
                formatter: function (val) {
                    return val;
                }
            }
        },
        title: {
                text: '',
                floating: true,
                offsetY: 330,
                align: 'center',
                style: {
                    color: '#ff0055'
                }
            }
    };
    var chart = new ApexCharts(document.querySelector("#dailyReleasesChart"), options);
    chart.render();






</script>
@endsection
