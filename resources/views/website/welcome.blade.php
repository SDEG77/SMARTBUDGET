<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <title>Welcome</title>
    
</head>
<style>
body{
  background-image: url('images/team.png');
  background-size: 100% 100%;
  background-repeat: no-repeat;
  height: 100vh;
  margin: 0;
  font-family: 'Poppins', sans-serif;
  color: #053A3D;
}
  
.buttons {
    position: fixed; /* Fixed position for floating effect */
    top:30%;
    margin-left: 30px;
    z-index: 10; /* Ensure it stays on top */
    gap:10%;
    background-color: ;
    justify-content: space-between;
    display: flex;

}

.register-button  {
    background:#053A3D;
    color: #fff;
    padding: 10px 50px;
    border-radius: 10px;
    text-decoration: none;
    font-size: 20px;
  }
.login-button  {
    background:white;
    color: black;
    padding: 10px 50px;
    border-radius: 10px;
    text-decoration: none;
    font-size: 20px;
    border:1px solid black;
}
.header{
  font-size: 40px;
  padding: 30px;
  font-weight: bold;
}
.text{
  width: 70%;
  margin-left: 30px;
  margin-top: -20px;
  font-size: 15px;
}
</style>

<body>
    <div class="main-content">
      <div class="header">Master Your Money,Achieve Your Goals</div>
      <div class="text">
        Welcome to SmartBudget, the ultimate tool for students to take charge of their finances. 
        Our platform is designed to help you manage your budget effortlessly, track your expenses, and save for what matters most. 
      From textbooks to weekend plans, SmartBudget makes it easy to balance your budget and reach your financial goals. </div>

      <div class="pic">
        <div class="buttons">
            <a href="{{ route('login') }}"class="login-button">LOGIN</a>
            <a href="{{ route('register') }}" class="register-button">REGISTER</a>
        </div>
      </div>
    </div>
</body>
</html>
