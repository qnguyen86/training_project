<?php 
    $this->fileLayout = "Layout.php";
 ?>
<div class="col-md-12">
    <div class="panel panel-primary">
        <div class="panel-heading"><b>Danh sách quản trị viên</b></div>
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
                     <td><?php echo $rows->id; ?></td>
                    <td>
                        <?php if($rows->avatar!="" && file_exists("assets/upload/news/".$rows->avatar)): ?>
                        <img src="assets/upload/news/<?php echo $rows->avatar; ?>" style="width: 100px;" alt="" srcset="">
                        <?php endif; ?>
                    </td>
                    <td><?php echo $rows->name; ?></td>
                    <td><?php echo $rows->email; ?></td>
                    <td style="text-align: center;">
                        <?php if(isset($rows->role_type)&&$rows->role_type == 1): ?>
                            <span >Super admin</span>
                        <?php endif; ?>
                    </td>
                    <td style="text-align:center; width: 200px;">
                        <a href="index.php?controller=admin&action=update&id=<?php echo $rows->id; ?>" class="btn btn-success">Sửa</a>&nbsp;
                        <a href="index.php?controller=admin&action=delete&id=<?php echo $rows->id; ?>" onclick="return window.confirm('Are you sure?');" class="btn btn-warning">Xóa</a>
                    </td>
                </tr>                    
                <?php endforeach; ?>
            </table>
            
        </div>
    </div>
</div>