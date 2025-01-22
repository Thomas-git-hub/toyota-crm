@extends('components.app')

@section('content')

<style>
    .a-tag{
        color: #282830;
        text-decoration: none;
    }
    .a-tag:hover{
        color: #ff4772;
        border-bottom: 3px solid #ff4772;
    }

    .a-tag.active{
        color: #ff0055;
        border-bottom: 3px solid #ff0055;
    }
</style>

{{-- Title Header --}}
<div class="card bg-dark shadow-none mb-5">
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md d-flex align-items-center">
                <i class='bx bxs-dashboard text-white' style="font-size: 24px;">&nbsp;</i>
                <h4 class="text-white mb-0">Dashboard</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md">
                <div class="d-flex justify-content-between">
                    <div class="d-flex align-items-center gap-1">
                        {{-- <i class='bx bx-calendar fs-4 text-warning'></i> --}}
                        <div id="liveDate" class="text-warning fs-6"></div>
                    </div>
                    <div class="d-flex align-items-center gap-1">
                        {{-- <i class='bx bx-time-five fs-4 text-warning'></i> --}}
                        <div id="liveTime" class="text-warning fs-6"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@yield('components.specific_page_scripts')

<div class="row mb-4">
    <div class="col-md">
        <div class="d-flex justify-content-center border-bottom">
            <a href="{{ route('dashboard.release-stats') }}" class="text-decoration-none a-tag py-2 px-5">
                <i class='bx bx-right-top-arrow-circle fs-4 me-2'></i>RELEASE STATS
            </a>
            <a href="{{ route('dashboard.inquiry-analysis') }}" class="text-decoration-none a-tag py-2 px-5">
                <i class='bx bx-layer-plus fs-4 me-2'></i>INQUIRY ANALYSIS
            </a>
            <a href="{{ route('dashboard.sales-funnel') }}" class="text-decoration-none a-tag py-2 px-5">
                <i class='bx bx-transfer-alt fs-4 me-2'></i>SALES FUNNEL MANAGEMENT
            </a>
            <a href="{{ route('dashboard.profitability') }}" class="text-decoration-none a-tag py-2 px-5">
                <i class='bx bx-transfer-alt fs-4 me-2'></i>PROFITABILITY
            </a>
            <a href="{{ route('dashboard.vehicle-to-sales') }}" class="text-decoration-none a-tag py-2 px-5">
                <i class='bx bx-coin fs-4 me-2'></i>VEHICLE TO SALES
            </a>
            <a href="{{ route('dashboard.ranking') }}" class="text-decoration-none a-tag py-2 px-5">
                <i class='bx bx-bar-chart-alt-2 fs-4 me-2'></i>RANKING
            </a>
        </div>
    </div>
</div>


{{-- Profile Name Card --}}
<div class="row mb-3">
    <div class="col-md">
        <div class="card">
          <div class="row d-flex align-items-start">
            <div class="col-md">
              <div class="card-body">
                <h1 class="card-title mb-3" style="color: #ff0055;">Welcome to VSMS John! 🎉</h1>
                <p class="mb-6">Wow! Checkout your dashboard<br />You are doing great!</p>
                <a href="/profile" class="btn btn-sm btn-label-dark">Jump to Profile</a>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>

{{-- Nav Tabs --}}
{{-- <div class="row mb-5">
    <div class="col-md">
        <div class="d-flex justify-content-center border-bottom">
            <a href="" class="text-decoration-none a-tag py-2 px-5"><i class='bx bx-right-top-arrow-circle fs-4 me-2'></i>RELEASE STATS</a>
            <a href="" class="text-decoration-none a-tag py-2 px-5"><i class='bx bx-layer-plus fs-4 me-2'></i>INQUIRY ANALYSIS</a>
            <a href="" class="text-decoration-none a-tag py-2 px-5"><i class='bx bx-transfer-alt fs-4 me-2'></i>SALES FUNNEL MANAGEMENT</a>
            <a href="" class="text-decoration-none a-tag py-2 px-5"><i class='bx bx-transfer-alt fs-4 me-2'></i>PROFITABILITY</a>
            <a href="" class="text-decoration-none a-tag py-2 px-5"><i class='bx bx-coin fs-4 me-2'></i>VEHICLE TO SALES</a>
            <a href="" class="text-decoration-none a-tag py-2 px-5"><i class='bx bx-bar-chart-alt-2 fs-4 me-2'></i>RANKING</a>
        </div>
    </div>
</div> --}}

