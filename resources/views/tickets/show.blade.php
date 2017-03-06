@extends('layouts.app')

@section('title', $ticket->title)

@section('content')

<div class="col-md-10 col-md-offset-1">
  <div class="panel panel-default">
    <div class="panel-heading">#{{ $ticket->ticket_id }} - {{ $ticket->title }}</div>
    <div class="panel-body">
      @include('includes.flash')
      <section >
        <div class="row">
          <div class="col-md-6">
            <form role="form">
             <div class="ticket-info">
                <p class="lead">Category: {{ $category->name }}</p>
                <p class="lead">
                @if ($ticket->status === 'Open')
                  Status: <span class="label label-success">{{ $ticket->status }}</span>
                @else
                  Status: <span class="label label-danger">{{ $ticket->status }}</span>
                @endif
                </p>
                <p class="lead">Created on: {{ $ticket->created_at->diffForHumans() }}</p> 
                <p class="lead"> Message</p>   
                <h5 class="col-md-offset-1">{{ $ticket->message }}</h5>
              </div>
            </form>
          </div>
          @if (Auth::user()->rol==1)
            <div class="col-md-6">
              <form class="form-horizontal" action="{{ url('admin/close_ticket/' . $ticket->ticket_id) }}" method="POST">
              {!! csrf_field() !!}
                <div class="box-body">
                  <div class="form-group{{ $errors->has('user') ? ' has-error' : '' }}">
                    <p>Assign to: 
                    <select style="width: 250px;" id="user" type="user" class="form-control" name="user">
                      @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                      @endforeach
                    </select>
                    </p>
                    @if ($errors->has('user'))
                      <span class="help-block">
                        <strong>{{ $errors->first('user') }}</strong>
                      </span>
                    @endif
                  </div>
                </div>                    
              </form>
            </div>
          </div>
        @endif
      </section>

      <hr>

      <div class="col-md-12">
        <div class="direct-chat-primary">
          <div class="box-body">
            <div class="direct-chat-messages">
              @foreach ($comments as $comment)
                @if($ticket->user->id === $comment->user_id) 
                <div class="direct-chat-msg">
                  <div class="direct-chat-info clearfix">
                    <span class="direct-chat-name pull-left"> {{ $comment->user->name }}</span>
                    <span class="direct-chat-timestamp pull-right">{{ $comment->created_at->format('Y-m-d') }}</span>
                  </div>
                  <img class="direct-chat-img" src="../dist/img/user.png" alt="Message User Image">

                  <div class="direct-chat-text">
                     {{ $comment->comment }} 
                  </div>
                </div>
                @else
                <div class="direct-chat-msg right">
                  <div class="direct-chat-info clearfix">
                    <span class="direct-chat-name pull-right"> {{ $comment->user->name }}</span>
                    <span class="direct-chat-timestamp pull-left">{{$comment->created_at->format('Y-m-d')}}</span>
                  </div>
                  <img class="direct-chat-img" src="../dist/img/support.png" alt="Message User Image">
                  <div class="direct-chat-text" >
                     {{ $comment->comment }} 
                  </div>
                </div>
                @endif
              @endforeach
            </div>
          </div>
        </div>
      </div>

      <div class="comment-form">
        <form action="{{ url('comment') }}" method="POST" class="form">
          {!! csrf_field() !!}
          <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
          <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
            <textarea rows="10" id="comment" class="form-control" name="comment"></textarea>
            @if ($errors->has('comment'))
              <span class="help-block">
                <strong>{{ $errors->first('comment') }}</strong>
              </span>
            @endif
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection