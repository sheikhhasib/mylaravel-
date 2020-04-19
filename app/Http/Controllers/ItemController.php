<?php

namespace App\Http\Controllers;

use App\Ingredient;
use App\Item;
use App\ItemIngredient;
use App\Unit;
use Illuminate\Http\Request;
use Auth;
use Mockery\Exception;
use DB;
use Illuminate\Notifications\Action;
use Olifolkerd\Convertor\Convertor;
use Redirect;


class ItemController extends Controller
{
    //

    public function  index(){

        try {
            $items = Item::all();
            return view('item.list',compact('items'));
        }catch (\Exception $e){
        	return back()->with('error', 'Page not found!');
        }
    }

    public function getPrice(Request $request)
    {
        $res = Item::where('id', $request->id)->first();
        if ($res) {
            return json_encode(array('status' => 200, 'result' => $res));
        } else {
            return json_encode(array('status' => 0));
        }
    }

    public  function  create(){
//        $simpleConvertor = new Convertor(1, "kg");
//        dd($simpleConvertor->to("mg"));

        try {
            $items = Item::where('status','active')->get();
            $ingredients = Ingredient::where('status','active')->get();
            $units = unit::all();
            return view('item.createItem',compact('items','ingredients','units'));
        }catch (\Exception $e){
        	return view('item.createItem');
        }
    }
    public  function  store(Request $request){
        DB::beginTransaction();
        try {
            $item_id = $request->item_id;
            if (!is_numeric($item_id)) {
                $item = new Item();
                $item->name = $item_id;
                $item->status = 'Active';
                $item->created_by = Auth::id();
                $item->save();
                $item_id = $item->id;
            }
            $ingredient = $request->addmore;
            $totalPrice = 0;
            if (!empty($ingredient)) {
                foreach ($ingredient['ingredient_id'] as $index => $ing) {

                    $ingredient_id = $ing;
                    if (!is_numeric($ingredient_id)) {
                        $ingredients = new Ingredient();
                        $ingredients->name = $ingredient_id;
                        $ingredients->status = 'Active';
                        $ingredients->created_by = Auth::id();
                        $ingredients->save();
                        $ingredient_id = $ingredients->id;
                    }
                    $unit_id = $ingredient['unit_id'][$index];
                    $qty = $ingredient['qty'][$index];
                    $price = $ingredient['price'][$index];

                    $existUnit = Unit::where('name',$unit_id)->first();
                    if (!$existUnit) {
                        $unit = new Unit();
                        $unit->name = $unit_id;
                        $unit->save();
                        $unit_id = $unit->name;
                    }
                    $itemIn = ItemIngredient::where('ingredient_id',$ingredient_id)->first();
                    if(!$itemIn){
                        $itemIn = new ItemIngredient();
                    }

                    $itemIn->item_id = $item_id;
                    $itemIn->unit_id = $unit_id;
                    $itemIn->ingredient_id = $ingredient_id;
                    $itemIn->qty = $qty;
                    $itemIn->price = $price;
                    $itemIn->status = 'Active';
                    $itemIn->created_by = Auth::id();
                    $itemIn->save();

                    $totalPrice += $price;
                }
            }

            $item = Item::find($item_id);
            $item->price = $totalPrice;
            $item->save();

            DB::commit();
            return redirect('item')->with('success', 'Successfully added');
        }catch (\Exception $e){
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
//            return redirect()->back()->with('error', 'Failed!');
        }

    }

    public function itemApi(Request $request){

        $item = Item::find($request->data);

        return response()->json([
                    'name' => $item->name
                ]);
        // return $item->name;
        // echo "string";
    }


    public  function  edit($id){


        try {
            $itemIngredient = ItemIngredient::where('item_id',$id)->get();
            $items = Item::where('status','active')->get();
            $ingredients = Ingredient::where('status','active')->get();
            $units = unit::all();
            return view('item.editItemIngredint',compact('id','itemIngredient','items','ingredients','units'));
        }catch (\Exception $e){
        	return view('item.editItemIngredint');
        }
    }
    public  function  update(Request $request){
        $itemIngredient = ItemIngredient::where('item_id',$request->item_id)->first();
    }


    public  function detail($id){
        try {
            $itemIngredient = ItemIngredient::where('item_id',$id)->get();
            return view('item.itemDetail',compact('itemIngredient','id'));
        }catch (\Exception $e){
        	return view('item.itemDetail');
        }
    }

    public function destroy($id){
        try {
            $res = Item::where('id',$id)->delete();
            return Redirect::back()->withErrors(['msg', 'Successfully Deleted']);
        }catch (\Exception $e){
            return Redirect::back()->withErrors(['msg', 'Failed!']);
        }
    }

    public function directadd(){
        $items = Item::all();
        return view('item.directadd',compact('items'));
    }
    public function directadditem(Request $request){
        try {
            $item = Item::where('name',$request->name)->first();
            if($item != true){
                $item = new Item();
                $item->name = $request->name;
                $item->unit = $request->unit;
                $item->qty = $request->qty;
                $item->price = $request->price;
                $item->direct = 1;
                $item->status = 'Active';
                $item->save();
                return back()->with('status','data inserted successfully');
            }else{
                return back()->with('status','this Item is already have!');
            }
        } catch (\Exception $e) {
            return back()->with('delete','failed');;
        }
    }
}
