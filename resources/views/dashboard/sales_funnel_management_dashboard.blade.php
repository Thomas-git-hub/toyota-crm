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

{{-- Start Date - End Date Filter Group --}}
<div class="row mb-4">
    <div class="col-md d-flex justify-content-end gap-4">
        <div class="form-group text-end">
            <label for="defaultFormControlInput" class="form-label"><small>Select Start to End Date</small></label>
            <input type="text" id="date-range-picker" class="form-control form-control-sm" placeholder="Filter Date">
        </div>
        <div class="form-group text-end">
            <label for="defaultSelect" class="form-label"><small>Filter Group</small></label>
            <select id="selectGroup" class="form-control form-select-sm">
            </select>
        </div>
        {{-- <button type="button" class="btn btn-primary" id="filterButton">Filter</button> --}}
    </div>
</div>

{{-- Card Inquiries and Unit in Inquries Count --}}
<div class="row mb-4">
    <div class="col-md-4">
        <div class="row">
            <div class="col-md">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="">
                                <label class="fs-4 fw-bold" style="color: #ff0055">Total Inquiries</label><br>
                                <small>Total number of inquiries</small>
                            </div>
                            <h1 class="fw-bold" id="inquiriesCountCard" style="color: #ff0055">20</h1>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="">
                                <label class="fs-4 fw-bold" style="color: #ff0055">Total Units Inquired</label><br>
                                <small>Total number of units inquired</small>
                            </div>
                            <h1 class="fw-bold" id="unitInquiredCountCard" style="color: #ff0055">20</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Filtered Date Card --}}
    <div class="col-md">
        <div class="card h-100">
            <div class="card-body">
                <div class="mb-4">
                    <div class="fw-bold text-secondary">Date</div>
                </div>
                <ul class="p-0 m-0">
                    <li class="d-flex align-items-center border-bottom mb-5">
                        <div class="avatar flex-shrink-0 me-3">
                            <span class="avatar-initial rounded bg-dark"><i class="icon-base bx bx-calendar"></i></span>
                        </div>
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                        <div class="me-2">
                            <h6 class="mb-0">MONTH</h6>
                            <small>Selected Month</small>
                        </div>
                        <div class="user-progress">
                            <h5 class="mb-0" style="color: #ff0055;" id="monthRange">Present</h5>
                        </div>
                    </li>
                    <li class="d-flex align-items-center border-bottom mb-5">
                        <div class="avatar flex-shrink-0 me-3">
                            <span class="avatar-initial rounded bg-dark"><i class="icon-base bx bx-calendar-star"></i></span>
                        </div>
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                        <div class="me-2">
                            <h6 class="mb-0">YEAR</h6>
                            <small>Selected Year</small>
                        </div>
                        <div class="user-progress">
                            <h5 class="mb-0" style="color: #ff0055;" id="year">2025</h5>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>


<div class="row mb-4">
    {{-- Total Inquiries Bar Graph --}}
    <div class="col-md">
        <div class="card">
            <div class="card-body">
                <div id="totalInquiriesBarGraph"></div>
            </div>
        </div>
    </div>
    {{-- Total Rservation Bar Graph --}}
    <div class="col-md">
        <div class="card">
            <div class="card-body">
                <div id="totalReservationBarGraph"></div>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <div class="" id="unitInquiredLineGraph"></div>
            </div>
        </div>
    </div>
</div>

@endsection




