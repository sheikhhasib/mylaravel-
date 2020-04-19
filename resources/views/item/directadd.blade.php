@extends('layouts.app')
@section('contentda')
<div class="container">
    <div class="row">
        <div class="col-md-8 auto">
            @if (\Session::has('status'))
                <div class="alert alert-danger">
                    {!! \Session::get('status') !!}
                </div>
            @endif
            @if (\Session::has('delete'))
                <div class="alert alert-danger">
                    {!! \Session::get('delete') !!}
                </div>
            @endif
            <form action="{{url('/item/directadditem')}}" method="POST">
                @csrf
                <div class="pb-3">
                    <h3> Direct Add Item</h3>
                </div>
                  <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Item Name</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="name" class="form-control" placeholder="item name">
                        </div>
                      </div>
                  </div>
                  <div class="form-group">
                      <div class="row">
                        <div class="col-md-4">
                            <label>Unit</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="unit" class="form-control" placeholder="unit">
                        </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-4">
                          <label>Qty</label>
                      </div>
                      <div class="col-md-8">
                          <input type="text" name="qty" class="form-control" placeholder="qty">
                      </div>
                  </div>
                </div>
                <div class="form-group">
                    <div class="row">
                      <div class="col-md-4">
                          <label>price</label>
                      </div>
                      <div class="col-md-8">
                          <input type="text" name="price" class="form-control" placeholder="price">
                      </div>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary float-right">Save</button>
              </form>
        </div>
    </div>
</div>
@endsection
