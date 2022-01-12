<?php
//load file Layout.php
$this->fileLayout = "Layout.php";
?>
<div class="col-md-12">
    <div class="panel panel-primary">
        <div class="panel-heading"><b>Add edit user</b></div>
        <div class="panel-body">

            <form method="post" enctype="multipart/form-data" action="<?php echo $action; ?>">
                <!-- rows -->
                <div class="row" style="margin-top:5px;">
                    <div class="col-md-2">Avartar</div>
                    <div class="col-md-10">
                        <input type="file" name="avatar">
                    </div>
                </div>
                <!-- end rows -->
                <?php if(isset($record->avatar) && file_exists("assets/upload/user/".$record->avatar)): ?>
                    <!-- rows -->
                    <div class="row" style="margin-top:5px;">
                        <div class="col-md-2">Avatar</div>
                        <div class="col-md-10">
                            <img src="assets/upload/user/<?php echo $record->avatar; ?>" style="width: 100px;" alt="" srcset="">
                        </div>
                    </div>
                    <!-- end rows -->
                <?php endif; ?>
                <div class="row" style="margin-top:5px;">
                    <div class="col-md-2">Name</div>
                    <div class="col-md-10">
                        <input type="text" value="<?php echo isset($record->name)?$record->name:""; ?>" name="name" class="form-control" required>
                    </div>
                </div>


                <!-- end rows -->
                <!-- rows -->
                <div class="row" style="margin-top:5px;">
                    <div class="col-md-2">Email</div>
                    <div class="col-md-10">
                        <input type="email" value="<?php echo isset($record->email) ? $record->email:""; ?>" <?php if(isset($record->email)): ?> disable <?php else: ?> required <?php endif; ?> name="email" class="form-control" >

                    </div>
                </div>
                <!-- end rows -->
                <!-- rows -->
                <div class="row" style="margin-top:5px;">
                    <div class="col-md-2">Password</div>
                    <div class="col-md-10">
                        <input type="text" value="<?php echo isset($record->pasword)?$record->password:""; ?>" name="password" class="form-control" required>
                    </div>
                </div>
                <!-- end rows -->

                <div class="row" style="margin-top:5px;">
                    <div class="col-md-2"></div>
                    <div class="col-md-10">
                        <input type="checkbox" <?php if(isset($record->status)&&$record->status==1): ?> checked <?php endif; ?> name="status" id="hot"> <label for="hot">&nbsp;&nbsp;Status</label>
                    </div>
                </div>
                <!-- rows -->
                <div class="row" style="margin-top:5px;">
                    <div class="col-md-2"></div>
                    <div class="col-md-10">
                        <input type="submit" value="Process" class="btn btn-primary">
                        <input type="reset" value="Reset" class="btn btn-primary">
                    </div>
                </div>

                <!-- end rows -->
            </form>
        </div>
    </div>
</div>