  @extends('layouts.app')

@section('title', 'Detail of ticket')

@section('content')
  <link rel="stylesheet" href="/css/show.css">

<div class="col-md-10 col-md-offset-1">
  <div class="panel panel-default">
    <div class="panel-heading">#{{ $ticket->ticket_id }} - {{ $ticket->title }}</div>
    <div class="panel-body">
      @include('includes.flash')
       <div class="row">
        <fieldset class="for-panel">
          <legend>Ticket Info</legend>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-horizontal">               
                <label class="col-xs-5 control-label">Category:</label>
                <p class="form-control-static">{{ $category->name }}</p>               
               
                <label class="col-xs-5 control-label">Status: </label>
                @if ($ticket->status === 'Open')
                  <p class="form-control-static">{{ $ticket->status }}</p>
                @else
                  <p class="form-control-static">{{ $ticket->status }}</p>
                @endif
                            
                <label class="col-xs-5 control-label">Created on:</label>
                <p class="form-control-static">{{ $ticket->created_at->diffForHumans() }}</p>     

                <label class="col-xs-5 control-label">SLA:</label>
                <p class="form-control-static">{{ $ticket->sla }}</p> 
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-horizontal">               
                <label class="col-xs-4 control-label">Priority: </label>
                <p class="form-control-static">{{ $ticket->priority }}</p>             
                             
                <label class="col-xs-4 control-label">Archive:</label>
                @if (is_null($ticket->doc_path))
                  <p class="form-control-static">
                    <button class="btn btn-default btn-flat disabled" href="/storage/{{$ticket->doc_path}}">
                      <i class="fa fa-file fa-lg"></i> {{$ticket->doc_path}}
                    </button>
                  </p>
                @else
                  <p class="form-control-static">
                    <a class="btn btn-default btn-flat" href="/storage/{{$ticket->doc_path}}">
                      <i class="fa fa-file fa-lg"></i> {{$ticket->doc_path}}
                    </a>
                  </p>
                @endif

                <label class="col-xs-4 control-label">Message:</label>
                <p class="form-control-static">{{ $ticket->message }}</p>                        
              </div>
            </div>
          </div>
        </fieldset>
      </div>
      @if (Auth::user()->rol==1)
        <hr>
        <div class="row">
          <form class="form-horizontal" action="{{url('admin/update/'.$ticket->ticket_id)}}" method="POST">
          {!! csrf_field() !!}
          <fieldset class="for-panel">
              <div class="col-sm-6">
                <div class="form-horizontal">               
                  <p class="form-control-static{{ $errors->has('agent_id') ? ' has-error' : '' }}">
                  <label class="col-xs-2 control-label">Agent:</label>
                    <select style="width: 250px;" id="agent_id" class="control" type="agent_id" name="agent_id">
                      @foreach ($users as $agent_id)
                        <option value="{{ $agent_id->id }}">{{ $agent_id->name }}</option>
                      @endforeach
                    </select>         
                    @if ($errors->has('agent_id'))
                      <span class="help-block">
                        <strong>{{ $errors->first('agent_id') }}</strong>
                      </span>
                    @endif
                  </p>                              
                </div>
              </div>
              <div class="col-sm-5">
                <div class="form-horizontal">               
                  <p class="form-control-static">
                  <label class="col-xs-2 control-label">SLA: </label>
                    <a class='input-group date' id='datetimepicker1' name="datetimepicker1">
                      <input id='sla' name='sla' type='text' value="{{ $ticket->sla }}" class="control" required="" />
                      <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                      </span>
                    </a>
                  </p>                                
                </div>
              </div>
            <div class="pull-right"> 
                <button type="submit" class="btn btn-block btn-default btn-flat">UPDATE</button>          
            </div>
          </fieldset>
         </form>
        </div>
       @endif  

      <hr>
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

