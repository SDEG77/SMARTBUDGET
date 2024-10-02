<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SmartBudget</title>
</head>
<body>
    <h1>ADMIN COURSES INDEX PAGE</h1>

    <table border="1" style="font-size: 20px;text-align:center">
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

    <a href="{{ route('admin.index') }}" style="font-size: 20px">Back to Admin Portal Page</a>
</body>
</html>