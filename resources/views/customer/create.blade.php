@extends('layouts.app')
@push('head_styles')
   
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
                        <div class="alert alert-error">
                            {!! \Session::get('error') !!}
                        </div>
                    @endif

                    <form method="POST" action="{{ url('customer/store') }}">
                      @csrf

                      <input type="hidden" name="id" value="{{$user->id}}">

                      <div class="form-group row">
                          <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                          <div class="col-md-6">
                              <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name',$user->name) }}" required autocomplete="name" autofocus>

                              @error('name')
                              <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                              @enderror
                          </div>
                      </div>
                      <div class="form-group row">
                          <label for="designation" class="col-md-4 col-form-label text-md-right">{{ __('Designation') }}</label>

                          <div class="col-md-6">
                              <input id="designation" type="text" class="form-control @error('designation') is-invalid @enderror" name="designation" value="{{ old('designation',$user->designation) }}"  autocomplete="designation" autofocus>

                              @error('designation')
                              <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                              @enderror
                          </div>
                      </div>
                      <div class="form-group row">
                          <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                          <div class="col-md-6">
                              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email',$user->email) }}" required autocomplete="email">

                              @error('email')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                              @enderror
                          </div>
                      </div>

                      <div class="form-group row">
                          <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>

                          <div class="col-md-6">
                              <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone',$user->phone) }}" autocomplete="phone" autofocus>

                              @error('phone')
                              <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                              @enderror
                          </div>
                      </div>
                      <div class="form-group row">
                          <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>

                          <div class="col-md-6">
                            <select name="role" id="role" class="form-control @error('role') is-invalid @enderror" autofocus>
                              <option value="">-Select Role-</option>
                              <option @if(old('role',$user->role)=='Admin') selected @endif value="Admin">Admin</option>
                              <option @if(old('role',$user->role)=='Regular') selected @endif value="Regular">Regular</option>
                            </select>
                              @error('role')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                              @enderror
                          </div>
                      </div>

                      <div class="form-group row">
                          <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>

                          <div class="col-md-6">
                            <select name="status" required id="status" class="form-control @error('status') is-invalid @enderror" autofocus>
                              <option value="">-Select Status-</option>
                              <option @if(old('status',$user->status)=='Active') selected @endif value="Active">Active</option>
                              <option @if(old('status',$user->status)=='Inactive') selected @endif value="Inactive">Inactive</option>
                              <option @if(old('status',$user->status)=='Pending') selected @endif value="Pending">Pending</option>
                              <option @if(old('status',$user->status)=='Banned') selected @endif value="Banned">Banned</option>
                            </select>
                              @error('status')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                              @enderror
                          </div>
                      </div>

                      <div class="form-group row">
                          <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                          <div class="col-md-6">
                              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
                              @error('password')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                              @enderror
                          </div>
                      </div>

                      <div class="form-group row">
                          <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                          <div class="col-md-6">
                              <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                          </div>
                      </div>
                      <div class="form-group row m-t-30 m-b-0">
                          <div class="col-12 text-center">
                               <button style="width: 20%;" class="btn btn-primary btn-block btn-lg waves-effect waves-light" type="submit">{{ __('Register') }}</button>
                          </div>
                      </div>
                  </form>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

@endsection
@section('footerScripts')
    @parent
  

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
