<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SmartBudget</title>
</head>
<body>
    <form action="{{ route('admin.courses.update', $course->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="course">Course:</label>
        <input type="text" value="{{ old('course', $course->course) }}" name="course">
    
        <button type="submit">Edit Course</button>
    </form>
    <div style="display: flex;gap:20px">
        <a href="{{ route('admin.courses.index') }}" style="font-size: 20px">Back to Admin Course Page</a>
        <a href="{{ route('admin.index') }}" style="font-size: 20px">Back to Admin Portal Page</a>
    </div>
</body>
</html>