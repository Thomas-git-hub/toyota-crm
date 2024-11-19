@extends('components.app')

@section('content')

{{-- Title Header --}}
<div class="card bg-dark shadow-none mb-4">
    <div class="card-body">
        <div class="d-flex align-items-center">
            <i class='bx bxs-car text-white' style="font-size: 24px;">&nbsp;</i>
            <h4 class="text-white mb-0">Vehicle Reservation</h4>
        </div>
    </div>
</div>


{{-- Datatables --}}
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
                <div class="table-responsive">
                    <table id="availableUnitsTable" class="table table-striped table-hover" style="width:100%">
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

@endsection
