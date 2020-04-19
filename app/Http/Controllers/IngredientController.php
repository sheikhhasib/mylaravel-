<?php

namespace App\Http\Controllers;

use App\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;
use Olifolkerd\Convertor\Convertor;

class IngredientController extends Controller
{

    public  function  __construct()
    {
        $this->path = 'ingredient.';
    }

//    public function assign($from,$val)
    public function assign($change_unit,$current_unit, $current_price)
    {
        echo $current_unit;
//        $change_unit,$current_unit, $current_price
        switch ($change_unit) {
            case "kg":
                if($current_unit=='mg')
                    return $current_price*1000000;
                    break;
                break;
            case "g":
                if($current_unit=='mg')
                    return $current_price*1000;
                break;
                break;
            case "mg":
                if($current_unit=='mg')
                    return $current_price*1;
                    break;
                if($current_unit=='kg')
                    return $current_price*0.000001;
                break;
                $mg = 1;
                $g = 0.001;
                $kg = 0.000001;
                $to = 0.000000001;
                $gr = 0.015432358;
                $ou = 0.000035273966;
                $po = 0.000002204623;
                $st = 0.000000157473;
                break;
            case 2:
                $fromu = "g";
                $mg = 1000;
                $g = 1;
                $kg = 0.001;
                $to = 0.000001;
                $gr = 15.432358;
                $ou = 0.035273966;
                $po = 0.002204623;
                $st = 0.000157473;
                break;
            case 3:
                $fromu = "kg";
                $mg = 1000000;
                $g = 1000;
                $kg = 1;
                $to = 0.001;
                $gr = 15432.358;
                $ou = 35.273966;
                $po = 2.204623;
                $st = 0.157473;
                break;
            case 4:
                $fromu = "Tonne";
                $mg = 1000000000;
                $g = 1000000;
                $kg = 1000;
                $to = 1;
                $gr = 15.432358;
                $ou = 0.035273966;
                $po = 0.002204623;
                $st = 0.000157473;
                break;
            case 5:
                $fromu = "Grains";
                $mg = 64.891;
                $g = 0.064891;
                $kg = 0.000064891;
                $to = 0.000000064891;
                $gr = 1;
                $ou = 0.002285714;
                $po = 0.000142857;
                $st = 0.0000102041;
                break;
            case 6:
                $fromu = "Ounces";
                $mg = 28349.52;
                $g = 28.34952;
                $kg = 0.02834952;
                $to = 0.00002834952;
                $gr = 437.5;
                $ou = 1;
                $po = 0.0625;
                $st = 0.004464286;
                break;
            case 7:
                $fromu = "Pounds";
                $mg = 453592.37;
                $g = 453.59237;
                $kg = 0.45359237;
                $to = 0.00045359237;
                $gr = 7000;
                $ou = 16;
                $po = 1;
                $st = 0.071428571;
                break;
            case 8:
                $fromu = "Stones";
                $mg = 6350293.18;
                $g = 6350.29318;
                $kg = 6.35029318;
                $to = 0.00635029318;
                $gr = 98000;
                $ou = 224;
                $po = 14;
                $st = 1;
                break;
        }
    }
    public function removeScientificNotation($scientific_notation){
        $float = sprintf('%f', $scientific_notation);
        $integer = sprintf('%d', $scientific_notation);
        if ($float == $integer)
        {
            // this is a whole number, so remove all decimals
            $unit = $integer;
        }
        else
        {
            // remove trailing zeroes from the decimal portion
            $unit = rtrim($float,'0');
            $unit = rtrim($unit,'.');
        }
        return $unit;
    }

    public function getPriceByUnit(Request $request)
    {
         $res = Ingredient::where('id', $request->id)->first();
         if($res){
             if($request->change_unit){
                 $change_unit = $request->change_unit;
                 $current_unit = $res->unit;
                 $current_price = $res->price;
                 $simpleConvertor = new Convertor(1, $change_unit);
                 $unit = $simpleConvertor->to($current_unit);
                 $price = $this->removeScientificNotation($unit*$current_price);
                 return json_encode(array('status' => 200, 'result' => $price));
             }else{
                 return json_encode(array('status' => 0));
             }

         }else{
             return json_encode(array('status' => 0));
         }

    }

    public function getPrice(Request $request)
    {
        $res = Ingredient::where('id', $request->id)->first();
        if ($res) {
            return json_encode(array('status' => 200, 'result' => $res));
        } else {
            return json_encode(array('status' => 0));
        }
    }

    public  function  index(){
        $ingredients = Ingredient::all();
        return view($this->path.'index',compact('ingredients'));
    }

    public  function  create(Request $request){
        if ($request->isMethod('post')){
                    DB::beginTransaction();
                    try{

                        $this->validate($request,[
                            'name' => 'required',
                            'unit' => 'required',
                            'qty' => 'required',
                            'price' => 'required',

                        ]);

                        if($request->id){
                            $ingredient = Ingredient::find($request->id);
                        }else{
                            $ingredient = new Ingredient();
                        }
                        $ingredient->name = $request->name;
                        $ingredient->unit = $request->unit;
                        $ingredient->qty = $request->qty;
                        $ingredient->price = $request->price;
                        $ingredient->status = 'Active';
                        $ingredient->created_by = Auth::id();
                        $ingredient->save();
                        DB::commit();
                        if($request->id){
                            return redirect('ingredient')->with('success', 'Ingredient Update Successful');
                        }else{
                            return redirect('ingredient')->with('success', 'Ingredient Add Successful');
                        }

                    }catch (Exception $e){
                        DB::rollBack();
                    }

        }
        return view($this->path.'create');
    }

    public  function  edit($id){
        $ingredient = Ingredient::find($id);
        return view($this->path.'create',compact('ingredient'));
    }

    public  function  delete($id){
        try {
            $ingredient = Ingredient::find($id);
            $ingredient->delete();
            return redirect()->back()->with('success', 'Ingredient Delete Successful');
        }catch (\Exception $e){
        	return back()->with('error', 'Failed!');
        }
    }
}
