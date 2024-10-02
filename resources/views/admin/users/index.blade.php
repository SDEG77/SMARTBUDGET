<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SmartBudget</title>
</head>
<body>
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
</body>
</html>