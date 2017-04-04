@extends('layouts.app')

@section('title', 'All Tickets')

@section('content')
  <section class="content">
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
      <div class="box">
        <div class="box-header with-border"><h3 class="box-title">Tickets</h3></div>
        <div class="box-body">
          @if ($tickets->isEmpty())
            <p>You have not created any tickets.</p>
          @else
            <table class="table table-bordered">
              <tr>
                <th style="text-align:center">Category</th>
                <th style="text-align:center">Title</th>
                <th style="text-align:center">Status</th>
                <th style="text-align:center">Priority</th>
                <th style="text-align:center" >Last Updated</th>
              </tr>
              @foreach ($tickets as $ticket)
                <tr>
                  <td align="center">
                    @foreach ($categories as $category)
                      @if ($category->id === $ticket->category_id)
                        {{ $category->name }}
                      @endif
                    @endforeach
                  </td>
                  <td align="center">
                    <a href="{{ url('tickets/'. $ticket->ticket_id) }}">
                      #{{ $ticket->ticket_id }} - {{ $ticket->title }}
                    </a>
                  </td>
                  <td align="center">
                    @if ($ticket->status === 'Open')
                     <span class="btn btn-block btn-success btn-xs">{{ $ticket->status }}</span>
                    @else
                      <span class="btn btn-block btn-danger btn-xs">{{ $ticket->status }}</span>
                    @endif
                  </td>
                  <td align="center">{{ $ticket->priority }}</td>
                  <td align="center">{{ $ticket->updated_at }}</td>
                </tr>
              @endforeach
            </table>
            {{ $tickets->render() }}
          @endif
        </div>
      </div>
    </div>
  </section>
@endsection
