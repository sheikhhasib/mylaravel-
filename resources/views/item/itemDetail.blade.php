@extends('layouts.app')
@push('head_styles')
@endpush
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body">

                    <h4 class="mt-0 header-title"><a  href="{{url('item/edit/'.$id)}}" class="btn btn-primary m-3">Edit Item</a></h4>
                    <div class="card m-b-30">
                        <div class="card-body">
                            <h4 class="mt-0 header-title"></h4>
                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <tr>
                                    <td>Sl.</td>
                                    <td>Ingredients</td>
                                    <td>Quantity</td>
                                    <td>Price</td>
                                    <td>Action</td>
                                </tr>
                                @foreach($itemIngredient as $index => $ingredients)
                                <tr>
                                    <td>{{++$index}}</td>
                                    <td>@isset($ingredients->ingredient->name){{$ingredients->ingredient->name}}@endisset</td>
                                    <td>{{$ingredients->qty}} {{$ingredients->unit_id}}</td>
                                    <td>{{$ingredients->price}}</td>
                                    <td></td>
                                </tr>
                                @endforeach
                            </table>


                        </div>
                    </div>


                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

@endsection
@section('footerScripts')
    @parent

@stop
