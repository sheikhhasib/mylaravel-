@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card m-b-30">
                <div class="card-body">
@if(isset($ingredient->id))
                        <h4 class="mt-0 header-title">Ingredient Update</h4>
    @else
                        <h4 class="mt-0 header-title">Ingredient Create</h4>
                        <p class="italic" style="font-style: italic"><small>The field labels marked with <abbr style="color: red">*</abbr> are required input fields.</small></p>
    @endif

                    <hr>
                    @if (\Session::has('error'))
                        <div class="alert alert-danger">
                            {!! \Session::get('error') !!}
                        </div>
                    @endif
                    <form action="{{url('/ingredient/create')}}" method="POST">
                        @csrf
                        <input type="hidden" name="id" class="form-control" value="{{isset($ingredient->id)?$ingredient->id:''}}">
                        <div class="form-group row">
                            <label for="example-text-input" class="col-md-3 col-form-label">Ingredient Name<abbr style="color: red">*</abbr></label>
                            <div class="col-md-9">
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"  value="{{isset($ingredient->name)?$ingredient->name:''}}">
                                @error('name')
                                <span class="invalid-feedback offset-4" role="alert">
                                                  <strong>{{ $message }}</strong>
                                             </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-md-3 col-form-label">Ingredient Unit<abbr style="color: red">*</abbr></label>
                            <div class="col-md-9">
                                <select class="meal form-control @error('unit') is-invalid @enderror" name="unit">
                                    @php
                                        $unit = isset($ingredient->unit)?$ingredient->unit:'';
                                    @endphp
                                    <option value="kg" @if($unit=="kg") selected @endif>kg</option>
                                    <option value="g" @if($unit== "g") selected @endif>G</option>
                                    <option value="gm" @if($unit=="gm") selected @endif>gm</option>
                                    <option value="ltr" @if($unit=="ltr") selected @endif>ltr</option>
                                    <option value="pcs" @if($unit=="pcs") selected @endif>pcs</option>
                                </select>
                                {{-- <input type="text" name="unit" class="form-control @error('unit') is-invalid @enderror"  value="{{isset($ingredient->unit)?$ingredient->unit:''}}"> --}}
                                @error('unit')
                                <span class="invalid-feedback offset-4" role="alert">
                                                  <strong>{{ $message }}</strong>
                                             </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-md-3 col-form-label">Ingredient Qty<abbr style="color: red">*</abbr></label>
                            <div class="col-md-9">
                                <input type="text" name="qty" class="form-control @error('qty') is-invalid @enderror"  value="{{isset($ingredient->qty)?$ingredient->qty:''}}">
                                @error('qty')
                                <span class="invalid-feedback offset-4" role="alert">
                                                  <strong>{{ $message }}</strong>
                                             </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-md-3 col-form-label">Ingredient Price<abbr style="color: red">*</abbr></label>
                            <div class="col-md-9">
                                <input type="number" name="price" class="form-control @error('price') is-invalid @enderror"  value="{{isset($ingredient->price)?$ingredient->price:''}}">
                                @error('price')
                                <span class="invalid-feedback offset-4" role="alert">
                                                  <strong>{{ $message }}</strong>
                                             </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 text-center">

                                @if(isset($ingredient->id))
                                    <button class="btn btn-success">Update Ingredient</button>
                                @else
                                    <button class="btn btn-success">Add Ingredient</button>
                                @endif
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

@endsection
