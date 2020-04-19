<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;
use DB;
use Redirect;

class CustomerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
    	$customers = User::where('status','Active')->paginate(10);

    	return view('customer.index',compact('customers'));
    }

    public function create(){
    	$user = new User();
    	return view('customer.create',compact('user'));
    }

    public function edit($id){
    	$user = User::find($id);
    	return view('customer.create',compact('user'));
    }

    public function store(Request $request){

    	DB::beginTransaction();

    	if($request->id){

    		$request->validate([
			    'name' => ['required', 'string', 'max:255'],
			]);

    		$user = User::find($request->id);

    		if($user->email != $request->email){
    			$request->validate([
		            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
				]);
    		}

    		if($request->password){
    			$request->validate([
		            'password' => ['required', 'string', 'min:8', 'confirmed'],
				]);
    		}

    	}else{
    		$request->validate([
			    'name' => ['required', 'string', 'max:255'],
	            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
	            // 'phone' => ['required', 'string', 'phone', 'max:255', 'unique:users'],
	            'password' => ['required', 'string', 'min:8', 'confirmed'],
			]);

			$user = new User();
    	}

		try {
	    	$user->name = $request->name;
	    	$user->designation = $request->designation;
	    	$user->email = $request->email;
	    	$user->phone = $request->phone;
	    	$user->role = $request->role;
	    	$user->status = $request->status;
	    	$user->password = Hash::make($request->password);
	    	$user->save();
	    	DB::commit();

	    	return redirect('customers')->with('success', 'Successfully validated and data has been saved');

    	} catch (\Exception $e) {
	   		 DB::rollback();
	   		 return back()->with('error', 'Failed!');
		}
    }

    public function destroy($id){
        try {
            $res = User::where('id',$id)->delete();
            return back()->with('success', 'Successfully Deleted');
        }catch (\Exception $e){
        	return back()->with('error', 'Failed!');
        }
    }
}
