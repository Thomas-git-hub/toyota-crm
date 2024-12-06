<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Models\Transactions;
use App\Models\Team;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use App\Models\Vehicle;
use App\Models\Inventory;
use App\Models\Application;
use App\Models\Inquiry;
use Illuminate\Support\Facades\Auth;

class VehicleReleasesController extends Controller
{
    public function index() {
        if(Auth::check()){

            return view('vehicle_releases.vehicle_releases');
        }else{
            return view('index');
        }

    }

    public function releasedUnitsList(){
        DB::statement("SET SQL_MODE=''");

        $query = Vehicle::with('inventory')
                        ->whereNull('deleted_at')
                        ->groupBy('unit');

        $list = $query->get();

        return DataTables::of($list)
        ->addColumn('id', function($data) {
            return encrypt($data->id);
        })
        ->addColumn('unit', function($data) {
            return $data->unit;
        })
        ->addColumn('quantity', function($data) {

            $count = Inventory::with('vehicle')
            ->whereHas('vehicle', function($subQuery) use($data) {
                $subQuery->where('unit', $data->unit);
            })
            ->where('status', 'released')
            ->where('CS_number_status', 'released')
            ->count();

            return $count;
        })
        ->make(true);
    }

    public function releasedPerTeam(){
        DB::statement("SET SQL_MODE=''");

        $query = Team::whereNull('deleted_at');

        $list = $query->get();

        return DataTables::of($list)
        ->addColumn('id', function($data) {
            return encrypt($data->id);
        })
        ->addColumn('team', function($data) {
            return $data->name;
        })

        ->addColumn('quantity', function($data) {
            $released_status = Status::where('status', 'like', 'Released')->first();
            $count = Transactions::with(['inquiry', 'inventory', 'application'])
            ->whereNull('deleted_at')
            ->where('team_id', $data->id)
            ->whereNotNull('reservation_id')
            ->where('reservation_transaction_status', $released_status->id)
            ->count();

            return $count;
        })

        ->addColumn('total_profit', function($data) {
            $released_status = Status::where('status', 'like', 'Released')->first();
           $profit = Transactions::with(['inquiry', 'inventory', 'application'])
           ->whereNull('deleted_at')
           ->where('team_id', $data->id)
           ->whereNotNull('reservation_id')
           ->where('reservation_transaction_status', $released_status->id)
           ->sum('profit');
           return number_format($profit, 2);
        })

        ->make(true);
    }


    public function getReleasedCount(){
        $released_status = Status::where('status', 'like', 'Released')->first();
        $pending_for_release_status = Status::where('status', 'like', 'Pending For Release')->first();
        $query = Transactions::with(['inquiry', 'inventory', 'application'])
            ->whereNull('deleted_at')
            ->whereNotNull('reservation_id')
            ->where('reservation_transaction_status', $released_status->id);
        $releasedCount = $query->count();

        $pendingForReleaseQuery = Transactions::with(['inquiry', 'inventory', 'application'])
            ->whereNull('deleted_at')
            ->whereNotNull('reservation_id')
            ->where('reservation_transaction_status', $pending_for_release_status->id);
        $pendingForReleaseCount = $pendingForReleaseQuery->count();

        return response()->json(['releasedCount' => $releasedCount, 'pendingForReleaseCount' => $pendingForReleaseCount]);
    }


