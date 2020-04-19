
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
            border-collapse: collapse;
        }
        th, td {
            padding: 5px;
            text-align: left;
        }
    </style>
@endpush

@section('content2')
<div class="container">
        <form action="{{url('/usercost')}}" method="POST">
            @csrf
            <div class="col-md-12 pb-5">
                <div class="row">
                    <div class="col-md-3">
                        <div class="row pl-3">
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
                <div class="col-md-3">
                    <div class="row pl-2">
                        <div class="pr-2">
                            <label>Month</label>
                        </div>
                        <div>
                            <select class="meal form-control" name="months">
                                    <option value="01" @if($month=='01') selected @endif>January</option>
                                    <option value="02" @if($month=='02') selected @endif>February</option>
                                    <option value="03" @if($month=='03') selected @endif>March</option>
                                    <option value="04" @if($month=='04') selected @endif>April</option>
                                    <option value="05" @if($month=='05') selected @endif>May</option>
                                    <option value="06" @if($month=='06') selected @endif>Jun</option>
                                    <option value="07" @if($month=='07') selected @endif>July</option>
                                    <option value="08" @if($month=='08') selected @endif>August</option>
                                    <option value="09" @if($month=='09') selected @endif>September</option>
                                    <option value="10" @if($month=='10') selected @endif>October</option>
                                    <option value="11" @if($month=='11') selected @endif>November</option>
                                    <option value="12" @if($month=='12') selected @endif>December</option>
                            </select>
                        </div>
                    </div>
                    {{-- <input type="text" style="outline: none; border: none;border-bottom:1px solid black;"> --}}
                </div>
                <div class="col-md-3">
                    <div class="row">
                        <div  class="pr-2">
                            <label>Year</label>
                        </div>
                        <div>
                            <select class="meal form-control"  name="years">
                            <option value="">-Select Year-</option>
                                @php $year = date('Y'); @endphp
                                @for($i = $year; $i >= $year-5; $i--)
                                    <option @if($year == $i) selected @endif value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    {{-- <input type="text" style="outline: none; border: none;border-bottom:1px solid black;"> --}}
            </div>
            <div class="col-md-2">
                <div class="float-right">
                  <button type="submit" class="btn btn-primary">Genarate</button>
                </div>
            </div>
        </div>
    </div>
