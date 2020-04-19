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

                    <h4 class="mt-0 header-title"><a  href="{{url('customer/create')}}" class="btn btn-primary m-3">Add New Customer</a></h4>

                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <!-- <th><input type="checkbox" name="vehicle1"  id="checkall" ></th> -->
                            <th>S.L</th>
                            <th>Name</th>
                            <th>Designation</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Action</th>

                        </tr>
                        </thead>


                        <tbody>
                  
                                @foreach($customers as $index => $customer)
                                    <tr class="targetRow">
                                       
                                            <!-- <td>
                                                <input type="checkbox" class="checkitem " name="" value="">
                                            </td> -->
                                            <td >{{++$index}}</td>
                                            <td>{{$customer->name}}</td>
                                            <td>{{$customer->designation}}</td>
                                            <td>{{$customer->phone}}</td>
                                            <td>{{$customer->email}}</td>
                                            <td>{{$customer->role}}</td>
                                            <td>{{$customer->status}}</td>
                                            <td>
                                              <a href="{{url('customer/detail',$customer->id)}}" class="btn btn-primary"><i class="fas fa-lg fa-fw  fa-eye"></i> </a>
                                              <a href="{{url('customer/edit',$customer->id)}}" class="btn btn-info"><i class="fas fa-lg fa-fw  fa-pencil-alt"></i> </a>
                                              <a href="{{url('customer/delete',$customer->id)}}" class="btn btn-danger"><i class="fas fa-lg fa-fw  fa-trash"></i> </a>
                                            </td> 
                                    </tr>
                                @endforeach
                        </tbody>
                    </table>
                    {{$customers->links()}}

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

    <script type="text/javascript" >
        // $(document).ready(function() {
        //   $("#checkall").change(function(){
        //     $(".checkitem").prop("checked", $(this).prop("checked"))
        //   })

        //   $(".checkitem").change(function(){
        //     if ( $(this).prop("checked") == false ) {
        //         $("#checkall").prop("checked", false)
        //     }
        //     if ( $(".checkitem:checked").length == $(".checkitem").length ) {
        //         $("#checkall").prop("checked", true)
        //     }

        //   })

        //    $(".checkitem").click(function(event){          


        //       var tr = $(this);             

        //       var data = $(this).parent().siblings(".target").attr('id');

        //       $.ajaxSetup({
        //             headers: {
        //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //             }
        //         });

        //       // console.log(data);

        //       $.ajax({
        //           url: 'item/list/api',
        //           type: 'POST',
        //           data:  { data: data },
        //           dataType: "json",
        //           success: function(data) {
        //             // console.log(data);
        //             tr.parent().siblings(".target").empty().html("<input type='text' value='"+data.name+"'>");
        //           },
        //           error: function(e) {
        //             //called when there is an error
        //             console.log(e.responseText);
        //           }
        //         });
        //   });

        //  });
    </script>
@stop
