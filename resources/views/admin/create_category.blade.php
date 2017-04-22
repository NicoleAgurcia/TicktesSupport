@extends('layouts.app')

@section('title', 'Create category')

@section('content')
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Detail</div>
        <div class="panel-body" style=" display: flex;justify-content: center;align-items: center; ">
          @include('includes.flash')
          <div class="col-lg-4">


            <table class="table table-bordered table-striped ">
              <tr>
                <th style="text-align:center">ID</th>
                <th style="text-align:center">Categories</th>
              </tr>
              @foreach ($category as $cat)
                <tr>
             
                  <td align="center">
                    <a>{{ $cat->id}} </a>
                  </td>
                   <td align="center">
                    <a>{{ $cat->name}} </a>
                  </td>
              
              @endforeach
            </table>
      </div>
        <div class="col-lg-4">
          <form  class="form-horizontal" role="form" method="POST" action="{{ url('/admin/category') }} " >
            {{ csrf_field() }}
            <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
              <div class="col-md-8 col-md-offset-2">
                <input placeholder="Insert a new category" id="category" type="text" class="form-control" name="category" value="{{ old('category') }}" required autofocus>
                @if ($errors->has('category'))
                  <span class="help-block">
                    <strong>{{ $errors->first('category') }}</strong>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-8 col-md-offset-2">
                <button type="submit" class="btn btn-lg btn-block">
                  Create
                </button>
              </div>
            </div>
          </form>
        </div>
        </div>
      </div>
    </div>
  </div>
@endsection







                  
    






