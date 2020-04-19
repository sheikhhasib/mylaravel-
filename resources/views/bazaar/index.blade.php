@extends('layouts.app')
@push('head_styles')
    <!-- DataTables -->
    <link href="{{asset('assets/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{asset('assets/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
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

                    <h4 class="mt-0 header-title"><a  href="{{url('order/create')}}" class="btn btn-primary m-3">Create Item</a></h4>

                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>S.L</th>
                            <th>Ingredient</th>
                            <th>Qty</th>
                            <th>Price</th>
{{--                            <th>Total Price</th>--}}
                        </tr>
                        </thead>

                        <tbody>

                        @php $totalPrice = 0; @endphp
                        @foreach($lists  as $index=> $list)
                            <tr>
                                <td>{{++$index}}</td>
                                @php
                                    $in = App\Ingredient::where('id',$list->ingredient_id)->first();
                                    $totalPrice += $list->price;
                                 @endphp
                                <td>{{$in->name}}</td>
                                <td>{{$list->qty}}</td>
                                <td>{{$list->price}}</td>
{{--                                <td>{{$list->qty*$list->price}}</td>--}}
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <td colspan="3">Total Price</td>
                        <td>{{$totalPrice}}</td>
                        </tfoot>
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

    <!-- Datatable init js -->
    <script src="{{asset('assets/pages/datatables.init.js')}}"></script>
@stop
