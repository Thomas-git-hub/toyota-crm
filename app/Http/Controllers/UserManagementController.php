<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use App\Models\Usertype;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class UserManagementController extends Controller
{

    public function index(){
        if (Auth::check()){
            return view('user.user_management');
        }else{
            return redirect()->route('login');
        }
    }

    public function list(){

       $query = User::with(['usertype', 'team'])->get();

       return DataTables::of($query)
            ->editColumn('id', function($user){
                return encrypt($user->id);
            })
            ->addColumn('usertype', function($user){
                return $user->usertype->name;
            })
            ->addColumn('team', function($user){
                return $user->team->name;
            })
            ->make(true);

    }

    public function store(Request $request){

        try{
            $user = new User();
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->usertype_id = $request->usertype_id;
            $user->team_id = $request->team_id;
            $user->status = $request->status;
            $user->created_by = Auth::user()->id;
            $user->created_at = now();
            $user->updated_by = Auth::user()->id;
            $user->updated_at = now();
            $user->save();

        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }

    public function update($id, Request $request){
        try{

            $user = User::findOrFail($id);
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->usertype_id = $request->usertype_id;
            $user->team_id = $request->team_id;
            $user->status = $request->status;
            $user->updated_by = Auth::user()->id;
            $user->updated_at = now();
            $user->save();

            return response()->json(['success' => 'User updated successfully'], 200);

        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);

        }
    }

    public function destroy(){

    }

    public function edit($id){
        try{
            $id = decrypt($id);
            $user = User::with(['usertype', 'team'])->findOrFail($id);

            $user->id = encrypt($user->id);
            return response()->json($user);
        }catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }

    public function getUserTypes(){

        $userTypes = Usertype::all();
        return response()->json($userTypes);

    }

    public function getTeams(){

        $teams = Team::all();
        return response()->json($teams);

    }

}