    public function list_pending_for_release(Request $request){

        // dd($request->start_date);
        $pending_for_release_status = Status::where('status', 'like', 'Pending For Release')->first();
        $query = Transactions::with(['inquiry', 'inventory', 'application'])
                        ->whereNull('deleted_at')
                        ->where('reservation_transaction_status', $pending_for_release_status->id)
                        ->whereNotNull('reservation_id')
                       ;

        if ($request->has('date_range') && !empty($request->date_range)) {
            [$startDate, $endDate] = explode(' to ', $request->date_range);
            $startDate = Carbon::createFromFormat('m/d/Y', $startDate)->startOfDay();
            $endDate = Carbon::createFromFormat('m/d/Y', $endDate)->endOfDay();

            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        $list = $query->get();

        // dd($list->toArray());

        return DataTables::of($list)
        ->editColumn('id', function($data) {
            return encrypt($data->id);
        })

        ->editColumn('unit', function($data) {
            return $data->application->vehicle->unit;
        })

        ->addColumn('customer_name', function($data) {
            if($data->inquiry->inquiryType->inquiry_type === 'Individual'){
                return $data->inquiry->customer->customer_first_name . ' ' . $data->inquiry->customer->customer_last_name;
            }else if($data->inquiry->inquiryType->inquiry_type === 'Fleet'){
                return $data->inquiry->customer->company_name;
            }else if($data->inquiry->inquiryType->inquiry_type === 'Company'){
                return $data->inquiry->customer->company_name;
            }else if($data->inquiry->inquiryType->inquiry_type === 'Government'){
                return $data->inquiry->customer->department_name;
            }
        })

        ->editColumn('year_model', function($data) {
            return $data->inventory->year_model ?? '';
        })

        ->addColumn('variant', function($data) {
            return $data->application->vehicle->variant;
        })

        ->addColumn('color', function($data) {
            return $data->application->vehicle->color;
        })

        ->addColumn('cs_number', function($data) {
            return $data->inventory->CS_number ?? '';
        })

        ->addColumn('trans_type', function($data) {
            return $data->inquiry->inquiryType->inquiry_type;
        })
        ->addColumn('trans_bank', function($data) {
            return $data->application->bank->bank_name ?? '';
        })

        ->addColumn('team', function($data) {
            $team = Team::where('id',  $data->application->updatedBy->team_id)->first();
            return $team->name;
        })

        ->addColumn('agent', function($data) {
            return $data->application->updatedBy->first_name . ' ' . $data->application->updatedBy->last_name;
        })

        ->addColumn('date_assigned', function($data) {
            return $data->reservation_date;
        })

        ->addColumn('status', function($data) {
            $status = Status::where('id', $data->status)->first()->status;
            return $status;
        })

        ->addColumn('profit', function($data) {
            return number_format($data->profit ?? 0, 2);
        })

        ->make(true);
    }

    public function list_release(Request $request){

        $release_status = Status::where('status', 'like', 'Released')->first();
        $posted_status = Status::where('status', 'like', 'Posted')->first();
        $query = Transactions::with(['inquiry', 'inventory', 'application'])
                        ->whereNull('deleted_at')
                        ->whereIn('reservation_transaction_status', [$release_status->id, $posted_status->id])
                        ->whereNotNull('reservation_id')
                       ;

        if ($request->has('date_range') && !empty($request->date_range)) {
            [$startDate, $endDate] = explode(' to ', $request->date_range);
            $startDate = Carbon::createFromFormat('m/d/Y', $startDate)->startOfDay();
            $endDate = Carbon::createFromFormat('m/d/Y', $endDate)->endOfDay();

            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        $list = $query->get();

        // dd($list->toArray());

        return DataTables::of($list)
        ->editColumn('id', function($data) {
            return encrypt($data->id);
        })

        ->editColumn('unit', function($data) {
            return $data->application->vehicle->unit;
        })

        ->addColumn('customer_name', function($data) {
            if($data->inquiry->inquiryType->inquiry_type === 'Individual'){
                return $data->inquiry->customer->customer_first_name . ' ' . $data->inquiry->customer->customer_last_name;
            }else if($data->inquiry->inquiryType->inquiry_type === 'Fleet'){
                return $data->inquiry->customer->company_name;
            }else if($data->inquiry->inquiryType->inquiry_type === 'Company'){
                return $data->inquiry->customer->company_name;
            }else if($data->inquiry->inquiryType->inquiry_type === 'Government'){
                return $data->inquiry->customer->department_name;
            }
        })

        ->editColumn('year_model', function($data) {
            return $data->inventory->year_model ?? '';
        })

        ->addColumn('variant', function($data) {
            return $data->application->vehicle->variant;
        })

        ->addColumn('color', function($data) {
            return $data->application->vehicle->color;
        })

        ->addColumn('cs_number', function($data) {
            return $data->inventory->CS_number ?? '';
        })

        ->addColumn('trans_type', function($data) {
            return $data->inquiry->inquiryType->inquiry_type;
        })
        ->addColumn('trans_bank', function($data) {
            return $data->application->bank->bank_name ?? '';
        })

        ->addColumn('team', function($data) {
            $team = Team::where('id',  $data->application->updatedBy->team_id)->first();
            return $team->name;
        })

        ->addColumn('agent', function($data) {
            return $data->application->updatedBy->first_name . ' ' . $data->application->updatedBy->last_name;
        })

        ->addColumn('date_assigned', function($data) {
            return $data->reservation_date;
        })

        ->addColumn('status', function($data) {
            $status = Status::where('id', $data->status)->first()->status;
            return $status;
        })
        ->addColumn('profit', function($data) {
            return number_format($data->profit ?? 0, 2);
        })

       

        ->make(true);
    }

    public function processing(Request $request){
        try {

            $posted_status = Status::where('status', 'like', 'Posted')->first()->id;
            $pending_for_release_status = Status::where('status', 'like', 'Pending For Release')->first()->id;

            $transaction = Transactions::findOrFail(decrypt($request->id));

            if($transaction->reservation_transaction_status == $pending_for_release_status){

                $inventory = Inventory::findOrFail($transaction->inventory_id);
                $inventory->CS_number_status = 'released';
                $inventory->status = 'released';
                $inventory->save();

                $transaction->status = $posted_status;
                $transaction->reservation_transaction_status = $posted_status;
                $transaction->released_date = now();
                $transaction->updated_at = now();
                $transaction->save();

            }
            return response()->json([
                'success' => true,
                'message' => 'Vehicle release request successfully processed'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating reservation process: ' . $e->getMessage()
            ], 500);
        }
    }

    public function cancel_release(Request $request){
        try {

            $pending_for_release_status = Status::where('status', 'like', 'Pending For Release')->first()->id;
            $reserved_status = Status::where('status', 'like', 'Reserved')->first()->id;

            $transaction = Transactions::findOrFail(decrypt($request->id));

            if($transaction->reservation_transaction_status == $pending_for_release_status){
               
                $transaction->status = $reserved_status;
                $transaction->reservation_transaction_status = $reserved_status;
                $transaction->released_date = null;
                $transaction->updated_at = now();
                $transaction->save();

            }
            return response()->json([
                'success' => true,
                'message' => 'Vehicle release request successfully processed'
            ]);


        } catch (\Exception $e) {

        }

    }

    public function updateProfit(Request $request){
       try {    
            $request->validate([
                'profit' => 'required|numeric|min:0'
            ]);

            $transaction = Transactions::findOrFail(decrypt($request->id));
            $transaction->profit = $request->profit;
            $transaction->save();

            return response()->json([
                'success' => true,
                'message' => 'Profit updated successfully'
            ]);

       } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating profit: ' . $e->getMessage()
            ], 500);
       }
    }
}
