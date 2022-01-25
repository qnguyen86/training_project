<?php include "views/layout/header.php" ?>

<div class="col-md-12">
    <div class="panel panel-primary">
        <div class="panel-heading"><b>EDIT USER</b></div>
        <div class="panel-body">

            <form method="post" enctype="multipart/form-data" action="<?php echo 'index.php?controller=user&action=update'."&id={$data['id']}"; ?>">
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
                        <input type="text" value="" name="password" class="form-control" required>
                    </div>
                </div>
                <!-- end rows -->

                <div class="row" style="margin-top:5px;">
                    <div class="col-md-2"></div>
                    <div class="col-md-10">
                        <input type="radio" class="form-check-input" name="status"
                               value="1" <?php echo (isset($data['status']) && $data['status'] == 1) ? "checked" : ""; ?>>Active &nbsp; &nbsp; &nbsp;
                        <input type="radio" class="form-check-input" name="status"
                               value="2" <?php echo (isset($data['status']) && $data['status'] == 2) ? "checked" : ""; ?>>Banned
                    </div>
                </div>
                <!-- rows -->
                <div class="row" style="margin-top:5px;">
                    <div class="col-md-2"></div>
                    <div class="col-md-10">
                        <input type="submit" value="Save" class="btn btn-primary" name="save">
                        <input type="reset" value="Reset" class="btn btn-primary">
                    </div>
                </div>

                <!-- end rows -->
            </form>
        </div>
    </div>
</div>