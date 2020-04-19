
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

@section('content5')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 header">
                <h3>Meal Bill List</h3>
            </div>
            <div class="col-md-12">
                <table class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                      <tr>
                        <th scope="col">S.L.</th>
                        <th scope="col">User name</th>
                        <th scope="col">Month</th>
                        <th scope="col">Year</th>
                        <th scope="col">Daily Messing</th>
                        <th scope="col">Tea Break</th>
                        <th scope="col">Chit Bill</th>
                        <th scope="col">Party Bill</th>
                        <th scope="col">Sports Subscription</th>
                        <th scope="col">Mess Maint</th>
                        <th scope="col">Gass Bill</th>
                        <th scope="col">Indi Saving</th>
                        <th scope="col">Guest Room</th>
                        <th scope="col">Arrears</th>
                        <th scope="col">On Payment</th>
                        <th scope="col">Others</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($messbills as $index => $messbill)
                            <tr>
                            <th scope="row">{{++$index}}</th>
                                <td>
                                    @isset($messbill->usertomessbill->name)
                                        {{$messbill->usertomessbill->name}}
                                    @endisset
                                </td>
                                <td>{{$messbill->months}}</td>
                                <td>{{$messbill->years}}</td>
                                <td>{{$messbill->daily_messing}}</td>
                                <td>{{$messbill->tea_break}}</td>
                                <td>{{$messbill->chit_bill}}</td>
                                <td>{{$messbill->party_bill}}</td>
                                <td>{{$messbill->sports_subscription}}</td>
                                <td>{{$messbill->mess_maint}}</td>
                                <td>{{$messbill->gass_bill}}</td>
                                <td>{{$messbill->indi_saving}}</td>
                                <td>{{$messbill->guest_room}}</td>
                                <td>{{$messbill->arrears}}</td>
                                <td>{{$messbill->on_payment}}</td>
                                <td>{{$messbill->others}}</td>

                                <td>
                                    <div class="btn-group mr-2" role="group" aria-label="First group">
                                        <a href="{{url('messbill_list/delete',$messbill->id)}}" class="btn btn-danger"><i class="fa fa-trash-alt"></i></a>
                                        <a href="{{url('messbill_list/edit',$messbill->user_id)}}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                                    </div>
                                </td>
                          </tr>
                        @endforeach

                    </tbody>
                  </table>
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
