<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Ticket;
use App\User;
use App\Mailers\AppMailer;
use Illuminate\Support\Facades\Auth;

class TicketsController extends Controller{
  public function __construct(){
    $this->middleware('auth');
  }


  public function create(){
    $categories = Category::all();
    return view('tickets.create', compact('categories'));
  }

  public function userTickets(){
    $tickets = Ticket::where('user_id', Auth::user()->id)->paginate(10);
    $categories = Category::all();
    return view('tickets.user_tickets', compact('tickets', 'categories'));
  }

  public function show($ticket_id){
    $users    = User::where('rol', 2)->paginate(10);
    
    $ticket   = Ticket::where('ticket_id', $ticket_id)->firstOrFail();
    $comments = $ticket->comments;
    $category = $ticket->category;
    return view('tickets.show', compact('ticket', 'users', 'category', 'comments'));
  }

  public function index(){
    $tickets = Ticket::paginate(10);
    $categories = Category::all();
    return view('tickets.index', compact('tickets', 'categories'));
  }

  public function AllTickets(){
    if (Auth::user()->rol==1) {
      $opentickets_user = Ticket::where('status', 'Open')->count();
      $closetickets_user = Ticket::where('status', 'Closed')->count();
      $total_user = $closetickets_user + $opentickets_user;
            
      $tickets_closed = Ticket::where('status', 'Closed')->paginate(10);
      $tickets_open = Ticket::where('status', 'Open')->paginate(10);
    }else{
      $opentickets_user = Ticket::where([['user_id', Auth::user()->id],['status', 'Open']])->count();
      $closetickets_user = Ticket::where([['user_id', Auth::user()->id],['status', 'Closed']])->count();
      $total_user = $closetickets_user + $opentickets_user;
            
      $tickets_closed = Ticket::where([['user_id', Auth::user()->id],['status', 'Closed']])->paginate(10);
      $tickets_open = Ticket::where([['user_id', Auth::user()->id],['status', 'Open']])->paginate(10);
    }

    $categories = Category::all();

   return view('home', compact('closetickets_user', 'opentickets_user', 'total_user', 'categories', 'tickets_closed','tickets_open'));
  }

  public function close($ticket_id, AppMailer $mailer){
    $ticket = Ticket::where('ticket_id', $ticket_id)->firstOrFail();
    $ticket->status = 'Closed';
    $ticket->save();
    $ticketOwner = $ticket->user;
    $mailer->sendTicketStatusNotification($ticketOwner, $ticket);
    return redirect()->back()->with("status", "The ticket has been closed.");
  }

  public function store(Request $request, AppMailer $mailer){
    $this->validate($request, [
      'title'     => 'required',
      'category'  => 'required',
      'priority'  => 'required',
      'message'   => 'required'
    ]);

    $ticket = new Ticket([
      'title'     => $request->input('title'),
      'user_id'   => Auth::user()->id,
      'ticket_id' => strtoupper(str_random(10)),
      'category_id'  => $request->input('category'),
      'priority'  => $request->input('priority'),
      'message'   => $request->input('message'),
      'status'    => "Open",
    ]);

    $ticket->save();

    $mailer->sendTicketInformation(Auth::user(), $ticket);

    return redirect()->back()->with("status", "A ticket with ID: #$ticket->ticket_id has been opened.");
  }

}
