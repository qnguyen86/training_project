<!DOCTYPE html>
<html>
<head>
    <title>LOGIN</title>
    <link href="../assets/admin/css/style.css" rel="stylesheet" />
</head>
<body>
<form action="index.php?controller=login&action=login" method="post">
    <h2>LOGIN</h2>
    <?php if (isset($_GET['error'])) { ?>
        <p class="error"><?php echo $_GET['error']; ?></p>
    <?php } ?>
    <label>Email</label>
    <input type="email" name="email" placeholder="Email"><br>

    <label>User Name</label>
    <input type="password" name="password" placeholder="Password"><br>

    <input type="submit" value="Login" size="30" style="background: deepskyblue">
</form>
</body>
</html>
