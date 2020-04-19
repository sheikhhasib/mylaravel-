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
                    <form action="{{url('/item/store')}}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Item Name</label>
                            <div class="col-sm-10">

                                <select class="js-example-basic-single form-control" name="item_id">
                                    <option value="">Select Any One</option>
                                    @foreach($items as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
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
                                        <th>Unit Price</th>
                                        <th>Price</th>
                                        <th>Action</th>
                                    </tr>
                                    <tr class="dynamicTableTr">
                                        {{--                       <td><input class="form-control" type="text" name="addmore[0][item_id]" id="example-text-input"></td>--}}
                                        <td> <select class="ingredient form-control" name="addmore[ingredient_id][]">
                                                <option value="">Select Any One</option>
                                                @foreach($ingredients as $ingredient)
                                                    <option value="{{$ingredient->id}}">{{$ingredient->name}}</option>
                                                @endforeach
                                            </select>
                                        </td>

                                        <td>
                                            <select class="unit form-control" name="addmore[unit_id][]">
                                                <option value="">Select Any One</option>
                                                @foreach($units as $unit)
                                                    <option value="{{$unit->name}}">{{$unit->name}}</option>
                                                @endforeach

                                            </select>
                                        </td>
                                        <td> <input class="form-control qty" type="text" name="addmore[qty][]"></td>
                                        <td><input class="form-control unit_price" type="text" name="addmore[unit_price][]"></td>
                                        <td><input class="form-control price" type="text" name="addmore[price][]"></td>
                                        <td><button type="button" name="add"  class="btn btn-success add">Add More</button>
                                            <button type="button" name="remove" id="remove-tr" class="btn btn-danger remove-tr">Remove</button></td>
                                    </tr>
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


        $(document).on('keyup', '.qty', function(e){
            e.preventDefault();
            var ing = $(this);
            var qty = parseFloat($(this).val());
            var unitprice = parseFloat(ing.closest('td').siblings().find('.unit_price').val());
            ing.closest('td').siblings().find('.price').val(qty*unitprice);
        });

        $(document).on('keyup', '.unit_price', function(e){
            e.preventDefault();
            var ing = $(this);
            var unitprice = parseFloat($(this).val());
            var qty = parseFloat(ing.closest('td').siblings().find('.qty').val());
            ing.closest('td').siblings().find('.price').val(qty*unitprice);
        });
        $(document).on('change', '.unit', function(e){
            e.preventDefault();
            var ing = $(this);
            var unit = $(this).val();
            id = ing.closest('td').siblings().find('.ingredient').val();
            $.ajax({
                type:"POST",
                dataType: 'json',
                delay: 250,
                tags: true,
                url:"{{url('ingredient/getPriceByUnit')}}",
                data:{'id': id,'change_unit': unit},
                success:function(response){
                    // response = JSON.parse(response);
                    if(response.status==200){
                        // ing.closest('td').siblings().find('.qty').val(response.result.qty);
                        ing.closest('td').siblings().find('.unit_price').val(response.result);
                        var qty = ing.closest('td').siblings().find('.qty').val();
                        ing.closest('td').siblings().find('.price').val(qty*response.result);
                        // ing.closest('td').siblings().find('.unit').val(response.result.unit);
                        // ing.closest('td').siblings().find('.unit').select2().trigger('change');
                    }else{
                        ing.closest('td').siblings().find('.qty').val(0);
                        ing.closest('td').siblings().find('.unit_price').val(0);
                        ing.closest('td').siblings().find('.price').val(0);
                        ing.closest('td').siblings().find('.unit').val(0);
                    }
                },
                error:function(){
                    // console.log(error)
                    // alert("data not save")
                }
            });
        });

        $(document).on('change', '.ingredient', function(e){
            e.preventDefault();
            var ing = $(this);
            // console.log($(this).find("input").val() );
           // $(this).closest('td').next('td').find('input').text(2);
            var ingredient_id = $(this).val();
            $.ajax({
                type:"POST",
                dataType: 'json',
                delay: 250,
                tags: true,
                url:"{{url('ingredient/getPrice')}}",
                data:{'id': ingredient_id},
                success:function(response){
                    // response = JSON.parse(response);
                    if(response.status==200){
                        ing.closest('td').siblings().find('.qty').val(response.result.qty);
                        ing.closest('td').siblings().find('.unit_price').val(response.result.price);
                        ing.closest('td').siblings().find('.price').val(response.result.qty*response.result.price);
                        ing.closest('td').siblings().find('.unit').val(response.result.unit);
                        ing.closest('td').siblings().find('.unit').select2().trigger('change');
                        $(".unit").select2({
                            tags: true,
                            placeholder: '-- Select Unit --'
                        });
                    }else{
                        ing.closest('td').siblings().find('.qty').val(0);
                        ing.closest('td').siblings().find('.unit_price').val(0);
                        ing.closest('td').siblings().find('.price').val(0);
                        ing.closest('td').siblings().find('.unit').val(0);
                    }
                },
                error:function(){
                    // console.log(error)
                    // alert("data not save")
                }
            });
            // alert($(this).val());

            // var  ingredient_id ='';
            // $( "select option:selected" ).each(function() {
            //     if($( this ).val()!=undefined){
            //         ingredient_id += $( this ).val() ;
            //     }
            // });
            // $.ajax({
            //         type:"POST",
            //         url:"/item/store",
            //         data:$('#add_form').serialize(),
            //         success:function(response){
            //             console.log(response);
            //             $('#myModal').modal('hide')
            //             alert('Datasave')
            //         },
            //         error:function(){
            //             console.log(error)
            //             alert("data not save")
            //         }
            //
            //
            //     });
            // alert(ingredient_id);
        });

        // $(document).ready(function(){
        //
        //     $(".ingredient").on('c',function(e){
        //         e.preventDefault();
        //
        //         $.ajax({
        //             type:"POST",
        //             url:"/item/store",
        //             data:$('#add_form').serialize(),
        //             success:function(response){
        //                 console.log(response);
        //                 $('#myModal').modal('hide')
        //                 alert('Datasave')
        //             },
        //             error:function(){
        //                 console.log(error)
        //                 alert("data not save")
        //             }
        //
        //
        //         });
        //     });
        //
        // });
    </script>

@endsection
