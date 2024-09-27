<!DOCTYPE html>
<html>
<head>
    <title>Booking Confirmation</title>
</head>
<body>
    <h1>প্রিয় {{ $booking->user->name }},</h1>
    <p>আপনার বুকিংয়ের জন্য ধন্যবাদ। নিচে আপনার বুকিংয়ের বিবরণ দেওয়া হলো:</p>
    <ul>
        <li><strong>গাড়ি:</strong> {{ $booking->car->model }}</li>
        <li><strong>শুরুর তারিখ:</strong> {{ $booking->start_date }}</li>
        <li><strong>শেষ তারিখ:</strong> {{ $booking->end_date }}</li>
        <li><strong>মোট খরচ:</strong> ${{ $booking->total_cost }}</li>
    </ul>
    <p>আপনার যদি কোনো প্রশ্ন থাকে, অনুগ্রহ করে আমাদের সাথে যোগাযোগ করুন।</p>
    <p>ধন্যবাদ!</p>
</body>
</html>
