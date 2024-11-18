<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Status;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    public function index()
    {
        if(Auth::check()){
            return view('application.application');
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

            // $inquiry = new Inquiry();
            // $inquiry->users_id = Auth::id();
            // $inquiry->customer_first_name = $validated['first_name'];
            // $inquiry->customer_last_name = $validated['last_name'];
            // $inquiry->contact_number = $validated['mobile_number'];
            // $inquiry->gender = $validated['gender'];
            // $inquiry->province_id = $validated['province'];
            // $inquiry->unit = $validated['car_unit'];
            // $inquiry->variant = $validated['car_variant'];
            // $inquiry->color = $validated['car_color'];
            // $inquiry->transaction = $validated['transaction'];
            // $inquiry->age = $validated['age'];
            // $inquiry->source = $validated['source'];
            // $inquiry->remarks = $validated['additional_info'];
            // $inquiry->date = now()->format('F d'); // Month name day
            // $inquiry->created_by = Auth::id();
            // $inquiry->updated_by = Auth::id();
            // $inquiry->transactional_status = in_array($validated['transaction'], ['cash', 'po']) ? 'approved' : 'pending';
            // $inquiry->save();

            // Add the inquiry_id to the transactions table
            $transaction = new Transactions();
            $transaction->status = Status::where('status', 'like', 'pending')->first()->id;
            $transaction->save(); // Save the transaction



            if (in_array($transaction->transaction, ['cash', 'po'])) {
                $pending_status = Status::where('status', 'like', 'approve')->first();
                $application = new Application();
                $application->transaction_id = $transaction->id;
                $application->status_id = $pending_status->id;
                $application->created_by = Auth::id();
                $application->updated_by = Auth::id();
                $application->save();

                // Update the transaction table's application_id with the latest inserted application's id
                $transaction->application_id = $application->id;
                $transaction->status = Status::where('status', 'like', 'approve')->first()->id;
                $transaction->save();
            }

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

    // public function list_pending(Request $request){

    //     // dd($request->start_date);
    //     $query = Application::with(['province', 'user'])
    //                     ->whereNull('deleted_at');

    //     if ($request->has('date_range') && !empty($request->date_range)) {
    //         [$startDate, $endDate] = explode(' to ', $request->date_range);
    //         $startDate = Carbon::createFromFormat('m/d/Y', $startDate)->startOfDay();
    //         $endDate = Carbon::createFromFormat('m/d/Y', $endDate)->endOfDay();

    //         $query->whereBetween('created_at', [$startDate, $endDate]);
    //     }

    //     $list = $query->get();

    //     return DataTables::of($list)
    //     ->addColumn('id', function($data) {
    //         return encrypt($data->id);
    //     })

    //     ->addColumn('team', function($data) {
    //         $team = Team::where('id',  $data->user->team_id)->first();
    //         return $team->name;
    //     })

    //     ->addColumn('agent', function($data) {
    //         return $data->user->first_name . ' ' . $data->user->last_name;
    //     })

    //     ->addColumn('customer_name', function($data) {
    //         return $data->customer_first_name . ' ' . $data->customer_last_name;
    //     })
    //     ->addColumn('province', function($data) {
    //         return $data->province->province;
    //     })

    //     ->editColumn('created_at', function($data) {
    //         return $data->created_at->format('m/d/Y');
    //     })

    //     ->make(true);
    // }


}