</form>
</div>
</div>
<div class="container bg-white" id="invoice-POS">
    <div class="row">
      <div class="col-md-10 m-auto">
          <div class="header col-md-12 pb-1">
            <div class="head col-md-10 m-auto pb-2 text-center">
                <h2><u>OFFICERS MESS</u></h2>
                <h2><u>Gazipur Cantt.</u></h2>
                <h2 >MESS BILL</h2>
            </div>
                    <div class="col-md-12">
                        <div class="row">

                        <div class="col-md-4">
                            <div class="row pl-3">
                                <div class="name pr-2">
                                  <label>Name : </label>
                                </div>
                                <div class="pb-2">
                                <label for="">{{$person['name']}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="row pl-2">
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
                            {{-- <input type="text" style="outline: none; border: none;border-bottom:1px solid black;"> --}}
                        </div>
                        <div class="col-md-3">
                            <div class="row">
                                <div  class="pr-2">
                                    <label>Year :</label>
                                </div>
                                <div>
                                <label for="">{{$year}}</label>
                                </div>
                            </div>
                            {{-- <input type="text" style="outline: none; border: none;border-bottom:1px solid black;"> --}}
                    </div>
                </div>
            </div>
          </div>
          <div class="col-md-12 pb-3">

              <div class="col-md-12 pb-2">
                  <div class="row">
                      <div class="col-md-10">
                          <div class="pb-2">
                            <label>BA NO.</label>
                          </div>
                          <div>
                            <label>Unit: Bangladesh Machine Tools LTD.</label>
                          </div>
                      </div>
                      <div class="col-md-2">
                            <label>RANK:</label>
                      </div>
                  </div>
              </div>
              <div class="first_table">
                  <table style="width:100%;">
                      <tr>
                        <th style="width:10%; margin: auto;">S.L.</th>
                        <th>Details</th>
                        <th style="width:25%; margin: auto;">Taka</th>
                      </tr>
                      <tr>
                          <td>1</td>
                          <td>Daily Messing</td>
                        <td>
                            @isset($messbills->daily_messing)
                                 {{number_format($messbills->daily_messing,2)}}
                            @endisset
                        </td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td>Tea Break</td>
                        <td>
                            @isset($messbills->tea_break)
                                 {{number_format($messbills->tea_break,2)}}
                            @endisset
                        </td>
                      </tr>
                      <tr>
                        <td>3</td>
                        <td>Chit Bill</td>
                        <td>
                            @isset($messbills->chit_bill)
                                 {{number_format($messbills->chit_bill,2)}}
                            @endisset
                        </td>
                      </tr>
                      <tr>
                        <td>4</td>
                        <td>Party Bill</td>
                        <td>
                            @isset($messbills->party_bill)
                                {{number_format($messbills->party_bill,2)}}
                            @endisset
                        </td>
                      </tr>
                      <tr>
                        <td>5</td>
                        <td>Sports Subscription</td>
                        <td>
                            @isset($messbills->sports_subscription)
                                {{number_format($messbills->sports_subscription,2)}}
                            @endisset
                        </td>
                      </tr>
                      <tr>
                        <td>6</td>
                        <td>Mess Maint</td>
                        <td>
                            @isset($messbills->mess_maint)
                                {{number_format($messbills->mess_maint,2)}}
                            @endisset
                        </td>
                      </tr>
                      <tr>
                        <td>7</td>
                        <td>Gass Bill</td>
                        <td>
                            @isset($messbills->gass_bill)
                                {{number_format($messbills->gass_bill,2)}}
                            @endisset
                        </td>
                      </tr>
                      <tr>
                        <td>8</td>
                        <td>Indi Saving</td>
                        <td>
                            @isset($messbills->indi_saving)
                                {{number_format($messbills->indi_saving,2)}}
                            @endisset
                        </td>
                      </tr>
                      <tr>
                        <td>9</td>
                        <td>Guest room/Rest house charge</td>
                        <td>
                            @isset($messbills->guest_room)
                                {{number_format($messbills->guest_room,2)}}
                            @endisset
                        </td>
                      </tr>
                      <tr>
                        <td>10</td>
                        <td>Arrears</td>
                        <td>
                            @isset($messbills->arrears)
                                {{number_format($messbills->arrears,2)}}
                            @endisset
                        </td>
                      </tr>
                      <tr>
                        <td>11</td>
                        <td>On payment</td>
                        <td>
                            @isset($messbills->on_payment)
                                {{number_format($messbills->on_payment,2)}}
                            @endisset
                        </td>
                      </tr>
                      <tr>
                        <td>12</td>
                        <td>Others</td>
                        <td>
                            @isset($messbills->others)
                                {{number_format($messbills->others,2)}}
                            @endisset
                        </td>
                      </tr>
                      @php
                            if($messbills){
                                $total = $messbills->daily_messing + $messbills->tea_break + $messbills->chit_bill + $messbills->party_bill + $messbills->sports_subscription + $messbills->mess_maint + $messbills->gass_bill + $messbills->indi_saving + $messbills->guest_room + $messbills->arrears +  $messbills->on_payment + $messbills->others;
                            }else{
                                $total = 0.00;
                            }

                      @endphp
                      <tr>
                          <th colspan="2">Total</th>
                          <td>{{number_format($total,2)}}</td>
                      </tr>
                    </table>
              </div>
          </div>
          <div class="col-md-12">
              <div class="row">
                  <div class="col-md-3">
                      <h3>Note :</h3>
                  </div>
                  <div class="col-md-9">
                      <ul>
                          <ol>1. Please clear the bill 10th of each month</ol>
                          <ol>2. Check to be issued in favour of BMTF Officer's Mess</ol>
                          <ol>3. Please add tk. 40.00 (forty only) in case of out sta cheque</ol>
                      </ul>
                  </div>
              </div>
          </div>
          <div class="col-md-12 mt-3">
              <input type="text" style="outline: none; border: none;border-bottom:1px solid black;">
              <p>Mess NCO</p>
          </div>
          <div class="col-md-12 pb-3">
              <div class="row">
                  <div class="col-md-6">
                      <label>Date  :</label>
                        @php
                            $mytime = Carbon\Carbon::now();
                        @endphp
                      <input type="text" value="{{$mytime->toDateString()}}" style="outline: none; width:20%; border: none;border-bottom:1px solid black;">
                  </div>
                  <div class="col-md-6 text-center">
                      <input type="text" style="outline: none; border: none;border-bottom:1px solid black;">
                      <p>Major<br>Mess Secretary<br>BMTF offr's Mess<br>Gazipur Cantt</p>
                  </div>
              </div>
          </div>
          <div class="col-md-12 m-auto text-center pt-3 pb-2">
              <hr width="100%">
              <h3><u>RECEIPT</u></h3>
              <h3><u>Offr's Mess BMTF</u></h3>
          </div>

          <div class="col-md-12 pb-5">
             <div class="pb-4">
                  <lebel>BA</lebel>
                  <input type="text" style="outline: none; width: 30%; border: none;border-bottom:1px solid black;">
                  <lebel>RANK</lebel>
                  <input type="text" style="outline: none;width:60.5%; border: none;border-bottom:1px solid black;">
             </div>
             <div>
                  <lebel>Name</lebel>
                  <input type="text" style="outline: none;width: 94%; border: none;border-bottom:1px solid black;">
             </div>
          </div>
          <div class="col-md-12 pb-5">
              <div class="pb-4">
                   <lebel>Received Tk</lebel>
                   <input type="text" style="outline: none; width: 77%; border: none;border-bottom:1px solid black;">
                   <lebel>in cash/Cheque</lebel>
              </div>
              <div class="pb-3">
                   <lebel>as Mess Bill for the month of</lebel>
                   <input type="text" style="outline: none;width: 76%; border: none;border-bottom:1px solid black;">
              </div>
              <div class="pb-5">
                  <lebel>Date</lebel>
                  <input type="text" style="outline: none; width: 30%; border: none;border-bottom:1px solid black;">
                  <lebel>RANK</lebel>
                  <input type="text" style="outline: none;width:59.5%; border: none;border-bottom:1px solid black;">
             </div>
           </div>
        </div>
    </div>
</div>
<div class="m-auto" style="width:6%">
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
