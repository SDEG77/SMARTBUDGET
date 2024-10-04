<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SmartBudget</title>
</head>
<body>
<form action="{{ route('admin.courses.store') }}" method="POST">
    @csrf
    <label for="course">Course:</label>
    <input type="text" name="course" required>

    <button type="submit">Add Course</button>
</form>

</body>
</html>