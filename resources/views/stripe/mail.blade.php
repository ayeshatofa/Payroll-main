<!doctype html>
<html lang="en">
  <head>
    <title>Salary Payment Confirmation</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Optional Bootstrap or inline styles for better compatibility -->
    <style>
      body {
        font-family: Arial, sans-serif;
        background-color: #f8f9fa;
      }
      .container {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
      }
      .btn {
        background-color: #007bff;
        color: white;
        padding: 10px 20px;
        text-decoration: none;
        border-radius: 5px;
      }
      .btn:hover {
        background-color: #0056b3;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <h1 class="text-center">Salary Received Confirmation</h1>
      <p>Dear {{ $user->name }},</p>
      <p>Your salary has been successfully transferred to your account. Below is the link to download the invoice of your salary for this month:</p>
      <a href="{{ url('/profile/' . $user->id . '/invoice') }}" class="btn">View Invoice</a>

      <p>Thank you for your service!</p>
      <p>Best Regards, <br> Payroll Team</p>
    </div>
  </body>
</html>
