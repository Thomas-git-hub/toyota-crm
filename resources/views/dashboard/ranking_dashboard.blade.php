@extends('components.app')
@section('content')

{{-- Title Header --}}
<div class="card bg-dark mb-5">
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-md d-flex align-items-center">
                <i class='bx bxs-dashboard text-white' style="font-size: 24px;">&nbsp;</i>
                <h4 class="text-white mb-0">Sales Funnel Management</h4>
            </div>
        </div>
    </div>
</div>

{{-- Navlink Include --}}
@include('dashboard.dashboard_navlink')

<div class="row mb-4">
    <h5>Top MP/Agent Rankings</h5>
    <div class="col-md">
        <div class="row mb-2">
            <div class="col-md">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="">
                                <div class="d-flex align-items-center gap-2">
                                    <i class='bx bx-trophy fs-2' style="color: #ff0055"></i>
                                    <label class="fs-4 fw-bold" style="color: #ff0055">Top 1 Agent</label><br>
                                </div>
                                <small>Agent with most released units</small>
                            </div>
                            <h3 class="fw-bold" id="deliveriesCountCard" style="color: #ff0055">Angelica Mae Bonganay</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="">
                                <div class="d-flex align-items-center gap-2">
                                    <i class='bx bx-trophy fs-2' style="color: #ff0055"></i>
                                    <label class="fs-4 fw-bold" style="color: #ff0055">Top 2 Agent</label><br>
                                </div>
                                <small>Agent with most released units</small>
                            </div>
                            <h3 class="fw-bold" id="deliveriesCountCard" style="color: #ff0055">Angelica Mae Bonganay</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="">
                                <div class="d-flex align-items-center gap-2">
                                    <i class='bx bx-trophy fs-2' style="color: #ff0055"></i>
                                    <label class="fs-4 fw-bold" style="color: #ff0055">Top 3 Agent</label><br>
                                </div>
                                <small>Agent with most released units</small>
                            </div>
                            <h3 class="fw-bold" id="deliveriesCountCard" style="color: #ff0055">Angelica Mae Bonganay</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="">
                                <div class="d-flex align-items-center gap-2">
                                    <i class='bx bx-trophy fs-2' style="color: #ff0055"></i>
                                    <label class="fs-4 fw-bold" style="color: #ff0055">Top 4 Agent</label><br>
                                </div>
                                <small>Agent with most released units</small>
                            </div>
                            <h3 class="fw-bold" id="deliveriesCountCard" style="color: #ff0055">Angelica Mae Bonganay</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="">
                                <div class="d-flex align-items-center gap-2">
                                    <i class='bx bx-trophy fs-2' style="color: #ff0055"></i>
                                    <label class="fs-4 fw-bold" style="color: #ff0055">Top 5 Agent</label><br>
                                </div>
                                <small>Agent with most released units</small>
                            </div>
                            <h3 class="fw-bold" id="deliveriesCountCard" style="color: #ff0055">Angelica Mae Bonganay</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="rankingTable" class="table table-hover">
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md">
        <div class="card">
            <div class="card-body">
                <div id="rankingBarChart"></div>
            </div>
        </div>
    </div>
</div>
@endsection



@section('components.specific_page_scripts')
<script>
        // Initialize flatpickr for date range picker
        // flatpickr("#date-range-picker", {
        //     mode: "range",
        //     dateFormat: "m/d/Y",
        //     onChange: function (selectedDates, dateStr, instance) {
        //         if (selectedDates.length === 2) {
        //             const startDate = selectedDates[0];
        //             const endDate = selectedDates[1];

        //             showLoader();

        //             if (selectedDates[1] <= selectedDates[0]) {
        //                 Swal.fire({
        //                     icon: 'warning',
        //                     title: 'Warning!',
        //                     text: 'Please select a valid date range.',
        //                 });
        //             } else {

        //                 fetchInquiriesData();
        //                 fetchInquiriesCount();
        //                 fetchReservationCount();
        //                 fetchVehicleQuantity();

        //             }

        //             // Update the month and year display
        //             const startMonth = startDate.toLocaleString('default', { month: 'short' });
        //             const endMonth = endDate.toLocaleString('default', { month: 'short' });
        //             const startYear = startDate.getFullYear();
        //             const endYear = endDate.getFullYear();

        //             if (startMonth === endMonth && startYear === endYear) {
        //                 document.getElementById('monthRange').textContent = startMonth;
        //             } else {
        //                 const monthRange = `${startMonth} - ${endMonth}`;
        //                 document.getElementById('monthRange').textContent = monthRange;
        //             }

        //             if (startYear === endYear) {
        //                 document.getElementById('year').textContent = startYear;
        //             } else {
        //                 document.getElementById('year').textContent = `${startYear} - ${endYear}`;
        //             }

        //             hideLoader();
        //         }
        //     },
        //     onReady: function (selectedDates, dateStr, instance) {
        //         // Create a "Clear" button
        //         const clearButton = document.createElement("button");
        //         clearButton.innerHTML = "Clear";
        //         clearButton.classList.add("clear-btn");

        //         // Create a "Close" button
        //         const closeButton = document.createElement("button");
        //         closeButton.innerHTML = "Close";
        //         closeButton.classList.add("close-btn");

        //         // Append the buttons to the flatpickr calendar
        //         instance.calendarContainer.appendChild(clearButton);
        //         instance.calendarContainer.appendChild(closeButton);

        //         // Add event listener to clear the date and reload the tables
        //         clearButton.addEventListener("click", function () {
        //             instance.clear(); // Clear the date range

        //             fetchInquiriesData();
        //             fetchInquiriesCount();
        //             fetchReservationCount();
        //             fetchVehicleQuantity();


        //         });

        //         // Add event listener to close the calendar
        //         closeButton.addEventListener("click", function () {
        //             instance.close(); // Close the flatpickr calendar
        //         });
        //     }
        // });

        $(document).ready(function () {
            // Static Data
            const staticData = [
                { rank: 1, name: "John Doe", released: 98},
                { rank: 2, name: "Jane Smith", released: 94},
                { rank: 3, name: "Mark Johnson", released: 90},
                { rank: 4, name: "Emily Davis", released: 85}
            ];

            // Dynamic Columns Declaration
            const columns = [
                { data: 'rank', title: 'Rank' },
                { data: 'name', title: 'MP/Agent' },
                { data: 'released', title: 'Number of Released Units' },
            ];

            // Initialize DataTable
            $('#rankingTable').DataTable({
                data: staticData,  // Populate the table with static data
                columns: columns, // Dynamically set table headers and data mapping
                responsive: true  // Make the table responsive
            });
        });


        // Render the bar chart with the fetched data
        var options = {
          series: [{
          name: 'Inflation',
          data: [10, 56, 65, 5]
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
                    colors: ["#ff0055"] // Data label color
                }
        },

        xaxis: {
          categories: ["John", "Wesley", "Marites", "Jordan"],
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
            show: true,
          },
          labels: {
            show: true,
            formatter: function (val) {
              return val;
            }
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
            title: {
                text: 'TOP PERFORMING MP/AGENTS BY UNITS RELEASED',
                floating: true,
                offsetY: 330,
                align: 'center',
                style: {
                    color: '#ff0055'
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#rankingBarChart"), options);
        chart.render();
</script>
@endsection
