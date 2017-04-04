<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mailers\AppMailer;
use App\Category;
use App\Ticket;


class AgentController extends Controller{
    
    public function tickets(){
	    $tickets = Ticket::where('agent_id', Auth::user()->id)->paginate(10);
	    $categories = Category::all();
	    return view('tickets.agent_tickets', compact('tickets', 'categories'));
  	}

  	public function close($ticket_id, AppMailer $mailer){
	    $ticket = Ticket::where('ticket_id', $ticket_id)->firstOrFail();
	    $ticket->status = 'Closed';
	    $ticket->save();
	    $ticketOwner = $ticket->user;
	    $mailer->sendTicketStatusNotification($ticketOwner, $ticket);
	    return redirect()->back()->with("status", "The ticket has been closed.");
  }

}
