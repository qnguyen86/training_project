<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <link rel="stylesheet" href="assets/css/bootstrap.css">
</head>
<body>
<div class="navbar1">
    <a href="index.php">Home</a>
    <div class="dropdown1">
        <button class="dropbtn1"><a href="index.php?controller=admin">Admin management</a>
            <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content1">
            <a href="index.php?controller=admin&action=search">Search</a>
            <a href="index.php?controller=admin&action=create">Create</a>
        </div>
    </div>
    <a href="index.php?controller=admin&action=logout">Logout</a>
    <div class="dropdown1">
        <button class="dropbtn1"><a href="index.php?controller=users">User management</a>
            <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content1">
            <a href="index.php?controller=users&action=search">Search</a>
            <a href="index.php?controller=users&action=create">Create</a>

        </div>
    </div>
</div>
</div>


<style type="text/css">
    .navbar1 {
        overflow: hidden;
        background-color: #333;
        clear: both;
    }

    .navbar1 a {
        float: right;
        font-size: 16px;
        color: white;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
    }

    .dropdown1 {
        float: right;
        overflow: hidden;
    }

    .dropdown1 .dropbtn1 {
        font-size: 16px;
        border: none;
        outline: none;
        color: white;
        padding: 14px 16px;
        background-color: inherit;
        font-family: inherit;
        margin: 0;
    }

    .navbar1 a:hover, .dropdown1:hover .dropbtn1 {
        background-color: red;
    }

    .dropdown-content1 {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
    }

    .dropdown-content1 a {
        float: none;
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
        text-align: left;
    }

    .dropdown-content1 a:hover {
        background-color: #ddd;
    }

    .dropdown1:hover .dropdown-content1 {
        display: block;
    }
    .admin-create{

    }
</style>
</body>
</html>