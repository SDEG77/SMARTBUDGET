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
                <!-- Users Management -->
                <li class="{{ Route::is('admin.users.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.users.index') }}">
                        <span class="label">Users Management</span>
                    </a>
                </li>

                <!-- Course Management -->
                <li class="{{ Route::is('admin.courses.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.courses.index') }}">
                        <span class="label">Course Management</span>
                    </a>
                </li>

                <!-- Category Management -->
                <li class="{{ Route::is('admin.category.index') ? 'active' : '' }}">
                <a href="{{ route('admin.category.index') }}">
                <span class="label">Category Management</span>
                    </a>
                </li>
                
                <!-- Client Environment -->
                <li class="{{ Route::is('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}" class="client-env">
                        <span class="label">Test Client Environment</span>
                    </a>
                </li>

                <!-- Logout -->
                <li class="logout-form">
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" onclick="event.preventDefault(); this.closest('form').submit();">
                            LOG OUT OF ADMIN
                        </button>
                    </form>
                </li>
            </ul>
        </div>
</body>
</html>
