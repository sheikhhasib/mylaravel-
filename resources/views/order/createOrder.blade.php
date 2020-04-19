@extends('layouts.app')
@push('head_styles')
    <style>
        .div_hide{
         opacity: 0;
            visibility: hidden;
        }
    </style>

    @endpush
@section('content')
    <div class="row">
        <div class="col-md-10 offset-1">
            <div class="card m-b-30">
                <div class="card-body">

                    <h4 class="mt-0 header-title">Create Order</h4>
                    @if (\Session::has('error'))
                        <div class="alert alert-danger">
                            {!! \Session::get('error') !!}
                        </div>
                    @endif

                    <form action="{{url('/order/create')}}" method="POST">
                        @csrf

                        <div class="col-md-12 row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="example-text-input" class="col-sm-6 col-form-label">Customer Name</label>
                                    <div class="col-sm-6" style="float: right;">
                                        <select required class="js-example-basic-single form-control" name="user_id">
                                            <option value="">Select Any One</option>
                                            @foreach($users as $user)
                                               <option value="{{$user->id}}">{{$user->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                            <div class="form-group d-flex align-items-center">
                                <div class="col-sm-3">
                                    <div class="form-check">
                                        <label class="form-check-label" for="exampleCheck1">Guest</label>
                                        <input style="margin-left: 8px; margin-top: 3px;" type="checkbox" id="guest" class="form-check-input" id="exampleCheck1">
                                    </div>
                                </div>
                                <div class="col-sm-9" style="float: right;">
                                <div id="guest_input" class=" div_hide" style="width: 100px;">
                                    <input type="number" class="form-control"  id="inputPassword2" placeholder="people" name="guest">
                                </div>
                                </div>
                            </div>
                            </div>
                            <div class="col-md-4">
                            <div class="form-group">
                            <label  class="col-sm-6 col-form-label">Order Date</label>
                            <div class="col-sm-6" style="float: right;">
                                <input class="form-control" id ="datepicker" required type="text" name="order_date">
                            </div>
                        </div>
                        </div>
                        </div>


                        <div class="form-group row" id="sob">
                            <div class="col-md-12">
                                <table class="table table-bordered" id="dynamicTable">
                                    <tr>
                                        <th>Item Name</th>
                                        <th>Meal Time</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                        <th>Action</th>
                                    </tr>

                                    <tr class="dynamicTableTr">
                                        <td> <select class="item form-control" required name="addmore[item_id][]">
                                                <option value="">Select Any One</option>
                                                @foreach($items as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td> <select class="meal form-control" required name="addmore[meal][]">
                                                <option value="">Select Any One</option>
                                                    <option value="Breakfast">Breakfast</option>
                                                    <option value="Lunch">Lunch</option>
                                                    <option value="Tea Break">Tea Break</option>
                                                    <option value="Dinner">Dinner</option>
                                                    <option value="Chit">Chit</option>
                                                    <option value="Party">Party</option>
                                            </select>
                                        </td>

                                        <td><input class="form-control qty" type="text" name="addmore[qty][]"></td>
                                        <td><input class="form-control price" type="text" name="addmore[price][]"></td>

                                        <td><button type="button" name="add"  class="btn btn-success add">Add More</button>
                                        <button type="button" name="remove" id="remove-tr" class="btn btn-danger remove-tr">Remove</button></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col">
                                <button class="btn btn-primary" type="submit">Submit</button>
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
        //jquery date function
        $(document).ready(function () {
            $( "#datepicker" ).datepicker();
        });
        //jquery date function
        let guest = document.querySelector('#guest');
        let guest_input = document.querySelector('#guest_input');
        guest.addEventListener('click',function (e) {
            // console.log("click me");
           let divHide =  guest_input.classList.contains('div_hide');
            if(divHide){
                guest_input.classList.remove("div_hide")
            }else{
                guest_input.className='div_hide';
            }
        });
        $(document).ready(function() {
            // $( "#guest" ).on( "click", function() {
            //     var html = '<input type="number" class="form-control" id="inputPassword2" placeholder="people">';
            //     $("#guest_input").html(html);
            // });

        $(document).on('keyup', '.qty', function(e){
            e.preventDefault();
            var ing = $(this);
            var qty = parseFloat($(this).val());
            var unitprice = parseFloat(ing.closest('td').siblings().find('.price').val());
            ing.closest('td').siblings().find('.price').val(qty*unitprice);
        });

        $(document).on('change', '.item', function(e){
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
                url:"{{url('item/getPrice')}}",
                data:{'id': ingredient_id},
                success:function(response){
                    // response = JSON.parse(response);
                    if(response.status==200){
                        ing.closest('td').siblings().find('.qty').val(1);
                        ing.closest('td').siblings().find('.price').val(response.result.price);
                    }else{
                        ing.closest('td').siblings().find('.qty').val(0);
                        ing.closest('td').siblings().find('.price').val(0);
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

            $(".js-example-basic-single").select2({
                tags: true
            });
            $(".item").select2({
                tags: true,
                placeholder: '-- Select item --'
            });
            $(".meal").select2({
                tags: true,
                placeholder: '-- Select item --'
            });



            $(".add").click(function () {

                new_row = $(".dynamicTableTr").first().clone();
                $('#dynamicTable').append(new_row);

                // Copy here

                $(".item").select2({
                    tags: true,
                    placeholder: '-- Select item --'
                });
                $(".meal").select2({
                    tags: true,
                    placeholder: '-- Select item --'
                });
                $(".unit").select2({
                    tags: true,
                    placeholder: '-- Select Unit --'
                });

                // Remove fail select2
                $(".item").last().next().next().remove();
                $(".unit").last().next().next().remove();
                $(".meal").last().next().next().remove();


                $(".item").select2({
                    tags: true,
                    placeholder: '-- Select item --'
                });
                $(".unit").select2({
                    tags: true,
                    placeholder: '-- Select Unit --'
                });
                $(".meal").select2({
                    tags: true,
                    placeholder: '-- Select item --'
                });
            });
        });

        $(document).on('click', '.remove-tr', function(){
            $(this).parents('tr').remove();
        });

        // $(document).ready(function(){
        //
        //     $("#add_form").on('submit',function(e){
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
