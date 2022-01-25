<?php include "views/layout/header.php" ?>
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card bg-light mt-5">
            <div class="card-header card-text">
                <div class="row">
                    <div class="col">
                        <h2 class="card-text">Add New User</h2>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form method="post" action="index.php?controller=user&action=create" enctype="multipart/form-data">
                    <?php if (isset($data['alert-success'])) echo "<h4 class='alert-success bg-green'>{$data['alert-success']}</h4>"; ?>
                    <?php if (isset($data['alert-fail'])) echo "<h4 class='alert-warning '>{$data['alert-fail']}</h4>"; ?>
                    <div class="form-group">
                        <label for="title">Avatar<sub>*</sub></label>
                        <input type="file" name="avatar" class="form-control form-control-lg"
                               value="<?php if (isset($_FILES['avatar']['name'])) echo $_FILES['avatar']['name']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="password">Name<sub>*</sub></label>
                        <textarea type="text" name="name"
                                  class="form-control form-control-lg <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>"
                                  value="<?php if (!isset($_POST['name'])) echo $_POST['name']; ?>">
                        </textarea>
                        <span class="invalid-feedback"><?php echo $data['name_err']; ?> </span>
                    </div>
                    <div class="form-group">
                        <label for="password">Email<sub>*</sub></label>
                        <textarea type="text" name="email"
                                  class="form-control form-control-lg <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>"
                                  value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>">
                        </textarea>
                        <span class="invalid-feedback"><?php echo $data['email_err']; ?>  </span>
                    </div>
                    <div class="form-group">
                        <label for="password">Password<sub>*</sub></label>
                        <textarea type="text" name="password"
                                  class="form-control form-control-lg <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>">
                        </textarea>
                        <span class="invalid-feedback"> <?php echo $data['password_err']; ?> </span>
                    </div>
                    <div class="form-group">
                        <label for="password">Password Verify<sub>*</sub></label>
                        <textarea type="text" name="password_verify" class="form-control form-control-lg ">
                        </textarea>
                        <span class="invalid-feedback"> </span>
                    </div>
                    <input type="radio" class="form-check-input" name="status"
                           value="2" <?php if (isset($_POST['status']) && $_POST['status'] == 2) echo "checked"; else echo ""; ?>>Banned&nbsp; &nbsp; &nbsp;
                    <input type="radio" class="form-check-input" name="status"
                           value="1" <?php if (isset($_POST['status']) && $_POST['status'] == 1) echo "checked";
                    if (empty($_POST['status'])) echo "checked"; ?>>Active
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <input type="submit" class="btn btn-primary btn-block pull-left" name="save"
                                       value="Save">
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