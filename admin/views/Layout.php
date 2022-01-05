<!DOCTYPE html>
<html>
<head>
    <title>HOME</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<h1>Hello, <?php echo $_SESSION['email']; ?></h1>
<a href="index.php?controller=login&action=logout">Logout</a>
</body>
</html>