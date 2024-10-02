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
        @method('PUT')

        <select name="mode" id="mode">
            <option value="ingoing">Ingoing</option>
            <option value="outgoing">Outgoing</option>
        </select>

        <label for="category">Category:</label>
        <input type="text" name="category">
    
        <button type="submit">Edit Category</button>
    </form>
    <div style="display: flex;gap:20px">
        <a href="{{ route('admin.category.index') }}" style="font-size: 20px">Back to Admin Category Page</a>
        <a href="{{ route('admin.index') }}" style="font-size: 20px">Back to Admin Portal Page</a>
    </div>
</body>
</html>