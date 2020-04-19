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
            border-collapse: collapse;
        }
        th, td {
            padding: 5px;
            text-align: left;
        }
    </style>
@endpush

@section('content1')
    <div class="container-flude bg-white">
        <form action="{{url('/listitem/date')}}" method="POST">
            @csrf
            <div class="col-md-10 m-auto row pt-3 ">
                    <div class="col-md-3">
                        <label style="float: left;">Date :</label>
                        <div  style="float: left; padding-left: 2px;">
                            <input class="form-control datepicker" id ="datepicker" type="text" name="date">
                        </div>
                    </div>
                <div>
                    <button type="submit" class="btn btn-info">Genarate</button>
                </div>
            </div>
        </form>
    </div>
    <div class="main bg-white" id="invoice-POS">
        <div class="header1" id="printableArea">
            <div class="header_text" style="padding-bottom: 20px; width: 100%;">
                <div style="text-align: center; width: 100%;margin: auto;">
                    <p><u>সীমিত</u></p>
                    <p><u>(অফিসার্স মেস)</u></p>
                    <p><u>বিএমটিএফ লিঃ</u></p>
                    <h4><u>দৈনিক বাজার বিল ভাউচার</u></h4>
                    <input  type="text" style=" width: 80%; outline: none; border: none;border-bottom:1px solid black; margin-bottom: 15px;">
                    <input  type="text" style=" width: 80%; outline: none; border: none;border-bottom:1px solid black;margin-bottom: 15px;">
                    <input  type="text" style=" width: 80%; outline: none; border: none;border-bottom:1px solid black;margin-bottom: 15px;">
                </div>
                <div style="width: 80%;margin: auto;padding-bottom: 20px;">

                    <div class="left" style="float: left;margin: 10px 0px;">
                        <span>জনবল -</span>
                        <input  type="text" value="{{$total_p}}" style="outline: none; width: 22%; border: none;border-bottom:1px solid black;margin-bottom: 15px;">
                        <span>জন</span><br>
                        <p><u>মেনুঃ</u></p>
                    </div>
                    <div class="right" style="float: right; margin: 10px 0px;">
                        <span>তারিখঃ</span>
                        <input  type="text" value="{{$date}}" style="outline: none; border: none;border-bottom:1px solid black;margin-bottom: 15px;">
                    </div>

                </div>
            </div>
        </div>


        <div class="container1">

            <div class="first_table">
                <table style="width:80%; margin: auto;">
                    <tr>
                        <th style="width:10%; margin: auto;">ক্রমিক</th>
                        <th>মেনু (টি ব্রেক)</th>
                        <th style="width:10%; margin: auto;">ক্রমিক</th>
                        <th>মেনু (লাঞ্চ)</th>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td></td>
                        <td>1</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td></td>
                        <td>2</td>
                        <td></td>
                    </tr><tr>
                        <td>3</td>
                        <td></td>
                        <td>3</td>
                        <td></td>
                    </tr><tr>
                        <td>4</td>
                        <td></td>
                        <td>4</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td></td>
                        <td>5</td>
                        <td></td>
                    </tr>


                </table>
            </div>
            <div class="second_table" style="margin-top: 30px;">
                <table style="width:80%; margin: auto;">
                    <tr>
                        <th style="width:8%;">ক্রমিক</th>
                        <th style="width:15%;">দ্রব্যের নাম </th>
                        <th style="width:10%;">পরিমাণ</th>
                        <th style="width:8%;">দর</th>
                        <th style="width:10%;">টাকা</th>
                    </tr>
                    @foreach($lists as $index => $list)
                        <tr>
                            <td>{{++$index}}</td>
                            @php
                                $in = App\Ingredient::where('id',$list->ingredient_id)->first();
                            @endphp
                            <td>{{$in->name}}</td>
                            <td>{{$list->qty}}</td>
                            <td>{{number_format($list->price,2)}}</td>
                            <td> {{number_format(($list->qty)*($list->price),2)}}</td>
                        </tr>
                     @endforeach
                </table>
            </div>
        </div>


        <div class="footer1" style="text-align: center;">
            <p>1</p>
            <p>সীমিত</p>
        </div>
    </div>
    <div class="footer_button_div" style="width: 100%">
        <div class="m-auto" style="width:6%">
            <input type="button" class="btn btn-sm btn-primary print_btn" onclick="printDiv('invoice-POS')" value="          Print          " />
        </div>

    </div>

@endsection

@section('footerScripts')
    @parent
    <!-- Required datatable js -->

    <script>
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
        $(document).ready(function () {
            $('#myModal').on('shown.bs.modal', function () {
                $('#myInput').trigger('focus')
            });
            $( ".datepicker" ).datepicker({
                dateFormat: 'yy-mm-dd',
            });
        });
    </script>
    <script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <!-- Responsive examples -->
    <script src="{{asset('assets/plugins/datatables/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables/responsive.bootstrap4.min.js')}}"></script>

    <!-- Datatable init js -->
    <script src="{{asset('assets/pages/datatables.init.js')}}"></script>
@stop
