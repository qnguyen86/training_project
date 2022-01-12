<?php
$this->fileLayout = "Layout.php";
?>
<div class="col-md-12">
    <div class="panel panel-primary">
        <div class="panel-heading"><b>Danh sách người dùng</b></div>


        <div class="message">
            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger">
                    <?php
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                    ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($this->error)): ?>
                <div class="alert alert-danger">
                    <?php
                    echo $this->error;
                    ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success">
                    <?php
                    echo $_SESSION['success'];
                    unset($_SESSION['success']);
                    ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <!--        <div class="alert alert-danger">Lỗi validate</div>-->
    <!--        <p class="alert alert-success">Thành công</p>-->

    <div class="panel-body">
        <table class="table table-bordered table-hover">
            <tr>
                <th style="width: 100px;">Id</th>
                <th style="width: 100px;">Avatar</th>
                <th>Name</th>
                <th style="width: 100px;">Email</th>
                <th style="width: 50px;">Status</th>
                <th style="width:100px;"></th>
            </tr>
            <?php
            foreach($data as $rows):
                ?>
                <tr>
                    <td><?php echo $rows->id; ?></td>
                    <td>
                        <?php if($rows->avatar!="" && file_exists("assets/upload/user/".$rows->avatar)): ?>
                            <img src="assets/upload/user/<?php echo $rows->avatar; ?>" style="width: 100px;" alt="" srcset="">
                        <?php endif; ?>
                    </td>
                    <td><?php echo $rows->name; ?></td>
                    <td><?php echo $rows->email; ?></td>
                    <td style="text-align: center;">
                        <?php if(isset($rows->status)&&$rows->status == 1): ?>
                            <span >Active</span>
                        <?php endif; ?>
                    </td>
                    <td style="text-align:center; width: 200px;">
                        <a href="index.php?controller=user&action=update&id=<?php echo $rows->id; ?>" class="btn btn-success">Sửa</a>&nbsp;
                        <a href="index.php?controller=user&action=delete&id=<?php echo $rows->id; ?>" onclick="return window.confirm('Are you sure?');" class="btn btn-warning">Xóa</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

    </div>
</div>
</div>