
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

@section('contentedit')
<div class="container ">
    <div class="row">
        <div class="col-md-9 m-auto">
                <div class="header">
                    <div class="date m-auto">
                    @if (\Session::has('status'))
                        <div class="alert alert-success">
                            {!! \Session::get('status') !!}
                        </div>
                    @endif
                    <form action="{{url('messbillupdate')}}" method="POST">
                            @csrf
                            {{-- <input type="hidden" name="user_id" value="{{$single_value->user_id}}"> --}}
                        <div class="row">
                            <div class="name col-md-6">
                                <div class="row">
                                    <div>
                                        <label>Name</label>
                                    </div>
                                    <div class="col-md-7">
                                        <select class="meal form-control" name="user_id">
                                        <option value="{{$single_value->user_id}}">{{$single_value->usertomessbill->name}}</option>
                                            @foreach ($users as $user)
                                                <option value="{{$user->id}}">{{$user->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                {{-- <input type="text" style="outline: none; border: none;border-bottom:1px solid black;"> --}}
                            </div>
                            <div class="month col-md-3">
                                <div class="row">
                                    <div class="pr-1">
                                        <label>Month</label>
                                    </div>
                                    <div>
                                        <select class="meal form-control" name="months">
                                                <option @if($single_value->months == '1') selected @endif value="01">January</option>
                                                <option @if($single_value->months == '2') selected @endif value="02">February</option>
                                                <option @if($single_value->months == '3') selected @endif value="03">March</option>
                                                <option @if($single_value->months == '4') selected @endif value="04">April</option>
                                                <option @if($single_value->months == '5') selected @endif value="05">May</option>
                                                <option @if($single_value->months == '6') selected @endif value="06">Jun</option>
                                                <option @if($single_value->months == '7') selected @endif value="07">July</option>
                                                <option @if($single_value->months == '8') selected @endif value="08">August</option>
                                                <option @if($single_value->months == '9') selected  @endif value="09">September</option>
                                                <option @if($single_value->months == '10') selected @endif value="10">October</option>
                                                <option @if($single_value->months == '11') selected @endif value="11">November</option>
                                                <option @if($single_value->months == '12') selected @endif value="12">December</option>
                                        </select>
                                    </div>
                                </div>
                                {{-- <input type="text" style="outline: none; border: none;border-bottom:1px solid black;"> --}}
                            </div>
                            <div class="year col-md-3">
                                <div class="row">
                                    <div  class="pr-1">
                                        <label>Year</label>
                                    </div>
                                    <div>
                                        <select class="meal form-control"  name="years">
                                                <option @if($single_value->years == 2019) selected @endif value="2019">2019</option>
                                                <option @if($single_value->years == 2020) selected @endif value="2020">2020</option>
                                                <option @if($single_value->years == 2021) selected @endif value="2021">2021</option>
                                                <option @if($single_value->years == 2022) selected @endif value="2022">2022</option>
                                                <option @if($single_value->years == 2023) selected @endif value="2023">2023</option>
                                                <option @if($single_value->years == 2024) selected @endif value="2024">2024</option>
                                                <option @if($single_value->years == 2025) selected @endif value="2025">2025</option>
                                                <option @if($single_value->years == 2026) selected @endif value="2026">2026</option>
                                                <option @if($single_value->years == 2027) selected @endif value="2027">2027</option>
                                                <option @if($single_value->years == 2028) selected @endif value="2028">2028</option>
                                                <option @if($single_value->years == 2029) selected @endif value="2029">2029</option>
                                                <option @if($single_value->years == 2030) selected @endif value="2030">2030</option>
                                            </select>
                                        </div>
                                  </div>
                                {{-- <input type="text" style="outline: none; border: none;border-bottom:1px solid black;"> --}}
                                </div>
                            </div>
                        </div>
                </div>
                <div class="body pt-5">
                    <div class="cal-md-12">
                        <div class="messbillinput col-md-9 m-auto">
                            <div class="row">
                                <div class="col-md-4 pr-5">
                                    <label>Daily Messing</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" name="daily_messing" class="form-control" value="{{$single_value->daily_messing}}" >
                                </div>
                            </div>
                            <div class="row pt-2">
                                <div class="col-md-4 pr-5">
                                    <label>Tea Break</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" name="tea_break" class="form-control" value="{{$single_value->tea_break}}">
                                </div>
                            </div>
                            <div class="row pt-2">
                                <div class="col-md-4 pr-5">
                                    <label>Chit Bill</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" name="chit_bill" name="tea_break" class="form-control" value="{{$single_value->chit_bill}}">
                                </div>
                            </div>
                            <div class="row pt-2">
                                <div class="col-md-4 pr-5">
                                    <label>Party Bill</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" name="party_bill" class="form-control" value="{{$single_value->party_bill}}">
                                </div>
                            </div>
                            <div class="row pt-2">
                                <div class="col-md-4 pr-5">
                                    <label>Sports Subscription</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" name="sports_subscription" class="form-control" value="{{$single_value->sports_subscription}}">
                                </div>
                            </div>
                            <div class="row pt-2">
                                <div class="col-md-4 pr-5">
                                    <label >Mess Maint</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" name="mess_maint" class="form-control" value="{{$single_value->mess_maint}}">
                                </div>
                            </div>
                            <div class="row pt-2">
                                <div class="col-md-4 pr-5">
                                    <label>Gass Bill</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" name="gass_bill" class="form-control" value="{{$single_value->gass_bill}}">
                                </div>
                            </div>
                            <div class="row pt-2">
                                <div class="col-md-4 pr-5">
                                    <label>Indi Saving</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" name="indi_saving" class="form-control" value="{{$single_value->indi_saving}}">
                                </div>
                            </div>
                            <div class="row pt-2">
                                <div class="col-md-4 pr-5">
                                    <label>Guest room/Rest house charge</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" name="guest_room" class="form-control" value="{{$single_value->guest_room}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 pr-5">
                                    <label>Arrears</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" name="arrears" class="form-control" value="{{$single_value->arrears}}">
                                </div>
                            </div>
                            <div class="row pt-2">
                                <div class="col-md-4 pr-5">
                                    <label>On payment</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" name="on_payment" class="form-control" value="{{$single_value->on_payment}}">
                                </div>
                            </div>
                            <div class="row pt-2 pb-4">
                                <div class="col-md-4 pr-5">
                                    <label>Others</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" name="others" class="form-control" value="{{$single_value->others}}">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary float-right">Update</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('footerScripts')
    @parent
    <!-- Required datatable js -->
    <script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <!-- Responsive examples -->
    <script src="{{asset('assets/plugins/datatables/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables/responsive.bootstrap4.min.js')}}"></script>
    <!-- Datatable init js -->
    <script src="{{asset('assets/pages/datatables.init.js')}}"></script>
@stop
