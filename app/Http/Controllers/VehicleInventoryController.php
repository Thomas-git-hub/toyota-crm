<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Inventory;
use App\Models\Transactions;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use App\Models\Vehicle;


class VehicleInventoryController extends Controller
{
    public function index() {

        if(Auth::check()){
            return view('vehicle_inventory.vehicle_inventory');
        }else{
            return view('index');
        }
    }

    public function inventoryList(Request $request){

         // dd($request->start_date);
         $query = Inventory::with(['vehicle', 'transaction'])
                        //  ->whereNull('deleted_at')
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
             return $data->vehicle->unit;
         })

         ->editColumn('color', function($data) {
             return $data->vehicle->color;
         })

         ->editColumn('cs_number', function($data) {
             return $data->CS_number;
         })

         ->editColumn('model', function($data) {
             return $data->vehicle->variant;
         })

         ->addColumn('tags', function($data) {

            $transaction = Transactions::with(['application'])->where('inventory_id', $data->id)->first();
            if($transaction){
                return $transaction->application->updatedBy->first_name . ' ' . $transaction->application->updatedBy->last_name;
            }
            return '';
        })

         ->addColumn('invoice_number', function($data) {
            return $data->invoice_number;
        })



         ->make(true);

    }

    public function getTotalInventory(){

        $query = Inventory::with(['vehicle']);
        $totalInventory = $query->count();

        return response()->json(['totalInventory' => $totalInventory]);
    }

    public function store(Request $request)
    {
        // Validate input data
        $request->validate([
            'unit' => 'required|string|max:255',
            'variant' => 'required|string|max:255',
            'color' => 'required|string|max:255',
        ]);

        // Check for duplicate entry
        $exists = Vehicle::where('unit', $request->unit)
            ->where('variant', $request->variant)
            ->where('color', $request->color)
            ->exists();

        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => 'This vehicle already exists, You may proceed to the Inventory form.'
            ], 422);
        }

        // Insert new vehicle data
        Vehicle::create([
            'unit' => $request->unit,
            'variant' => $request->variant,
            'color' => $request->color,
            'created_by' => Auth::id(),
            'created_at' => now(),
            'updated_by' => Auth::id(),
            'updated_at' => now(), // Initially null
        ]);

        // Redirect with success message
        return response()->json([
            'success' => true,
            'message' => 'Vehicle added successfully!'
        ]);
    }

}
