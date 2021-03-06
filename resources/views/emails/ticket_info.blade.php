<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Suppor Ticket Information</title>
</head>
<body>
    <p>
        Thank you {{ ucfirst($user->name) }} for contacting our support team. A support ticket has been opened for you. You will be notified when a response is made by email. The details of your ticket are shown below:
    </p>

    <p>Title: {{ $ticket->title }}</p>
    <p>Priority: {{ $ticket->priority }}</p>
    <p>Status: {{ $ticket->status }}</p>

    <p>
        You can view the ticket at any time at {{ url('tickets/'. $ticket->ticket_id) }}
    </p>

     <h3>
        In a few minutes you're going to receive the time when your ticket will be solved (SLA)
    </h3>

</body>
</html>