<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/admin/courses.css') }}">
    <title>SmartBudget</title>
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

        <div class="main-content">
            <div class="content">
                <h1>ADMIN COURSES INDEX PAGE</h1>

                <table border="1" style="font-size: 20px; text-align: center; width: 100%;">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Course Name</th>
                            <th colspan="100">Operations</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($courses)
                            @foreach ($courses as $course)
                                <tr>
                                    <td>{{ $course->id }}</td>
                                    <td>{{ $course->course }}</td>
                                    <td>
                                        <a href="{{ route('admin.courses.edit', $course->id) }}">EDIT</a>
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.courses.delete', $course->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit">DELETE</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="100">
                                <a href="{{ route('admin.courses.create') }}">Add Course</a>
                            </td>
                        </tr>
                    </tfoot>
                </table>

                <a href="{{ route('admin.index') }}" style="font-size: 20px;">Back to Admin Portal Page</a>
            </div>
        </div>
    </div>
</body>
</html>
