<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Suppor Ticket Status</title>
</head>
<body>
    <p>
        Hello {{ ucfirst($ticketOwner->name) }},
    </p>
    <p>
        Your support ticket with ID #{{ $ticket->ticket_id }} must be resolved at {{$ticket->sla}} by one of our agents.
    </p>
</body>
</html>