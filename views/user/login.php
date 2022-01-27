<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<!------ Include the above in your HEAD tag ---------->
<div id="login">
    <h3 class="text-center text-white pt-5">Login form</h3>
    <div class="container">
        <div id="login-row" class="row justify-content-center align-items-center">
            <div id="login-column" class="col-md-6">
                <div id="login-box" class="col-md-12">
                    <form id="login-form" class="form" action="index.php?controller=user&action=login" method="post">
                        <h3 class="text-center text-info">Login</h3>
                        <div class="form-group">
                            <label for="username" class="text-info">Email:</label><br>
                            <input type="text" name="email" id="username" class="form-control <?php echo (!empty($data['email_err'])) ? 'is-invalid' : '' ;?>"  value="<?php echo $data['email'] ;?>" >
                            <span class="invalid-feedback"><?php echo $data['email_err'] ;?> </span>
                        </div>
                        <div class="form-group">
                            <label for="password" class="text-info">Password:</label><br>
                            <input type="text" name="password" id="password" class="form-control <?php echo (!empty($data['password_err'])) ? 'is-invalid' : '' ;?>"  >
                            <span class="invalid-feedback"><?php echo $data['password_err'] ;?> </span>
                        </div>
                        <div class="form-group" style="text-align: center;">
                            <input type="submit" name="btn-login" class="btn btn-info btn-md" value="Login">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>


</html>