{{-- Start Date - End Date Filter Group --}}
<div class="row mb-3">
    <div class="col-md d-flex justify-content-end gap-4">
        <div class="form-group text-end">
            <label for="defaultFormControlInput" class="form-label"><small>Select Start to End Date</small></label>
            <input type="text" id="date-range-picker" class="form-control form-control-sm" placeholder="Filter Date">
        </div>
        <div class="form-group text-end">
            <label for="defaultSelect" class="form-label"><small>Filter Group</small></label>
            <select id="selectGroup" class="form-control form-select-sm">
              <option>Select</option>
              <option value="1">Group 1</option>
              <option value="2">Group 2</option>
              <option value="3">Group 3</option>
            </select>
        </div>
    </div>
</div>

<div class="row mb-3">
    {{-- Total Released Units Card --}}
    <div class="col-md-4">
        <div class="card h-100 shadow-none">
            <div class="card-body">
                <h5 class="fw-bold mb-0">Total Released Units</h5>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex flex-column align-items-center gap-1">
                        <h1 class="fw-bold">8,258</h1>
                    </div>
                </div>
                <ul class="p-0 m-0">
                    <li class="d-flex align-items-center border-bottom mb-5">
                        <div class="avatar flex-shrink-0 me-3">
                            <span class="avatar-initial rounded bg-label-dark"><i class="icon-base bx bx-group"></i></span>
                        </div>
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                                <h6 class="mb-0">GROUP</h6>
                                <small>Selected Group</small>
                            </div>
                        <div class="user-progress">
                            <h5 class="mb-0" style="color: #ff0055;">All Group</h5>
                        </div>
                    </li>
                    <li class="d-flex align-items-center border-bottom mb-5">
                        <div class="avatar flex-shrink-0 me-3">
                            <span class="avatar-initial rounded bg-label-dark"><i class="icon-base bx bx-calendar"></i></span>
                        </div>
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                        <div class="me-2">
                            <h6 class="mb-0">MONTH</h6>
                            <small>Selected Month</small>
                        </div>
                        <div class="user-progress">
                            <h5 class="mb-0" style="color: #ff0055;">Present</h5>
                        </div>
                    </li>
                    <li class="d-flex align-items-center border-bottom mb-5">
                        <div class="avatar flex-shrink-0 me-3">
                            <span class="avatar-initial rounded bg-label-dark"><i class="icon-base bx bx-calendar-star"></i></span>
                        </div>
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                        <div class="me-2">
                            <h6 class="mb-0">YEAR</h6>
                            <small>Selected Year</small>
                        </div>
                        <div class="user-progress">
                            <h5 class="mb-0" style="color: #ff0055;">2025</h5>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    {{-- Total Releases Bar Chart --}}
    <div class="col-md-8">
        <div class="card shadow-none h-100">
            <div class="card-body">
                <div id="totalReleasesBarChart"></div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    {{-- Transaction Type Pie Graph Container --}}
    <div class="col-md-3">
        <div class="card h-100">
            <div class="card-body">
                <div class="col-md">
                    <h5 class="mb-0">Transaction Type</h5>
                    <div id="transactionTypePieGraph" class="d-flex justify-content-center h-100"></div>
                </div>
            </div>
        </div>
    </div>
    {{-- Bank Pie Graph Container --}}
    <div class="col-md-3">
        <div class="card h-100">
            <div class="card-body">
                <div class="col-md">
                    <h5 class="mb-0">Bank</h5>
                    <div id="bankPieGraph" class="d-flex justify-content-center h-100"></div>
                </div>
            </div>
        </div>
    </div>
    {{-- Source Pie Graph Container --}}
    <div class="col-md-3">
        <div class="card h-100">
            <div class="card-body">
                <div class="col-md">
                    <h5 class="mb-0">Source</h5>
                    <div id="sourePieGraph" class="d-flex justify-content-center h-100"></div>
                </div>
            </div>
        </div>
    </div>
    {{-- Gender Pie Graph Container --}}
    <div class="col-md-3">
        <div class="card h-100">
            <div class="card-body">
                <div class="col-md">
                    <h5 class="mb-0">Gender</h5>
                    <div id="genderPieGraph" class="d-flex justify-content-center h-100"></div>
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

    // Active Nav Tab
    $('.btn-group .btn').on('click', function (e) {
        e.preventDefault();

        // Clear the date range picker
        $('#date-range-picker').val(''); // Clear the date range input

        // Reload the table without resetting the paging
        //  inquiryTable.ajax.reload(null, false);

        // Get the route from the clicked button
        //  var route = $(this).data('route');
        //  inquiryTable.ajax.url(route).load();

        // Remove 'active' class from all buttons
        $('.btn-group .btn').removeClass('active');

        // Add 'active' class to the clicked button
        $(this).addClass('active');
    });

    function updateTimeAndDate() {
        const now = new Date();

        // Format time (HH:MM:SS)
        const time = now.toLocaleTimeString();

        // Format date (e.g., Monday, December 16, 2024)
        const dateOptions = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        const date = now.toLocaleDateString(undefined, dateOptions);

        // Update the DOM using jQuery
        $('#liveTime').text(time);
        $('#liveDate').text(date);
    }

    // Update time and date every second
    setInterval(updateTimeAndDate, 1000);

    // Initial call to display immediately
    updateTimeAndDate();

    // Bar Chart for Monthly Releases
    var options = {
        series: [{
            name: 'Releases',
            data: [2.3, 3.1, 4.0, 10.1, 4.0, 3.6, 3.2, 2.3, 1.4, 0.8, 0.5, 0.2]
        }],
        chart: {
            height: 350,
            type: 'bar',
        },
        plotOptions: {
            bar: {
                borderRadius: 5,
                dataLabels: {
                    position: 'top', // top, center, bottom
                },
            }
        },
        dataLabels: {
            enabled: true,
            formatter: function (val) {
                return val + "%";
            },
            offsetY: -20,
            style: {
                fontSize: '12px',
                colors: ["#ff0055"] // Data label color
            }
        },
        colors: ['#282830'], // Set the base bar color
        states: {
            hover: {
                filter: {
                    type: 'lighten', // Lighten the color on hover
                    value: 0.2 // Adjust the amount of lightening
                }
            },
            active: {
                allowMultipleDataPointsSelection: false,
                filter: {
                    type: 'darken', // Darken the color on selection
                    value: 0.3 // Adjust the amount of darkening
                }
            }
        },
        xaxis: {
            categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            position: 'top',
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
                    return Math.round(val); // Ensure the value is rounded to a whole number
                }
            }
        },
        title: {
            text: 'Monthly Released Units',
            floating: true,
            offsetY: 330,
            align: 'center',
            style: {
                color: '#444'
            }
        }
    };
    var chart = new ApexCharts(document.querySelector("#totalReleasesBarChart"), options);
    chart.render();

    // Pie Graph Transaction Type
    var options = {
        series: [44, 55, 13],
            chart: {
                width:  410,
                type: 'pie',
            },
        labels: ['Financing', 'Cash', 'PO'],
        colors: ['#282830', '#ff0022', '#8a8c8e'], // Custom colors for the pie chart
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    width: 200
                },
                legend: {
                    position: 'bottom'
                }
            }
        }],
        tooltip: {
            y: {
                formatter: function (val) {
                    return val; // Display whole numbers in the tooltip
                }
            }
        },
        dataLabels: {
            formatter: function (val, opts) {
                return opts.w.config.series[opts.seriesIndex]; // Display the actual value
            }
        },
        dataLabels: {
            style: {
                fontSize: '24px', // Adjust the font size here
                fontFamily: 'Arial, sans-serif', // Optional: Customize the font family
                fontWeight: 'bold', // Optional: Customize the font weight
            },
            formatter: function (val, opts) {
                return opts.w.config.series[opts.seriesIndex]; // Display the actual value
            }
        },
        legend: {
            show: true, // Show the legend
            position: 'bottom', // Position the legend at the bottom
            labels: {
                useSeriesColors: true // Ensure legend uses the segment colors
            }
        },
    };
    var chart = new ApexCharts(document.querySelector("#transactionTypePieGraph"), options);
    chart.render();

    // Pie Graph Bank
    var options = {
        series: [30, 75, 10],
            chart: {
                width:  410,
                type: 'pie',
            },
        labels: ['BDO', 'PNB', 'Union Bank'],
        colors: ['#282830', '#ff0022', '#8a8c8e'], // Custom colors for the pie chart
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    width: 200
                },
                legend: {
                    position: 'bottom'
                }
            }
        }],
        tooltip: {
            y: {
                formatter: function (val) {
                    return val; // Display whole numbers in the tooltip
                }
            }
        },
        dataLabels: {
            formatter: function (val, opts) {
                return opts.w.config.series[opts.seriesIndex]; // Display the actual value
            }
        },
        dataLabels: {
            style: {
                fontSize: '24px', // Adjust the font size here
                fontFamily: 'Arial, sans-serif', // Optional: Customize the font family
                fontWeight: 'bold', // Optional: Customize the font weight
            },
            formatter: function (val, opts) {
                return opts.w.config.series[opts.seriesIndex]; // Display the actual value
            }
        },
        legend: {
            show: true, // Show the legend
            position: 'bottom', // Position the legend at the bottom
            labels: {
                useSeriesColors: true // Ensure legend uses the segment colors
            }
        },
    };
    var chart = new ApexCharts(document.querySelector("#bankPieGraph"), options);
    chart.render();

    // Pie Graph Source
    var options = {
        series: [44, 55, 41, 50, 20, 73],
        labels: ['Repeat Customer', 'Social-Meda', 'Referral', 'Mall Duty', 'Show Room', 'Saturation'],
        colors: [
            '#282830', // Dark Gray (Toyota's professional tone)
            '#ff0022', // Toyota Red (primary brand color)
            '#5f5f72', // Light Gray (neutral accent)
            '#8a8c8e', // Medium Gray (complementary shade)
            '#660015', // Dark Red (deeper shade of Toyota Red)
            '#b6b4c3'  // Soft Gray (more visible than #f5f5f5)
        ],
        chart: {
            width: 450,
            type: 'donut',
        },
        dataLabels: {
            formatter: function (val, opts) {
                // Display the actual value instead of percentage
                return opts.w.config.series[opts.seriesIndex];
            },
            style: {
                fontSize: '14px',
                fontWeight: 'bold',
            }
        },
        legend: {
            show: true, // Show the legend
            position: 'bottom', // Position the legend at the bottom
            labels: {
                useSeriesColors: true // Ensure legend uses the segment colors
            }
        },
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    width: 200
                },
                legend: {
                    position: 'bottom'
                }
            }
        }]
    };
    var chart = new ApexCharts(document.querySelector("#sourePieGraph"), options);
    chart.render();

    // Pie Graph Gender
    var options = {
        series: [44, 90],
        labels: ['Male', 'Female'],
        colors: [
            '#282830', // Dark Gray (Toyota's professional tone)
            '#ff0022', // Toyota Red (primary brand color)
        ],
        chart: {
            width: 400,
            type: 'donut',
        },
        dataLabels: {
            formatter: function (val, opts) {
                // Display the actual value instead of percentage
                return opts.w.config.series[opts.seriesIndex];
            },
            style: {
                fontSize: '14px',
                fontWeight: 'bold',
            }
        },
        legend: {
            show: true, // Show the legend
            position: 'bottom', // Position the legend at the bottom
            labels: {
                useSeriesColors: true // Ensure legend uses the segment colors
            }
        },
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    width: 200
                },
                legend: {
                    position: 'bottom'
                }
            }
        }]
    };
    var chart = new ApexCharts(document.querySelector("#genderPieGraph"), options);
    chart.render();

</script>
@endsection


