<?php include "views/layout/header.php" ?>

<div class="col-md-12">
    <div class="panel panel-primary">
        <div class="panel-heading"><b>EDIT ADMIN</b></div>
        <div class="panel-body">

            <form method="post" enctype="multipart/form-data" action="<?php echo 'index.php?controller=admin&action=update'."&id={$data['id']}"; ?>">
                <!-- rows -->
                <?php if (isset($data['alert-success'])) echo "<h4 class='alert-success bg-green'>{$data['alert-success']}</h4>"; ?>
                <div class="row" style="margin-top:5px;">
                    <div class="col-md-2">ID</div>
                    <div class="col-md-10">
                        <input type="text" value="<?php echo $data['id']; ?>" name="id" class="form-control" disabled>
                    </div>
                </div>
                <div class="row" style="margin-top:5px;">
                    <div class="col-md-2">Avartar</div>
                    <div class="col-md-10">
                        <input type="file" name="avatar" value="<?php echo $data['avatar']; ?>">
                    </div>
                </div>
                <div class="row" style="margin-top:5px;">
                    <div class="col-md-2">Name</div>
                    <div class="col-md-10">
                        <input type="text" value="<?php echo $data['name']; ?>" name="name" class="form-control" required>
                    </div>
                </div>


                <!-- end rows -->
                <!-- rows -->
                <div class="row" style="margin-top:5px;">
                    <div class="col-md-2">Email</div>
                    <div class="col-md-10">
                        <input type="email" value="<?php echo $data['email']; ?>"  name="email" class="form-control" >

                    </div>
                </div>
                <!-- end rows -->
                <!-- rows -->
                <div class="row" style="margin-top:5px;">
                    <div class="col-md-2">Password</div>
                    <div class="col-md-10">
                        <input type="text" value="<?php echo $data['password']; ?>" name="password" class="form-control" required>
                    </div>
                </div>
                <div class="row" style="margin-top:5px;">
                    <div class="col-md-2">Password_Verify</div>
                    <div class="col-md-10">
                        <input type="text" value="" name="password_vetify" class="form-control" required>
                    </div>
                </div>
                <!-- end rows -->

                <div class="row" style="margin-top:5px;">
                    <div class="col-md-2"></div>
                    <div class="col-md-10">
                        <input type="radio" class="form-check-input" name="role_type"
                               value="1" <?php echo (isset($data['role_type']) && $data['role_type'] == 1) ? "checked" : ""; ?>>Super
                        Admin &nbsp; &nbsp; &nbsp;
                        <input type="radio" class="form-check-input" name="role_type"
                               value="2" <?php echo (isset($data['role_type']) && $data['role_type'] == 2) ? "checked" : ""; ?>>Admin
                    </div>
                </div>
                <!-- rows -->
                <div class="row" style="margin-top:5px;">
                    <div class="col-md-2"></div>
                    <div class="col-md-10">
                        <input type="submit" value="Save" class="btn btn-primary" name="save">
                        <input type="reset" value="Reset" class="btn btn-primary" >
                    </div>
                </div>

                <!-- end rows -->
            </form>
        </div>
    </div>
</div>