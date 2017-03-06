@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="container">
  <div class="row">
    <div class="panel panel-default">
      <div class="panel-body">
        <div class="container-fluid " >
          <div class="col-lg-4 col-xs-6">
            <div  class="small-box bg-aqua">
              <div class="icon">
                <i class="fa fa-th"></i>
              </div>
              <div class="inner" >
                <h3>{{$total_user}}</h3>
              @if (Auth::user()->rol==1)
                <p>All Tickets</p>
              @else
                <p>All my tickets sent</p>
              @endif
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-xs-6">  
            <div id="open_t" class="small-box bg-red">
              <div class="icon">
                <i class="fa  fa-wrench"></i>
              </div>                 
              <div class="inner">
                <h3>{{$opentickets_user}}</h3>
                <p>Pending Ticktes</p>
              </div>
            </div>
          </div> 
          <div class="col-lg-4 col-xs-6">
            <div id="close_t" class="small-box bg-green">
              <div class="icon">
                <i class="fa  fa-check-circle "></i>
              </div>            
              <div class="inner">
                <h3>{{$closetickets_user}}</h3>
                <p>Completed Ticktes</p>
              </div>
            </div>
          </div>
        </div>
 
      </div>
    </div>
  </div>
</div>

<section style="display: none;" id="table_open" class="content">
  <div class="col-md-10 col-md-offset-1">
    <div class="box">
      <div class="box-header with-border"><h3 class="box-title">Tickets</h3></div>
      <div class="box-body">
        @if ($tickets_closed->isEmpty())
          <p>You don't have completed tickets.</p>
        @else
          <table class="table table-bordered">
            <tr>
              <th style="text-align:center">Category</th>
              <th style="text-align:center">Title</th>
              <th style="text-align:center">Status</th>
              <th style="text-align:center" >Last Updated</th>
              <th style="text-align:center" colspan="2">Actions</th>
            </tr>
            @foreach ($tickets_closed as $ticket)
              <tr>
                <td>
                  @foreach ($categories as $category)
                    @if ($category->id === $ticket->category_id)
                      {{ $category->name }}
                    @endif
                  @endforeach
                </td>                 
                <td>
                  <a href="{{ url('tickets/'. $ticket->ticket_id) }}">
                    #{{ $ticket->ticket_id }} - {{ $ticket->title }}
                  </a>
                </td>
                <td>
                  @if ($ticket->status === 'Open')
                    <span class="btn btn-block btn-success btn-xs">{{ $ticket->status }}</span>
                  @else
                    <span class="btn btn-block btn-danger btn-xs">{{ $ticket->status }}</span>
                  @endif
                </td>
                <td  align="center" >{{ $ticket->updated_at }}</td>

                @if (Auth::user()->rol==1)
                  <td  align="center">
                    <a href="{{ url('tickets/' . $ticket->ticket_id) }}"  class="btn btn-primary">Comment</a>
                  </td>
                  @if ($ticket->status !== 'Closed')
                    <td>
                      <form   align="center"  action="{{ url('admin/close_ticket/' . $ticket->ticket_id) }}" method="POST">
                      {!! csrf_field() !!}
                        <button type="submit" class="btn btn-danger">Close</button>
                      </form>
                    </td>
                  @endif
                @endif

              </tr>
            @endforeach
          </table>
        @endif
      </div>
    </div>
  </div>
</section>

<section style="display: none;" id="table_closed" class="content">
  <div class="col-md-10 col-md-offset-1">
    <div class="box">
      <div class="box-header with-border"><h3 class="box-title">Tickets</h3></div>
      <div class="box-body">
        @if ($tickets_open->isEmpty())
          <p>You don't have pending tickets.</p>
        @else
          <table class="table table-bordered">
            <tr>
              <th style="text-align:center">Category</th>
              <th style="text-align:center">Title</th>
              <th style="text-align:center">Status</th>
              <th style="text-align:center" >Last Updated</th>
              <th style="text-align:center" colspan="2">Actions</th>
            </tr>
            @foreach ($tickets_open as $ticket)
              <tr>
                <td>
                  @foreach ($categories as $category)
                    @if ($category->id === $ticket->category_id)
                      {{ $category->name }}
                    @endif
                  @endforeach
                </td>                 
                <td>
                  <a href="{{ url('tickets/'. $ticket->ticket_id) }}">
                    #{{ $ticket->ticket_id }} - {{ $ticket->title }}
                  </a>
                </td>
                <td>
                  @if ($ticket->status === 'Open')
                    <span class="btn btn-block btn-success btn-xs">{{ $ticket->status }}</span>
                  @else
                    <span class="btn btn-block btn-danger btn-xs">{{ $ticket->status }}</span>
                  @endif
                </td>
                <td  align="center" >{{ $ticket->updated_at }}</td>

                @if (Auth::user()->rol==1)
                  <td  align="center">
                    <a href="{{ url('tickets/' . $ticket->ticket_id) }}"  class="btn btn-primary">Comment</a>
                  </td>
                  @if ($ticket->status !== 'Closed')
                    <td>
                      <form   align="center"  action="{{ url('admin/close_ticket/' . $ticket->ticket_id) }}" method="POST">
                      {!! csrf_field() !!}
                        <button type="submit" class="btn btn-danger">Close</button>
                      </form>
                    </td>
                  @endif
                @endif

              </tr>
            @endforeach
          </table>
        @endif
      </div>
    </div>
  </div>
</section>

@endsection