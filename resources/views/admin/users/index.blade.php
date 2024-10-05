<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin/users.css') }}">
    <title>SmartBudget</title>
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
                        <span class="label">Users Management</span>
                    </a>
                </li>

                <!-- Course Management -->
                <li class="{{ Route::is('admin.courses.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.courses.index') }}">
                        <span class="label">Course Management</span>
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
                        <i class="fa-solid fa-right-from-bracket" alt="Logout Icon"></i>
                            LOG OUT
                        </button>
                    </form>
                </li>
            </ul>
        </div>

        <div class="main-content">
        <div class="content">
    <h1>ADMIN USERS INDEX PAGE</h1>

    <table style="width: 100%; font-size: 18px; text-align: left; border-collapse: collapse;">
    <thead>
        <tr>
            <th style="padding: 10px;">NAME</th>
            <th style="padding: 10px;">SCHOOL NAME</th>
            <th style="padding: 10px;">OPERATIONS</th>
        </tr>
    </thead> 
    <tbody>
        @if($users)
            @foreach ($users as $user)
                @if ($user->is_admin)
                    @continue
                @endif
                <tr style="border-bottom: none;">
                    <!-- Display Full Name and Email in the first column -->
                    <td style="padding: 15px; border-right: none;">
                        <strong>{{ $user->name }}</strong><br>
                        {{ $user->email }}
                    </td>

                    <!-- Display School Name and Course in the second column -->
                    <td style="padding: 15px; border-right: none;">
                        <strong>{{ $user->school_name }}</strong><br>
                        <span style="color: #888;">{{ $user->course }}</span>
                    </td>

                    <!-- Operations Column for Deleting a User -->
                    <td style="padding: 15px;">
                        <form action="{{ route('admin.users.delete', $user->id) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <input type="hidden" value="{{ $user->id }}" name="id">
                            <button type="submit" style="padding: 5px 10px; background-color: red; color: white; border: none; border-radius: 5px;">
                                DELETE
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>


    <a href="{{ route('admin.index') }}" style="font-size: 20px">Back to Admin Portal Page</a>
    </div>
</div>
</body>
</html>