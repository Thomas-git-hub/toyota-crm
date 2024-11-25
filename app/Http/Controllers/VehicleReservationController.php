<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class VehicleReservationController extends Controller
{
    public function index() {
        return view('vehicle_reservation.vehicle_reservation');
    }

    public function availableUnitsList(){
        DB::statement("SET SQL_MODE=''");
        
        $query = Vehicle::with('inventory')
                        ->whereNull('deleted_at')
                        ->whereHas('inventory', function($subQuery) {
                            $subQuery->where('status', 'available');
                            $subQuery->where('CS_number_status', 'available');
                        })
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
            ->where('status', 'available')
            ->where('CS_number_status', 'available')
            ->count();
          
            return $count;
        })
        ->make(true);
    }

    
}
