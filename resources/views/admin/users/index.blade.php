<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/admin/users.css') }}">
    <title>SmartBudget</title>
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

        <div class="main-content">
        <div class="content">
    <h1>ADMIN USERS INDEX PAGE</h1>

    <table border="1" style="font-size: 20px;text-align:center">
        <thead>
            <tr>
                <th>User Id</th>
                <th>Full Name</th>
                <th>Email Address</th>
                <th>School_name</th>
                <th>Course</th>
                <th>Operations</th>
            </tr>
        </thead>
        <tbody>
            @if($users)
                @foreach ($users as $user)
                    @if ($user->is_admin)
                        @continue
                    @endif
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->school_name }}</td>
                        <td>{{ $user->course }}</td>
                        <td>
                            <form action="{{ route('admin.users.delete', $user->id) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <input type="hidden" value="{{ $user->id }}" name="id">
                                <button type="submit">DELETE USER</button>
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