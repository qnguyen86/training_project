<?php
$this->fileLayout = "Layout.php";
?>
    <style>
        .form-inline{
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
            <input type="text" class="form-control" name="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : '' ?>" placeholder="Input your name" />
            </br>
            <input type="text" class="form-control" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>" placeholder="Input your email" />
            <button class="btn btn-success" name="search">Search</button>
            <a href="index.php?controller=users&action=search" class="btn btn-info">Reload</a>
        </div>
    </form>
<?php

$con = new PDO( 'mysql:host=localhost;dbname=train_database', 'root', '');
if(ISSET($_POST['search'])){
    ?>
    <table class="table table-bordered">
        <thead class="alert-info">
        <tr>
            <th>ID</th>
            <th>Avatar</th>
            <th>Name</th>
            <th>Email</th>
            <th>Status</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php
        $name = $_POST['name'];
        $email = $_POST['email'];
        $query = $con->prepare("SELECT * FROM `users` WHERE `name` LIKE '%$name' AND `email` LIKE '%$email%' ");
        $query->execute();
        while($row = $query->fetch()){
            ?>
            <tr>
                <td><?php echo $row['id']?></td>
                <td>
                    <img src="assets/upload/users/<?php echo $row['avatar']; ?>" style="width: 100px;" alt="" srcset="">
                </td>
                <td><?php echo $row['name']?></td>
                <td><?php echo $row['email']?></td>
                <td> <?php if(isset($row['status'])&&$row['status'] == 1): ?>
                        <span >Active</span>
                    <?php endif; ?></td>
                <td></td>
            </tr>


            <?php
        }
        ?>
        </tbody>
    </table>
    <?php
}else{
    ?>
    <table class="table table-bordered">
        <thead class="alert-info">
        <tr>
            <th>ID &nbsp;<i class="fas fa-sort-up"></i>&nbsp;&nbsp;<i class="fas fa-sort-down"></i></i></th>
            <th>Avatar</th>
            <th>Name</th>
            <th>Email</th>
            <th>Status</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php
        $query = $con->prepare("SELECT * FROM `users`");
        $query->execute();
        while($row = $query->fetch()){
            ?>
            <tr>
                <td><?php echo $row['id']?></td>
                <td>
                    <img src="assets/upload/users/<?php echo $row['avatar']; ?>" style="width: 100px;" alt="" srcset="">
                </td>
                <td><?php echo $row['name']?></td>
                <td><?php echo $row['email']?></td>
                <td> <?php if(isset($row['status'])&&$row['status'] == 1): ?>
                        <span >Active</span>
                    <?php endif; ?></td>
                <td>
                    <a href="index.php?controller=users&action=update&id=<?php echo $row['id']; ?>" class="btn btn-success">Sửa</a>&nbsp;
                    <a href="index.php?controller=users&action=delete&id=<?php echo $row['id']; ?>" onclick="return window.confirm('Are you sure?');" class="btn btn-warning">Xóa</a>
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