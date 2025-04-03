@extends('layouts.app')
@section('title')
    
@endsection
@section('content')
    

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            text-align: center;
            padding: 50px;
            background-color: #f4f7fb;
        }
        .message {
            padding: 30px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #2c3e50;
        }
        .btn {
            padding: 10px 20px;
            background-color: #3490dc;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
        }
    </style>
</head>
<body>

    <div class="message">
        <h1>Verify Your Email Address</h1>
        <p>Before proceeding, please check your email for a verification link.</p>
        <p>If you did not receive the email, click the button below to request another one.</p>
        <form method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <button type="submit" class="btn">Resend Verification Email</button>
        </form>
    </div>
    @endsection


