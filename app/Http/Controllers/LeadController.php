<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use App\Models\Province;
use App\Models\Team;
use App\Models\Transactions;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class LeadController extends Controller
{
    public function index()
    {
        if(Auth::check()){
            return view('leads.leads');
        }else{
            return view('index');
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'age' => 'required|integer',
                'mobile_number' => 'required|string',
                'car_unit' => 'required|string',
                'car_variant' => 'required|string',
                'car_color' => 'required|string',
                'transaction' => 'required|string',
                'source' => 'required|string',
                'additional_info' => 'nullable|string',
                'gender' => 'required|string',
                'province' => 'required',
            ]);

            $inquiry = new Inquiry();
            $inquiry->users_id = Auth::id();
            $inquiry->customer_first_name = $validated['first_name'];
            $inquiry->customer_last_name = $validated['last_name'];
            $inquiry->contact_number = $validated['mobile_number'];
            $inquiry->gender = $validated['gender'];
            $inquiry->province_id = $validated['province'];
            $inquiry->unit = $validated['car_unit'];
            $inquiry->variant = $validated['car_variant'];
            $inquiry->color = $validated['car_color'];
            $inquiry->transaction = $validated['transaction'];
            $inquiry->age = $validated['age'];
            $inquiry->source = $validated['source'];
            $inquiry->remarks = $validated['additional_info'];
            $inquiry->date = now()->format('F d'); // Month name day
            $inquiry->updated_by = Auth::id();
            $inquiry->transactional_status = in_array($validated['transaction'], ['cash', 'po']) ? 'approved' : 'pending';
            $inquiry->save();

            // Add the inquiry_id to the transactions table
            $transaction = new Transactions(); 
            $transaction->inquiry_id = $inquiry->id; // Set the inquiry_id
            $transaction->save(); // Save the transaction

            return response()->json([
                'success' => true,
                'message' => 'Inquiry created successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating inquiry: ' . $e->getMessage()
            ], 500);
        }
    }

    public function list(Request $request){
        $query = Inquiry::with(['province', 'user'])
                        ->whereNull('deleted_at')
                        ->where('transactional_status', 'pending')
                        ->get();

        return DataTables::of($query)
        ->addColumn('id', function($data) {
            return $data->id;
        })

        ->addColumn('team', function($data) {
            $team = Team::where('id',  $data->user->team_id)->first();
            return $team->name;
        })

        ->addColumn('agent', function($data) {
            return $data->user->first_name . ' ' . $data->user->last_name;
        })

        ->addColumn('customer_name', function($data) {
            return $data->customer_first_name . ' ' . $data->customer_last_name;
        })
        ->addColumn('province', function($data) {
            return $data->province->province;
        })

        ->editColumn('created_at', function($data) {
            return $data->created_at->format('m/d/Y');
        })
      
        ->make(true);
    }

    public function processing(Request $request){
        try {
            $inquiry = Inquiry::findOrFail($request->id);
            $inquiry->transactional_status = 'approve';
            $inquiry->updated_by = Auth::user()->id;
            $inquiry->save();

            return response()->json([
                'success' => true,
                'message' => 'Lead status updated to processing'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false, 
                'message' => 'Error updating lead status: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy(){
        try {
            $inquiry = Inquiry::findOrFail(request()->id);
            $inquiry->updated_by = Auth::user()->id;
            $inquiry->save();
            $inquiry->delete();

            return response()->json([
                'success' => true,
                'message' => 'Lead successfully deleted'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting lead: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getProvince(){
        $data = Province::all();
        
        return response()->json($data);
    }

    public function getUnit(){
        $data = Vehicle::select('unit')
        ->whereNull('deleted_at')
        ->groupBy('unit')
        ->get();
    
        
        return response()->json($data);
    }

    public function getVariantsAndColors(Request $request)
    {
        $unit = $request->input('unit');
        $vehicles = Vehicle::where('unit', $unit)
        ->get();

        $variants = $vehicles->pluck('variant')->unique()->values()->toArray();
        $colors = $vehicles->pluck('color')->unique();
    
        return response()->json([
            'variants' => $variants,
            'colors' => $colors,
        ]);
    }
}
