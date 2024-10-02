<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SmartBudget</title>
</head>
<body>
    <h1>ADMIN CATEGORIES INDEX PAGE</h1>

    <table border="1" style="font-size: 20px;text-align:center">
        <thead>
            <tr>
                <th>ID</th>
                <th>Mode</th>
                <th>Category</th>
                <th colspan="100">Operations</th>
            </tr>
        </thead>
        <tbody>
            @if($categories)
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->mode }}</td>
                        <td>{{ $category->category }}</td>
                        <td>
                            <a href="{{ route('admin.category.edit') }}">EDIT</a>
                        </td>
                        <td>
                            <form action="/" method="POST">
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
                    <a href="{{ route('admin.category.create') }}">Add Category</a>
                </td>
            </tr>
        </tfoot>
    </table>

    <a href="{{ route('admin.index') }}" style="font-size: 20px">Back to Admin Portal Page</a>
</body>
</html>