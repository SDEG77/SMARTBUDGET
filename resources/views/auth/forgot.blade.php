<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/.css') }}">
    <link rel="stylesheet" href="{{ asset('css/forgot.css') }}">
    <title>Forgot Password</title>
</head>
<body>

<div id="forgot-password-form">
    <form id="forgot-password" action="{{ route('forgot') }}" method="POST">
        @csrf

        <h2>FORGOT PASSWORD?</h2>
        <p>Enter Email Address to verify if it's you!</p>
        <input type="email" id="email" name="email" placeholder="Email Address" required>
        
        <!-- 'Verify' button added below input -->
        <button type="submit">Verify</button>

        <div class="login-link">
            <p>Go back to login <a href="{{ route('login') }}">Log In</a></p>
        </div>
    </form>
</div>

</body>
</html>
