@extends('layouts.app')
@push('head_styles')
    <!-- DataTables -->
    <link href="{{asset('assets/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/plugins/jquery-ui/jquery-ui.min.css')}}" rel="stylesheet" type="text/css" />


    <!-- Responsive datatable examples -->
    <link href="{{asset('assets/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <style>
        .mt-35{
            margin-top: 30px;
        }
    </style>
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body">
                    @if (\Session::has('success'))
                        <div class="alert alert-success">
                            {!! \Session::get('success') !!}
                        </div>
                    @endif

                    @if (\Session::has('dstatus'))
                            <div class="alert alert-success">
                                {!! \Session::get('dstatus') !!}
                            </div>
                        @endif
                    <form action="{{url('/order/search')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row pb-4 align-items-center">
                            <div class="col-md-2">
                                <h4 class="mt-0 header-title "><a  href="{{url('order/create')}}" class="btn btn-primary mt-35">Order</a></h4>
                            </div>
                            <div class="col-md-2">
                                <label>Customer Name</label>
                                <div style="float: left;width: 90%">
                                    <select class="item form-control"  name="coustomer_id">
                                        <option value="">Select Any One</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label style="float: left;">Start Date</label>
                                <div  style="float: left; padding-left: 1px;">
                                    <input class="form-control datepicker" id ="datepicker1" value="" type="text" name="start_date">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label style="float: left;">End Date</label>
                                <div  style="float: left; padding-left: 2px;">
                                    <input class="form-control datepicker" id ="datepicker" type="text" value="" name="end_date">
                                </div>
                            </div>
                            <div class="col-1">
                                <h4 class="mt-0 header-title"><button type="submit" class="btn btn-primary mt-35">search</button></h4>
                            </div>
                            <div class="col-1">
                                <h4 class="mt-0 header-title"><a href="{{url('/order')}}" class="btn btn-primary mt-35">All</a></h4>
                            </div>
                        </div>
                    </form>
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>S.L</th>
                            <th>Name</th>
                            <th>Guest</th>
                            <th>Meal time</th>
                            <th>Item name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Order Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>


                            @foreach($orders  as $index=>$order)
                                <tr>
                                <td>{{++$index}}</td>
                                <td>
                                    @isset($order->relationtouser->name)
                                        {{ $order->relationtouser->name }}
                                    @endisset
                                </td>
                                <td>
                                    @isset($order->guest)
                                        {{ $order->guest }}
                                    @endisset
                                </td>
                                <td>
                                    @isset($order->meal_time)
                                        {{ $order->meal_time }}
                                    @endisset
                                </td>

                                <td>
                                @isset($order->items->name)
                                    {{$order->items->name}}
                                @endisset
                                </td>
                                <td>
                                    @isset($order->qty)
                                        {{$order->qty}}
                                    @endisset
                                </td>
                                <td>
                                    @isset($order->price)
                                        {{$order->price}}
                                    @endisset
                                </td>
                                <td>
                                    @isset($order->order_date)
                                        {{$order->order_date}}
                                    @endisset
                                </td>
                                <td>
                                    @isset($order->status)
                                        {{$order->status}}
                                    @endisset
                                </td>

{{--                                <td>   <a href="{{url('order/delete',$order->id)}}" class="btn btn-danger" data-toggle="modal" data-target="#myModal"><i class="fas fa-trash-alt"></i> </a></td>--}}
                                <td> <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#myModal"><i class="fas fa-trash-alt"></i> </a></td>
                                </tr>
                                <div class="modal" tabindex="-1" role="dialog" id="myModal">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header alert-danger">
                                                <h5 class="text-center text-white"> DELETE CONFIRMATION</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"  style="font-size: 30px;color: black;opacity: 1">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are You Sure Want To Delete !</p>
                                            </div>
                                            <form action="{{url('order/delete',$order->id)}}" method="post">
                                                @csrf
                                                <div class="modal-footer">
                                                    <button type="submit"  class="btn btn-danger" >Yes</button>
                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->





@endsection

@section('footerScripts')
    @parent
    <!-- Required datatable js -->
    <script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <!-- Responsive examples -->
    <script src="{{asset('assets/plugins/datatables/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>


    <!-- Datatable init js -->
    <script src="{{asset('assets/pages/datatables.init.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('#myModal').on('shown.bs.modal', function () {
                $('#myInput').trigger('focus')
            });
            $( ".datepicker" ).datepicker({
                dateFormat: 'yy-mm-dd',
            });
        });

    </script>
@stop