@section('components.specific_page_scripts')

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize flatpickr for date range picker
        flatpickr("#date-range-picker", {
            mode: "range",
            dateFormat: "m/d/Y",
            onChange: function (selectedDates, dateStr, instance) {
                if (selectedDates.length === 2) {
                    const startDate = selectedDates[0];
                    const endDate = selectedDates[1];

                    showLoader();

                    if (selectedDates[1] <= selectedDates[0]) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Warning!',
                            text: 'Please select a valid date range.',
                        });
                    } else {


                        releasedCount();
                        fetchMonthlyReleasedCount();
                        fetchReleasePerTransType();
                        fetchBankData();
                        fetchSourceData();
                        fetchGenderData();
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

                    hideLoader();
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
                    releasedCount();
                    fetchMonthlyReleasedCount();
                    fetchReleasePerTransType();
                    fetchBankData();
                    fetchSourceData();
                    fetchGenderData();
                });

                // Add event listener to close the calendar
                closeButton.addEventListener("click", function () {
                    instance.close(); // Close the flatpickr calendar
                });
            }
        });

        const currentDate = new Date();
        const currentMonth = currentDate.toLocaleString('default', { month: 'short' });
        const currentYear = currentDate.getFullYear();
        document.getElementById('monthRange').textContent = currentMonth;
        document.getElementById('year').textContent = currentYear;

        // Event listener for group selection
        document.getElementById('selectGroup').addEventListener('change', function () {
            const selectedGroup = this.options[this.selectedIndex].text;
            document.getElementById('group').textContent = selectedGroup || 'All Group';
        });

        // Event listener for group selection
        $('#selectGroup').on('change', function () {
            showLoader();
            releasedCount();
            fetchMonthlyReleasedCount();
            fetchReleasePerTransType();
            fetchBankData();
            fetchSourceData();
            fetchGenderData();
            hideLoader();
        });
    });

    // Total Inquiries Bar Graph
    var options = {
          series: [{
            name: "Desktops",
            data: [10, 41, 35, 51, 49, 62, 69, 91, 148, 172, 143, 120]
        }],
          chart: {
          height: 350,
          type: 'bar',
          zoom: {
            enabled: false
          }
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
          offsetY: -20,
                style: {
                    fontSize: '12px',
                    colors: ["#ff0055"] // Data label color
                },
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
        stroke: {
          curve: 'straight'
        },
        title: {
                text: 'TOTAL INQUIRIES',
                floating: true,
                offsetY: 330,
                position: 'top',
                align: 'center',
                style: {
                    color: '#ff0055'
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
            }
    };
    var chart = new ApexCharts(document.querySelector("#totalInquiriesBarGraph"), options);
    chart.render();

    // Total Reservation Bar Graph
    var options = {
          series: [{
            name: "Desktops",
            data: [10, 41, 35, 51, 49, 62, 69, 91, 148, 172, 143, 120]
        }],
          chart: {
          height: 350,
          type: 'bar',
          zoom: {
            enabled: false
          }
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
          offsetY: -20,
                style: {
                    fontSize: '12px',
                    colors: ["#ff0055"] // Data label color
                },
        },
        colors: ['#ff0055'], // Set the base bar color
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
        stroke: {
          curve: 'straight'
        },
        title: {
                text: 'TOTAL RESERVATION',
                floating: true,
                offsetY: 330,
                position: 'top',
                align: 'center',
                style: {
                    color: '#ff0055'
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
            }
    };
    var chart = new ApexCharts(document.querySelector("#totalReservationBarGraph"), options);
    chart.render();
    
    // Total Inquiries in Inquiries Bar Graph
    var options = {
          series: [{
            name: "Desktops",
            data: [10, 41, 35, 51, 49]
        }],
          chart: {
          height: 350,
          type: 'bar',
          zoom: {
            enabled: false
          }
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
          offsetY: -20,
                style: {
                    fontSize: '12px',
                    colors: ["#ff0055"] // Data label color
                },
        },
        colors: ['#8a8c8e'], // Set the base bar color
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
        stroke: {
          curve: 'straight'
        },
        title: {
                text: 'TOTAL UNITS INQUIRED',
                floating: true,
                offsetY: 330,
                align: 'center',
                style: {
                    color: '#ff0055'
                }
            },
        xaxis: {
          categories: ['Wigo', 'Vios', 'Fortuner', 'Corolla', 'Prius'],
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
        }
    };
    var chart = new ApexCharts(document.querySelector("#unitInquiredLineGraph"), options);
    chart.render();
</script>

@endsection
