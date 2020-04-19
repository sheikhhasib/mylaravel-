@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-8 offset-2">
            <div class="card m-b-30">
                <div class="card-body">

                    <h4 class="mt-0 header-title">Item Create</h4>
                    @if (\Session::has('error'))
                        <div class="alert alert-danger">
                            {!! \Session::get('error') !!}
                        </div>
                    @endif
                    <form action="{{url('item/store')}}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Item Name</label>
                            <div class="col-sm-10">

                                <select class="js-example-basic-single form-control" name="item_id">
                                    <option value="">Select Any One</option>
                                    @foreach($items as $item)
                                        <option value="{{$item->id}}"  {{$id==$item->id?'Selected':''}} >{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row" id="sob">
                            <div class="col-md-12">
                                <table class="table table-bordered" id="dynamicTable">
                                    <tr>
                                        {{--                       <th>Item Name</th>--}}
                                        <th>Ingredient</th>

                                        <th>Unit</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                        <th>Action</th>
                                    </tr>

                                        @foreach($itemIngredient as $index =>  $goods)
                                            <tr class="dynamicTableTr">
                                                <td> <select class="ingredient form-control" name="addmore[ingredient_id][]">
                                                        <option value="">Select Any One</option>
                                                        @foreach($ingredients as $ingredient)
                                                            <option value="{{$ingredient->id}}" @isset($goods->ingredient_id) {{$goods->ingredient_id==$ingredient->id?'Selected':''}} @endisset>{{$ingredient->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>

                                                <td>
                                                    <select class="unit form-control" name="addmore[unit_id][]">
                                                        <option value="">Select Any One</option>
                                                        @foreach($units as $unit)
                                                            <option value="{{$unit->name}}" @isset($goods->unit_id) {{$goods->unit_id==$unit->name?'Selected':''}} @endisset>{{$unit->name}}</option>
                                                        @endforeach

                                                    </select>
                                                </td>
                                                <td> <input class="form-control" type="number" name="addmore[qty][]" value="{{$goods->qty}}"></td>
                                                <td><input class="form-control" type="number" name="addmore[price][]" value="{{$goods->price}}"></td>
                                                <td>
                                                    @if($index == 0)
                                                    <button type="button" name="add"  class="btn btn-success add">Add More</button>
                                                    <button type="button" name="remove" id="remove-tr" class="btn btn-danger remove-tr">Remove</button></td>
                                                    @endif
                                            </tr>
                                        @endforeach

                                </table>
                            </div>
                            <div class="col">
                                <button class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>

    </div>

@endsection

@section('footerScripts')
    @parent
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {

            $(".js-example-basic-single").select2({
                tags: true
            });
            $(".ingredient").select2({
                tags: true,
                placeholder: '-- Select Ingredient --'
            });
            $(".unit").select2({
                tags: true,
                placeholder: '-- Select Unit --'
            });


            $(".add").click(function () {

                new_row = $(".dynamicTableTr").first().clone();
                $('#dynamicTable').append(new_row);

                // Copy here

                $(".ingredient").select2({
                    tags: true,
                    placeholder: '-- Select Ingredient --'
                });
                $(".unit").select2({
                    tags: true,
                    placeholder: '-- Select Unit --'
                });

                // Remove fail select2
                $(".ingredient").last().next().next().remove();
                $(".unit").last().next().next().remove();

                $(".ingredient").select2({
                    tags: true,
                    placeholder: '-- Select Ingredient --'
                });
                $(".unit").select2({
                    tags: true,
                    placeholder: '-- Select Unit --'
                });
            });
        });

        $(document).on('click', '.remove-tr', function(){
            $(this).parents('tr').remove();
        });

    </script>

@endsection
