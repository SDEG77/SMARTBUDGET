<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SmartBudget</title>
</head>
<body>
    <form action="/" method="POST">
        @csrf
        <label for="course">Course:</label>
        <input type="text" name="course">
    
        <button type="submit">Add Course</button>
    </form>
    <div style="display: flex;gap:20px">
        <a href="{{ route('admin.courses.index') }}" style="font-size: 20px">Back to Admin Course Page</a>
        <a href="{{ route('admin.index') }}" style="font-size: 20px">Back to Admin Portal Page</a>
    </div>
</body>
</html>