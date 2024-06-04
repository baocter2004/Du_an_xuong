<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Người DÙng</title>
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container">
        <h1>Chi Tiết User : <?=$user['name']?></h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Trường dữ liệu</th>
                    <th>Giá Trị</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($user as $field => $value) : ?>
                    <tr>
                        <td><?= $field ?></td>
                        <td><?= $value ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>