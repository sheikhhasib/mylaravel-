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
                    @if (\Session::has('error'))
                        <div class="alert alert-warning">
                            {!! \Session::get('error') !!}
                        </div>
                    @endif


                    <h4 class="mt-0 header-title"><a  href="{{url('ingredient/create')}}" class="btn btn-primary m-3">Create Ingredient</a></h4>

                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>S.L</th>
                            <th>Name</th>
                            <th>Unit</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Action</th>

                        </tr>
                        </thead>


                        <tbody>
                        @foreach($ingredients  as $index=>$ingredient)
                            <tr>
                                <td>{{++$index}}</td>
                                <td>{{$ingredient->name}}</td>
                                <td>{{$ingredient->unit}}</td>
                                <td>{{$ingredient->qty}}</td>
                                <td>{{number_format($ingredient->price,2)}} Tk</td>
                                <td>{{$ingredient->status}}</td>
                                <td>
                                    <a href="{{url('ingredient/edit',$ingredient->id)}}" class="btn btn-info"><i class="fas fa-lg fa-fw  fa-pencil-alt"></i> </a>
                                    <a href="{{url('ingredient/delete',$ingredient->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure DELETE this Ingredient???')"><i class="fas fa-lg fa-fw  fa-trash"></i> </a></td>
                            </tr>
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

    <!-- Datatable init js -->
    <script src="{{asset('assets/pages/datatables.init.js')}}"></script>
@stop
