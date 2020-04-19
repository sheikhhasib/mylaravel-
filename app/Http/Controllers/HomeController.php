<?php

namespace App\Http\Controllers;

use App\Item;
use App\Ingredient;
use App\Order;
use App\User;
use App\Messbill;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        try {
            $order = Order::whereDate('order_date', Carbon::today())->count();
            $item = Item::count();
            $ingredient = Ingredient::count();
            $user = User::count();
            return view('dashboard.dashboard',compact('order','item','ingredient','user'));
        }catch (\Exception $e){
        	return view('dashboard.dashboard');
        }
    }

    public function bazaarList(){
        try {
            $date = Date('Y-m-d');
            $lists = Order::join('items', 'orders.item_id', '=', 'items.id')
            ->join('item_ingredients as in', 'items.id', '=', 'in.item_id')
            ->selectRaw('ingredient_id, SUM(in.qty) as qty, SUM(in.price) as price')->groupBy('ingredient_id')
            ->get();
            return view('bazaar.index',compact('lists'));
        }catch (\Exception $e){
        	return view('bazaar.index');
        }
    }
    public function listitem(Request $request){
        try {
            if($request->date){
                $date = $request->date;
            }else{
                $date = date('Y-m-d');
            }
            $orderlist   =  Order::where('order_date',$date)->get();
            $total_guest =  $orderlist->sum('guest');
            $total_user =  $orderlist->count('user_id');
            $total_p = $total_guest + $total_user;

             $lists = Order::where('order_date',$date)->join('items', 'orders.item_id', '=', 'items.id')
                 ->join('item_ingredients as in', 'items.id', '=', 'in.item_id')
                 ->selectRaw('ingredient_id, SUM(in.qty) as qty, SUM(in.price) as price')->groupBy('ingredient_id')
                 ->get();
             return view('bazaar.listitem',compact('lists','total_p','date'));
        }catch (\Exception $e){
        	return view('bazaar.listitem');
        }
    }
    public function generateBill(Request $request){

        try {
            $users = User::all();
            $messbills = Messbill::where('months', intval($request->months))
            ->where('years', $request->years)->where('user_id', $request->user_id)->first();
            $month = $request->months;
            $year = $request->years;
            $person = User::where('id',$request->user_id)->first();
            return view('bill.mess_bill',compact('users','messbills','month','year','person'));
        }catch (\Exception $e){
        	return view('bill.mess_bill');
        }
    }
    public function miltimegenarate(Request $request){




        try {
            $users = User::all();
            $orders = Order::whereMonth('order_date', $request->months)
            ->whereYear('order_date', $request->years)->where('user_id', $request->user_id)->get();
            $month = $request->months;
            $year = $request->years;
            $user_id = $request->user_id;
            $name = User::where('id',$request->user_id)->first();
            return view('bazaar.mealtime',compact('users','orders','month','year','name','user_id'));
        }catch (\Exception $e){
        	return view('bazaar.mealtime');
        }
    }
    public function messBill(Request $request){
        if($request->isMethod('post')){
            $request->validate([
                'user_id'=> 'required',
                'months' => 'required',
                'years' => 'required',
               ]);


               DB::beginTransaction();
               try {
                $messbill = Messbill::where('user_id',$request->user_id)->where('months',$request->months)->where('years',$request->years)->first();
                if($messbill!=true){
                    $messbill = new Messbill();
                    $messbill->user_id =  $request->user_id;
                    $messbill->months =  $request->months;
                    $messbill->years =  $request->years;
                    $messbill->daily_messing =  $request->daily_messing;
                    $messbill->tea_break =  $request->tea_break;
                    $messbill->chit_bill =  $request->chit_bill;
                    $messbill->party_bill =  $request->party_bill;
                    $messbill->sports_subscription =  $request->sports_subscription;
                    $messbill->mess_maint =  $request->mess_maint;
                    $messbill->gass_bill =  $request->gass_bill;
                    $messbill->indi_saving =  $request->indi_saving;
                    $messbill->guest_room =  $request->guest_room;
                    $messbill->arrears =  $request->arrears;
                    $messbill->on_payment =  $request->on_payment;
                    $messbill->others =  $request->others;
                    $messbill->save();
                    $messbill->id;
                   return back()->with('status','Successfully Added');
                   DB::commit();
               }else{
                   return back()->with('status','user name, month and year is already have!');
               }
               } catch (\Exception $e) {
                   DB::rollback();
                   return back()->with('status','Failed!');
               }



        }else{
            $users = User::all();
            return view('bazaar.add',compact('users'));
        }
    }
    public function messBillList(){

        try {
            $messbills = Messbill::all();
            return view('bazaar.mess_bill_list',compact('messbills'));
        }catch (\Exception $e){
        	return view('bazaar.mess_bill_list');
        }
    }
    public function delete($id){
        try {
            $row = Messbill::where('id',$id)->delete();
            return back()->with('status','deleted successfully');
        }catch (\Exception $e){
        	return back()->with('error', 'Failed!');
        }
    }
    public function edit($user_id){
        try {
            $single_value = Messbill::where('user_id',$user_id)->first();
            $users = User::all();
            return view('bazaar.editmessbill',compact('single_value','users'));
        }catch (\Exception $e){
        	return view('bazaar.editmessbill');
        }
    }
    public function messbillupdate(Request $request){
        DB::beginTransaction();
        try {
            $messbill = Messbill::where('user_id',$request->user_id)->update([
                'user_id' => $request->user_id,
                'months' => $request->months,
                'years' => $request->years,
                'daily_messing' => $request->daily_messing,
                'tea_break' => $request->tea_break,
                'chit_bill' => $request->chit_bill,
                'party_bill' => $request->party_bill,
                'sports_subscription' => $request->sports_subscription,
                'mess_maint' => $request->mess_maint,
                'gass_bill' => $request->gass_bill,
                'indi_saving' => $request->indi_saving,
                'guest_room' => $request->guest_room,
                'arrears' => $request->arrears,
                'on_payment' => $request->on_payment,
                'others' => $request->others,
            ]);
            DB::commit();
            return back()->with('status','file updated successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('status','Failed !');
        }
    }

}
