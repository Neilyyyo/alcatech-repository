<!DOCTYPE html>
<html>
<head>
    <title>Overdue Payment Reminder</title>
</head>
<body>
    <h3>Dear {{ $tenant->firstName }} {{ $tenant->lastName }},</h3>
    <p>We are sending you a reminder that your rent payment for the month is overdue. Please make the payment as soon as possible.</p>
    <p>Thank you for your attention to this matter.</p>
    <p>Regards,</p>
    <p>Your Property Management Team</p>
</body>
</html>
