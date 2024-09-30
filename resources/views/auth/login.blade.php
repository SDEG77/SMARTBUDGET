<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <title>SmartBudget - Login</title>
</head>
<body>
    <div class="container"> 
        <h2>Login</h2>
        <form id="login-form" action="{{route('login.store')}}" method="POST">
            @csrf

            <input type="email" name="email" placeholder="Email" required>

            <!-- Password Error -->
            <x-input-error :err="'password'"></x-input-error>
            <input type="password" name="password" placeholder="Password" required style="{{ $errors->has('password') ? 'border: solid 1px red' : '' }}">

            <a href="{{ route('forgot.page') }}">Forgot Password?</a>
            <button type="submit">Login</button>
        </form>

        <div class="signup-link">
            <p>Don't have an account? <a href="{{ route('register') }}">Sign Up</a></p>
        </div>
    </div> 

    <!-- Hidden pop-up container -->
    {{-- <div class="popup" id="success-popup" style="display: none;">
        <div class="popup-content">
        <i class="fa-solid fa-circle-check"></i>
            <h2>AWESOME!</h2>
            <p>You are now ready to proceed to SmartBudget</p>
            <button onclick="closePopup()">Login Now</button>
        </div>
    </div> --}}
</body>
</html>

{{-- <script>
    document.getElementById('login-form').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the form from submitting

        // Simulate form submission success and show the pop-up
        document.getElementById('success-popup').style.display = 'flex'; 
    });

    function closePopup() {
        document.getElementById('success-popup').style.display = 'none';
        this.closest("form").submit()
        window.location.href = "{{ url('dashboard') }}"; // Redirect to the dashboard
    }
</script> --}}