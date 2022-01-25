<?php session_start(); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php include "views/layout/header.php"?>
<div class="col-md-12">
    <div class="panel-heading"><b>List of administrators</b></div>
    <?php if (isset($data['alert-success'])) echo "<h4 class='alert-success bg-green'>{$data['alert-success']}</h4>"; ?>

</div>
<div class="panel-body">
    <table class="table table-bordered table-hover">
        <tr>
            <th style="width: 100px;">Id</th>
            <th style="width: 100px;">Avatar</th>
            <th>Name</th>
            <th style="width: 100px;">Email</th>
            <th style="width: 50px;">Role</th>
            <th style="width:100px;"></th>
        </tr>
        <?php
        foreach($data as $rows):
            ?>
            <tr>
                <td><?php echo $rows['id']; ?></td>
                <td>
                    <?php if($rows['avatar']!="" && file_exists("assets/upload/admin/".$rows['avatar'])): ?>
                        <img src="assets/upload/admin/<?php echo $rows['avatar']; ?>" style="width: 100px;" alt="" srcset="">
                    <?php endif; ?>
                </td>
                <td><?php echo $rows['name']; ?></td>
                <td><?php echo $rows['email']; ?></td>
                <td style="text-align: center;">
                    <?php if(isset($rows['role_type'])&&$rows['role_type'] == 1): ?>
                        <span >Super admin</span>
                    <?php else: ?>
                        <span>Admin</span>

                    <?php endif; ?>
                </td>
                <td style="text-align:center; width: 200px;">
                    <a href="index.php?controller=admin&action=update&id=<?php echo $rows['id']; ?>" class="btn btn-success">Edit</a>&nbsp;
                    <a href="index.php?controller=admin&action=delete&id=<?php echo $rows['id']; ?>" onclick="return window.confirm('Are you sure?');" class="btn btn-warning">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

</div>
<style type="text/css">
    .pagination{padding:0px; margin:0px;}
</style>
<ul class="pagination">
    <li class="page-item"><a href="#" class="page-link">Page</a></li>
    <?php for($i = 1; $i <= $numPage; $i++): ?>
        <li class="page-item"><a href="index.php?controller=admin&action=index&page=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a></li>
    <?php endfor; ?>
</ul>
</body>
</html>