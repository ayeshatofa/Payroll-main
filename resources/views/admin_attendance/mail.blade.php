<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Request Notification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: auto;
        }
        h2 {
            color: #2c3e50;
            text-align: center;
        }
        p {
            color: #555;
            line-height: 1.6;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            color: #777;
            font-size: 12px;
        }
        .highlight {
            color: #e74c3c;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Leave Request Notification</h2>

        <p>Dear {{$user->name}},</p>

        <p>
            Your requested leave from 
            <span class="highlight">{{ \Carbon\Carbon::parse($startDate)->format('d M Y') }}</span> 
            to 
            <span class="highlight">{{ \Carbon\Carbon::parse($endDate)->format('d M Y') }}</span>
            has been approved.
        </p>

        <p>Best Regards,</p>
        <p>Ayesha Sultana Tofa</p>

        <div class="footer">
            <p>This is an auto-generated email. Please do not reply.</p>
        </div>
    </div>

</body>
</html>
