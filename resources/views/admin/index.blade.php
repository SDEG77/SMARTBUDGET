<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SmartBudget</title>
    <link rel="stylesheet" href="{{ asset('css/admin/admin.index.css') }}">
</head>
<body>
    <div class="container">
        <div class="side-nav">
            <h1>ADMIN PORTAL PAGE</h1>
            <div class="portal-btns">
                <a href="{{ route('admin.users.index') }}">Users Management</a>
                <a href="{{ route('admin.courses.index') }}">Course Management</a>
            </div>
            <a class="client-env" href="{{ route('dashboard') }}">Test Client Environment</a>
            
            <form class="logout-form" action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" onclick="event.preventDefault(); this.closest('form').submit();">
                    LOG OUT OF ADMIN
                </button>
            </form>
        </div>
    </div>
</body>
</html>
