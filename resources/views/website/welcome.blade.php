<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    
    <title>Welcome</title>
    
</head>


<body>
    <div class="main-content">
      <div class="header">Master Your Money,Achieve Your Goals</div>
      <div class="text">
        Welcome to SmartBudget, the ultimate tool for students to take charge of their finances. 
        Our platform is designed to help you manage your budget effortlessly, track your expenses, and save for what matters most. 
      From textbooks to weekend plans, SmartBudget makes it easy to balance your budget and reach your financial goals. </div>

      <div class="button-container">
        <div class="buttons">
            <a href="{{ route('login') }}"class="login-button">LOGIN</a>
            <a href="{{ route('register') }}" class="register-button">REGISTER</a>
        </div>
      </div>
    </div>
</body>
</html>
