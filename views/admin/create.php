<?php include "views/layout/header.php" ?>
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card bg-light mt-5">
            <div class="card-header card-text">
                <div class="row">
                    <div class="col">
                        <h2 class="card-text">Add New Admin</h2>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <form method="post" action="index.php?controller=admin&action=create">
                    <div class="form-group">
                        <label for="title">Avatar<sub>*</sub></label>
                        <input type="file" name="avatar" class="form-control form-control-lg ">

                    </div>
                    <?php if (isset($record->avatar) && file_exists("assets/upload/news/" . $record->avatar)): ?>
                        <div class="form-group">
                            <label for="title">Avatar<sub>*</sub></label>
                            <img src="assets/upload/news/<?php echo $record->avatar; ?>" style="width: 100px;" alt=""
                                 srcset="">
                        </div>
                    <?php endif; ?>
                    <div class="form-group">
                        <label for="password">Name<sub>*</sub></label>
                        <text type="text" name="name" class="form-control form-control-lg ">
                        </text>
                        <span class="invalid-feedback"> </span>
                    </div>
                    <div class="form-group">
                        <label for="password">Email<sub>*</sub></label>
                        <text type="text" name="email" class="form-control form-control-lg ">
                        </text>
                        <span class="invalid-feedback"> </span>
                    </div>
                    <div class="form-group">
                        <label for="password">Password<sub>*</sub></label>
                        <text type="text" name="password" class="form-control form-control-lg ">
                        </text>
                        <span class="invalid-feedback"> </span>
                    </div>
                    <div class="form-group">
                        <label for="password">Password Verify<sub>*</sub></label>
                        <text type="text" name="password_verify" class="form-control form-control-lg ">
                        </text>
                        <span class="invalid-feedback"> </span>
                    </div>


                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <input type="submit" class="btn btn-primary btn-block pull-left" value="Save">
                            </div>
                            <div class="col">
                                <input type="reset" class="btn btn-primary btn-block pull-right" value="Reset">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>