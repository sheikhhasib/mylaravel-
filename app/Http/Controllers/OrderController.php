<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Order;
use App\Item;
use App\User;
use App\Unit;
use DB;
use Auth;

use function PHPSTORM_META\type;

class OrderController extends Controller
{
    public function  index(Request $request){
       try {
        $users = User::all();
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $coustomer_id = $request->coustomer_id;
        $orders=Order::when($coustomer_id, function ($q,$coustomer_id){
                return $q->where('user_id',$coustomer_id);
                })->when($start_date,function ($q,$start_date) {
                    return $q->whereDate('order_date','>=',$start_date);
                })->when($end_date,function ($q,$end_date) {
                    return $q->whereDate('order_date','<=',$end_date);
                })->get();
        return view('order.list',compact('orders','users'));
       } catch (\Exception $e) {
           return view('order.list');
       }
    }
    public function orderdelete($order_id){
        Order::find($order_id)->delete();
        return back()->with('dstatus','Deleted Successfully');
    }
    public function create(Request $request){

        if ($request->isMethod('post')) {
            try {

                $user_id = $request->user_id;

                //New user Insert
                if (!is_numeric($user_id)) {
                    $user = new User();
                    $user->name = $user_id;
                    $user->save();
                    $user_id = $user->id;
                }

                $addmore = $request->addmore;
//                dd($addmore);
                $order_id = Order::max('order_id')+1;

                if (!empty($addmore)) {
                    foreach ($addmore['item_id'] as $index => $ing) {

                        $item_id = $ing;
                        if (!is_numeric($item_id)) {
                            $item = new Item();
                            $item->name = $item_id;
                            $item->status = 'Active';
                            $item->created_by = Auth::id();
                            $item->save();
                            $item_id = $item->id;
                        }
                        $qty = $addmore['qty'][$index];
                        $price = $addmore['price'][$index];
                        $meal_time = $addmore['meal'][$index];
                        $order = new Order();
                        $order->user_id = $user_id;
                        $order->item_id = $item_id;
                        $order->price = $price;
                        $order->meal_time = $meal_time;
                        $order->guest = $request->guest;
                        $order->qty = $qty;
                        $order->order_id = $order_id;

                        if($request->order_date){
                            $date = date_create($request->order_date);
                            $date = date_format($date,"Y-m-d");
                            $order->order_date = $date;
                        }
                        $order->save();
                    }
                }


                return redirect('order')->with('success', 'Successfully added');
            }catch (\Exception $e){
                DB::rollback();
                 return redirect()->back()->with('error', $e->getMessage());
                // return redirect()->back()->with('error', 'Failed!');
            }
		}
		else{
			$items = Item::where('status','active')->get();
	        $users = User::all();
	        return view('order.createOrder',compact('items', 'users'));
        }
    }

}
