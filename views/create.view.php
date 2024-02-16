<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create To Do</title>
    <link rel="stylesheet" href="asset/style.css">
</head>
<body>
    <h1>New Todo</h1>
    <form method="post" action="create">
    <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>" />
    <div>
        <label>Title</label>
        <input type="text" name="title" required>
    </div>
    <br>
    <div><input type="submit" value="Add" class="create"></div>
    </form>
</body>
</html>