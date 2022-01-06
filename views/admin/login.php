<!DOCTYPE html>
<html>
<head>
    <title>LOGIN</title>
    <link href="assets/admin/css/style.css" rel="stylesheet" />
</head>
<body style="background-color: #1690A7">
<form action="index.php?controller=admin&action=login" method="post">
    <h2>LOGIN</h2>
    <?php if (isset($_GET['error'])) { ?>
        <p class="error"><?php echo $_GET['error']; ?></p>
    <?php } ?>
    <label>Email</label>
    <input type="email" name="email" placeholder="Email"><br>

    <label>Password</label>
    <input type="password" name="password" placeholder="Password"><br>

    <input type="submit" value="Login"  style="background: deepskyblue">
</form>
</body>
</html>
