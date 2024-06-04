<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách User</title>
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container">
        <h1>Danh sách User</h1>

        <a href="<?= url('admin/users/create') ?>" class="btn btn-primary mt-4">Add New User</a>

        @if (isset($_SESSION['status']) && $_SESSION['status'])
            <div class="alert alert-success">
                {{ $_SESSION['msg'] }}
            </div>

            @php
                unset($_SESSION['status']);
                unset($_SESSION['msg']);
            @endphp
        @endif

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Email</th>
                    <th>Created at</th>
                    <th>Update at</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user) : ?>
                    <tr>
                        <td><?= $user['id'] ?></td>
                        <td><?= $user['name'] ?></td>
                        <td>
                        <img src="{{ asset($user['avatar']) }}" alt="" width="100px">
                        </td>
                        <td><?= $user['email'] ?></td>
                        <td><?= $user['created_at'] ?></td>
                        <td><?= $user['updated_at'] ?></td>
                        <td>
                            <a href="{{ url('admin/users/' . $user['id'] .  '/edit') }}" class="btn btn-info">edit</a>
                            <a href="{{ url('admin/users/' . $user['id'] .  '/delete') }}" onclick="return confirm('Chắc chắn xóa không?')" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>