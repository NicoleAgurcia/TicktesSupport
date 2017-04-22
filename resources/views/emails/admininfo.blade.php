<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Suppor Ticket Information</title>
</head>
<body>
      
    <p>
        A new ticket has been create by {{ ucfirst($ticketOwner->name) }}
    </p>

    <p>Title: {{ $ticket->title }}</p>
    <p>Priority: {{ $ticket->priority }}</p>
    <p>Status: {{ $ticket->status }}</p>

    <p>
        You can view the ticket at any time at {{ url('tickets/'. $ticket->ticket_id) }}
    </p>
</body>
</html>