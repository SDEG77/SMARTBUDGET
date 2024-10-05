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
        <div class="sidebar">
            <h1>ADMIN PORTAL</h1>
            <ul class="menu-sidebar">
                 <!-- admin -->
                 <li class="{{ Route::is('admin.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.index') }}">
                        <span class="label">Dashboard</span>
                    </a>
                </li>

                <!-- Users Management -->
                <li class="{{ Route::is('admin.users.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.users.index') }}">
                        <span class="label">Accounts</span>
                    </a>
                </li>

                <!-- Course Management -->
                <li class="{{ Route::is('admin.courses.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.courses.index') }}">
                        <span class="label">Courses</span>
                    </a>
                </li>

                <!-- Client Environment -->
                <li class="{{ Route::is('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}" class="client-env">
                        <span class="label">SandBox</span>
                    </a>
                </li>

                <!-- Logout -->
                <li class="logout-form">
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" onclick="event.preventDefault(); this.closest('form').submit();">
                        <i class="fa-solid fa-right-from-bracket" alt="Logout Icon"></i>
                            Log Out
                        </button>
                    </form>
                </li>
            </ul>
        </div>
        <div class="main-content">
        <div class="content">
            <h1>Admin Dashboard</h1>
            
            <div class="result-frame">
                        <div class="result-item">
                            
                            <p3>Total Average Users</p3>
                        </div>
                        <div class="result-item">
                           
                            <p3>Total Income</p3>
                        </div>
                        <div class="result-item">
                           
                            <p3>Remaining Funds</p3>
                        </div>
                    </div>
                    </div>
                    </div>
        </div>
        </div>
</body>
</html>
