<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="asset/style.css">
    <title><?= isset($title) ? $title : '' ?></title>
</head>
<body>
    <h1><?= isset($title) ? $title : '' ?></h1>
    <form action="create.php" method="get">
        <input type="submit" value="Create New List To Do" class="create">
    </form>
    <table border="1" style="margin: 20px 0px;">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>State</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th colspan="2">Opsi</th>
        </tr>
        <!-- Mulai engga kebaca  24-47-->
        <?php if (!empty($data_from_database)): ?> 
            <?php foreach ($data_from_database as $row): ?>
                <tr>
                    <td><?= $row['id']; ?></td>
                    <td><?= $row['title']; ?></td>
                    <td><?= $db->state($row['state']); ?></td> 
                    <td><?= $row['created_at']; ?></td>
                    <td><?= $row['updated_at']; ?></td>
                    <td><form action="update.view.php" method="get">
                        <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>" />
                        <input type="hidden" name="id" value="<?= $row['id']; ?>">
                        <input type="submit" value="Update" class="update">
                    </form>
                    </td>
                    <td><form action="delete.view.php" method="get">
                        <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>" />
                        <input type="hidden" name="id" value="<?= $row['id']; ?>">
                        <input type="submit" value="Delete" class="delete">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>

    <form action="logout.php" method="post">
        <input type="submit" value="Logout" class="logout">
    </form>
</body>
</html>