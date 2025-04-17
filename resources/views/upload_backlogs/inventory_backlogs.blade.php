@extends('components.app')

@section('content')
{{-- Title Header --}}
<div class="card bg-dark shadow-none mb-4">
    <div class="card-body">
        <div class="d-flex align-items-center">
            <i class='bx bxs-spreadsheet text-white' style="font-size: 24px;">&nbsp;</i>
            <h4 class="text-white mb-0">Upload Inventory Backlogs</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md d-flex justify-content-end gap-2">
        <div class="mb-3">
            <input class="form-control" type="file" id="formFile">
        </div>
        <div>
            <button class="btn btn-primary">Upload .xls</button>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md">
        <div class="card">
            <div class="card-body">
                {{-- Horizontal Scroll Bar with CSS --}}
                <div class="table-responsive-wrapper">
                    <div class="fixed-header-scroll">
                      <div class="table-responsive">
                        <table id="inventoryBacklogsTable" class="table table-bordered table-hover" style="width:100%">
                          <tbody>
                          </tbody>
                        </table>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection


@section('components.specific_page_scripts')
<script>
    $(document).ready(function() {
        $('#inventoryBacklogsTable').DataTable({
            processing: false,
            serverSide: false,
            columns: [
                { data: 'id', name: 'id', title: 'id' },
                { data: 'unit', name: 'unit', title: 'unit' },
                { data: 'variant', name: 'variant', title: 'variant' },
                { data: 'category', name: 'category', title: 'category' },
                { data: 'color', name: 'color', title: 'color' },
                { data: 'year_model', name: 'year_model', title: 'Year Model' },
                { data: 'CS_number', name: 'CS_number', title: 'CS#' },
                { data: 'actual_invoice_date', name: 'actual_invoice_date', title: 'Actual Invoice Date' },
                { data: 'delivery_date', name: 'delivery_date', title: 'Delivery Date' },
                { data: 'invoice_number', name: 'invoice_number', title: 'Invoice Number' },
            ],
            order: [[0, "desc"]],
        });
    });
</script>

@endsection
