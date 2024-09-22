<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/.css') }}">
    <title>Forgot Password</title>
</head>
<style>
    /* General Form Styles */
    body {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;

    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}
    form {
        margin: 0 auto;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        max-width: 400px;
        font-family: Arial, sans-serif;
        text-align: center;
        width: 100%;
    }

    /* Label Styling */
    label {
        display: block;
        font-weight: bold;
        margin-bottom: 10px;
        color: #333;
    }

    /* Input Field Styling */
    input[type="email"], input[type="password"] {
        width: 80%;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 10px;
        margin-bottom: 20px;
        box-sizing: border-box;
        transition: border-color 0.3s ease;
        font-size: 16px;
    }

    /* Input Hover and Focus States */
    input[type="email"]:focus, input[type="password"]:focus {
        border-color: #4CAF50;
        outline: none;
    }

    /* Button Styling */
    button {
        width: 80%;
        padding: 10px;
        background-color: #4CAF50;
        color: white;
        font-size: 16px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        margin-bottom: 20px;
    }

    /* Button Hover State */
    button:hover {
        background-color: #45a049;
    }

    /* H2 Heading Styling */
    h2 {
        text-align: center;
        font-size: 24px;
        margin-bottom: 20px;
        color: #333;
    }
#forgot-password p{
    margin-top: -10px;
    font-size: 13px;
}
.login-link p{
    
}
    /* Responsive Layout */
    @media (max-width: 480px) {
        form {
            padding: 15px;
            max-width: 100%;
        }

        input[type="email"], input[type="password"], button {
            font-size: 14px;
            padding: 10px;
        }
    }
</style>
<body>

<div id="forgot-password-form">
    <form id="forgot-password">
        <h2>FORGOT PASSWORD?</h2>
        <p>Enter Email Address to verify if it’s you!</p>
        <input type="email" id="email" name="email" placeholder="Email Address" required>
        
        <!-- 'Verify' button added below input -->
        <button type="button" onclick="redirectToCreatePassword()">Verify</button>

        <div class="login-link">
            <p>Go back to login <a href="{{ route('login') }}">Log In</a></p>
        </div>
    </form>
</div>

</body>
<script>
   function redirectToCreatePassword() {
    window.location.href = "{{ route('createPass') }}"; // Redirect to the Laravel route
}
</script>

</html>
