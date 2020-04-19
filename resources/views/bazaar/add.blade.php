
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

@section('content4')
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
                    <form action="{{url('bazaar/messbillinsert')}}" method="POST">
                            @csrf
                        <div class="row">
                            <div class="name col-md-6">
                                <div class="row">
                                    <div>
                                        <label>Name</label>
                                    </div>
                                    <div class="col-md-7">
                                        <select class="meal form-control" name="user_id">
                                            <option value="">Select User name</option>
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
                                            <option value="">Select Any One</option>
                                                <option value="01">January</option>
                                                <option value="02">February</option>
                                                <option value="03">March</option>
                                                <option value="04">April</option>
                                                <option value="05">May</option>
                                                <option value="06">Jun</option>
                                                <option value="07">July</option>
                                                <option value="08">August</option>
                                                <option value="09">September</option>
                                                <option value="10">October</option>
                                                <option value="11">November</option>
                                                <option value="12">December</option>
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
                                    <input type="number" name="daily_messing" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >
                                </div>
                            </div>
                            <div class="row pt-2">
                                <div class="col-md-4 pr-5">
                                    <label>Tea Break</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" name="tea_break" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>
                            </div>
                            <div class="row pt-2">
                                <div class="col-md-4 pr-5">
                                    <label>Chit Bill</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" name="chit_bill" name="tea_break" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>
                            </div>
                            <div class="row pt-2">
                                <div class="col-md-4 pr-5">
                                    <label>Party Bill</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" name="party_bill" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>
                            </div>
                            <div class="row pt-2">
                                <div class="col-md-4 pr-5">
                                    <label>Sports Subscription</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" name="sports_subscription" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>
                            </div>
                            <div class="row pt-2">
                                <div class="col-md-4 pr-5">
                                    <label >Mess Maint</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" name="mess_maint" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>
                            </div>
                            <div class="row pt-2">
                                <div class="col-md-4 pr-5">
                                    <label>Gass Bill</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" name="gass_bill" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>
                            </div>
                            <div class="row pt-2">
                                <div class="col-md-4 pr-5">
                                    <label>Indi Saving</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" name="indi_saving" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>
                            </div>
                            <div class="row pt-2">
                                <div class="col-md-4 pr-5">
                                    <label>Guest room/Rest house charge</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" name="guest_room" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 pr-5">
                                    <label>Arrears</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" name="arrears" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>
                            </div>
                            <div class="row pt-2">
                                <div class="col-md-4 pr-5">
                                    <label>On payment</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" name="on_payment" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>
                            </div>
                            <div class="row pt-2 pb-4">
                                <div class="col-md-4 pr-5">
                                    <label>Others</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" name="others" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary float-right">Save</button>
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
