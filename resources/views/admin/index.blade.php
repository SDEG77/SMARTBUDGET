<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SmartBudget</title>
</head>
<body>
    <h1>ADMIN PORTAL PAGE</h1>

    <a href="{{ route('admin.users.index') }}">Users</a>
    <a href="{{ route('admin.category.index') }}">Category Management</a>
    <a href="{{ route('admin.courses.index') }}">Course Management</a>
</body>
</html>