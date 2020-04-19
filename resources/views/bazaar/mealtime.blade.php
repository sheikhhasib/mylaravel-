
@extends('layouts.app')
@push('head_styles')
    <!-- DataTables -->
    <link href="{{asset('assets/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{asset('assets/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

    <style>
        table, th, td {
          border: 1px solid black;
            text-align: center;
        }
    </style>
@endpush

@section('content3')
<div class="container">
    <div class="header col-md-10 m-auto mt-5 pb-4">
        <form action="{{url('miltime/genarate')}}" method="POST">
            @csrf
        <div class="row">
            <div class="col-md-3">
                <div class="row">
                    <div class="name pr-2">
                      <label>Name : </label>
                    </div>
                    <div class="pb-2">
                        <select class="meal form-control" name="user_id">
                            <option value="">-Select User-</option>
                            @foreach ($users as $user)
                                <option @isset($person->id) @if($person->id==$user->id) selected @endif @endisset value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                          </select>
                    </div>
                </div>
            </div>
            <div class="month col-md-3">
                <div class="row">
                    <div class="pr-2">
                        <label>Month</label>
                    </div>
                    <div>
                        <select class="meal form-control" name="months">
                                <option   value="1" @if($month=='01') selected @endif>January</option>
                                <option   value="02" @if($month=='02') selected @endif >February</option>
                                <option   value="03" @if($month=='03') selected @endif>March</option>
                                <option   value="04" @if($month=='04') selected @endif>April</option>
                                <option   value="05" @if($month=='05') selected @endif>May</option>
                                <option   value="06" @if($month=='06') selected @endif>Jun</option>
                                <option   value="07" @if($month=='07') selected @endif>July</option>
                                <option   value="08" @if($month=='08') selected @endif>August</option>
                                <option   value="09" @if($month=='09') selected @endif>September</option>
                                <option   value="10" @if($month=='10') selected @endif>October</option>
                                <option   value="11" @if($month=='11') selected @endif>November</option>
                                <option   value="12" @if($month=='12') selected @endif>December</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="row">
                        <div  class="pr-2">
                            <label>Year</label>
                        </div>
                        <div>
                            <select class="meal form-control"  name="years">
                                <option value="">Select year</option>
                                @php $year = date('Y'); @endphp
                                @for($i = $year; $i >= $year-5; $i--)
                                    <option @if($year == $i) selected @endif value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select>
                        </div>
                    </div>

                {{-- <input type="text" style="outline: none; border: none;border-bottom:1px solid black;"> --}}
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary ">Genarate</button>
            </div>
        </div>
    </form>
  </div>
</div>
<div class="container bg-white" id="invoice-POS">
    <div class="row">
      <div class="col-md-10 m-auto">
          <div class="header col-md-12 mt-5 pb-4">
                <form action="{{url('miltime/genarate')}}" method="POST">
                    @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="row">
                            <div class="name pr-2">
                              <label>Name : </label>
                            </div>
                            <div class="pb-2">
                                <label for=""><u>{{$name['name']}}</u></label>
                            </div>
                        </div>
                    </div>
                    <div class="month col-md-2">
                        <div class="row">
                            <div class="pr-2">
                                <label>Month :</label>
                            </div>
                            <div>
                                @php
                                    function getMonthName($monthNumber)
                                    {
                                        return date("F", mktime(0, 0, 0, $monthNumber, 1));
                                    }
                                @endphp
                            <label for="">{{getMonthName($month)}}</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="row">
                                <div  class="pr-2">
                                    <label>Year :</label>
                                </div>
                                <div>
                                    <label>{{$year}}</label>
                                </div>
                            </div>

                        {{-- <input type="text" style="outline: none; border: none;border-bottom:1px solid black;"> --}}
                    </div>
                </div>
            </form>
          </div>
              <div class="first_table">
                  <table style="width:100%;">
                      <tr>
                        <th style="width:10%; margin: auto;">তারিখ</th>
                        <th>সকাল</th>
                        <th>টি ব্রেক</th>
                        <th>দুপুর</th>
                        <th>রাত</th>
                        <th>ছিট</th>
                        <th>পার্ট</th>

                      </tr>
                        @php


                            try {
                                $number = cal_days_in_month(CAL_GREGORIAN, $month, $year);
                                for($i=1;$i<=$number;$i++){
                                    $date = $year."-".$month."-".$i;
                                    $order = App\Order::where('order_date',$date)->where('user_id',$user_id)->get();
                                    $breakfast = $order->where('meal_time','Breakfast')->first();
                                    $Tea_Break = $order->where('meal_time','Tea Break')->first();
                                    $Lunch = $order->where('meal_time','Lunch')->first();
                                    $Dinner = $order->where('meal_time','Dinner')->first();
                                    $Chit = $order->where('meal_time','Chit')->first();
                                    $Party = $order->where('meal_time','Party')->first();
                                    echo "<tr>";
                                        echo "<td>".$date."</td>";
                                        echo "<td>".$breakfast['price']."</td>";
                                        echo "<td>".$Tea_Break['price']."</td>";
                                        echo "<td>".$Lunch['price']."</td>";
                                        echo "<td>".$Dinner['price']."</td>";
                                        echo "<td>".$Chit['price']."</td>";
                                        echo "<td>".$Party['price']."</td>";
                                        // echo "<td>".$breakfast->price."</td>";

                                    echo "</tr>";
                            }
                            } catch (Exception $e) {

                            }
                        @endphp



                </table>
             </div>
    </div>
</div>
</div>
<div class="m-auto pt-5" style="width:6%">
    <input type="button" class="btn btn-sm btn-primary print_btn" onclick="printDiv('invoice-POS')" value="          Print          " />
</div>
@endsection

@section('footerScripts')
    @parent
    <!-- Required datatable js -->

    <script>
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }

    </script>

    <script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <!-- Responsive examples -->
    <script src="{{asset('assets/plugins/datatables/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables/responsive.bootstrap4.min.js')}}"></script>
    <!-- Datatable init js -->
    <script src="{{asset('assets/pages/datatables.init.js')}}"></script>
@stop

