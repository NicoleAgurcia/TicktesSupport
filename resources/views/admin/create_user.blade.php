@extends('layouts.app')

@section('title', 'Create User')

@section('content')
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Create User</div>
        <div class="panel-body">
          @include('includes.flash')
          <form  class="form-horizontal" role="form" method="POST" action="{{ url('/admin/create') }} " >
            {{ csrf_field() }}
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
              <div class="col-md-8 col-md-offset-2">
                <input placeholder="Name" id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                @if ($errors->has('name'))
                  <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
              <div class="col-md-8 col-md-offset-2">
                <input placeholder="E-mail Address" id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                @if ($errors->has('email'))
                  <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group{{ $errors->has('rol') ? ' has-error' : '' }}">
              <div class="col-md-8 col-md-offset-2">
                <select id="rol" type="rol" class="form-control" name="rol">
                  <option value="">Select Role</option>
                  @foreach ($roles as $rol)
                    <option value="{{ $rol->role_id }}">{{ $rol->name }}</option>
                  @endforeach
                </select>
                @if ($errors->has('rol'))
                  <span class="help-block">
                    <strong>{{ $errors->first('rol') }}</strong>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
              <div class="col-md-8 col-md-offset-2">
                <input placeholder="Password" id="password" type="password" class="form-control" name="password" required>
                @if ($errors->has('password'))
                  <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-8 col-md-offset-2">
                <input placeholder="password-confirm" id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-8 col-md-offset-2">
                <button type="submit" class="btn btn-lg btn-block">
                  Register
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection







                  
    






