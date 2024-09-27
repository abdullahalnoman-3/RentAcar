<!DOCTYPE html>
<html>
<head>
    <title>Booking Confirmation</title>
</head>
<body>
    <h1>Dear {{ $booking->user->name }},</h1>
    <p>Thank you for booking a car with us.</p>
    <p>Here are the details of your booking:</p>
    <ul>
        <li>Car: {{ $booking->car->model }}</li>
        <li>Start Date: {{ $booking->start_date }}</li>
        <li>End Date: {{ $booking->end_date }}</li>
        <li>Total Cost: ${{ $booking->total_cost }}</li>
    </ul>
    <p>If you have any questions, feel free to contact us.</p>
    <p>Thank you!</p>
</body>
</html>
