<?php include "views/layout/header.php" ?>
<style>
    .form-inline {
        width: 800px;
        height: 200px;
        margin: 0 auto;
        border: 2px solid black;
        border-radius: 5px;
        margin-top: 10px;
        margin-bottom: 10px;
    }
</style>
<form method="POST" action="">
    <div class="form-inline">
        <input type="text" class="form-control" name="name"
               value="<?php echo isset($_POST['name']) ? $_POST['name'] : '' ?>" placeholder="Input your name"/>
        </br>
        <input type="text" class="form-control" name="email"
               value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>" placeholder="Input your email"/>
        <button class="btn btn-success" name="search">Search</button>
        <a href="index.php?controller=admin&action=search" class="btn btn-info">Reload</a>
    </div>
</form>
<?php

$con = new PDO('mysql:host=localhost;dbname=test_database', 'root', '');
if (isset($_POST['search'])) {
    ?>
    <table class="table table-bordered">
        <thead class="alert-info">
        <tr>
            <th>ID</th>
            <th>Avatar</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $name = $_POST['name'];
        $email = $_POST['email'];
        $query = $con->prepare("SELECT * FROM `admin` WHERE `name` LIKE '%$name' AND `email` LIKE '%$email%' ");
        $query->execute();
        while ($row = $query->fetch()) {
            ?>
            <tr>
                <td><?php echo $row['id'] ?></td>
                <td>
                    <img src="assets/upload/admin/<?php echo $row['avatar']; ?>" style="width: 100px;" alt="" srcset="">
                </td>
                <td><?php echo $row['name'] ?></td>
                <td><?php echo $row['email'] ?></td>
                <td> <?php if (isset($row['role_type']) && $row['role_type'] == 1): ?>
                        <span>Super admin</span>
                    <?php else: ?>
                        <span>Admin</span>
                    <?php endif; ?></td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
    <?php
} else {
    ?>
    <table class="table table-bordered">

        <tbody>
        <?php
        $orderBy = !empty($_GET["orderby"]) ? $_GET["orderby"] : "id";

        $order = !empty($_GET["order"]) ? $_GET["order"] : "desc";
        $query = $con->prepare("SELECT * FROM admin ORDER BY $orderBy $order");
        $query->execute();
        $nameOrder = "asc";
        $emailOrder = "asc";
        $idOrder = "asc";
        $roleOrder = "asc";

        if ($orderBy == "id" && $order == "asc") {
            $idOrder = "desc";
        }
        if ($orderBy == "name" && $order == "asc") {
            $nameOrder = "desc";
        }
        if ($orderBy == "email" && $order == "asc") {
            $emailOrder = "desc";
        }
        if ($orderBy == "role_type" && $order == "asc") {
            $roleOrder = "desc";
        }
        ?>
        <thead class="alert-info">
        <tr>
            <th> &nbsp;<a href="index.php?controller=admin&action=search&orderby=id&order=<?php echo $idOrder; ?>">ID</a>&nbsp;&nbsp;
                <i class="fas fa-sort-down"></i></i></th>
            <th>Avatar</th>
            <th><a href="index.php?controller=admin&action=search&orderby=name&order=<?php echo $nameOrder; ?>">Name</a>&nbsp;
            </th>
            <th>
                <a href="index.php?controller=admin&action=search&orderby=email&order=<?php echo $emailOrder; ?>">Email</a>&nbsp;
            </th>
            <th><a href="index.php?controller=admin&action=search&orderby=role_type&order=<?php echo $roleOrder; ?>">Role</a>
            </th>
            <th></th>
        </tr>
        </thead>
        <?php
        while ($row = $query->fetch()) {
            ?>
            <tr>
                <td><?php echo $row['id'] ?></td>
                <td>
                    <img src="assets/upload/admin/<?php echo $row['avatar']; ?>" style="width: 100px;" alt="" srcset="">
                </td>
                <td><?php echo $row['name'] ?></td>
                <td><?php echo $row['email'] ?></td>
                <td> <?php if (isset($row['role_type']) && $row['role_type'] == 1): ?>
                        <span>Super admin</span>
                    <?php else: ?>
                        <span>Admin</span>
                    <?php endif; ?></td>
                <td>
                    <a href="index.php?controller=admin&action=update&id=<?php echo $row['id']; ?>"
                       class="btn btn-success">S???a</a>&nbsp;
                    <a href="index.php?controller=admin&action=delete&id=<?php echo $row['id']; ?>"
                       onclick="return window.confirm('Are you sure?');" class="btn btn-warning">X??a</a>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
    <?php
}

?>



