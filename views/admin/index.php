<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="assets/admin/css/nav.css" rel="stylesheet" />
</head>
<body>

<div class="navbar">
    <a href="index.php?controller=admin&action=logout">Logout</a>
    <div class="dropdown">
        <button class="dropbtn">User management
            <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
            <a href="">Search</a>
            <a href="#">Create</a>

        </div>
    </div>
    <div class="dropdown">
        <button class="dropbtn">Admin management
            <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
            <a href="index.php?controller=search">Search</a>
            <a href="index.php?controller=admin&action=create">Create</a>
        </div>
    </div>
    <a href="index.php?controller=admin&action=index">Home</a>
</div>
<style>
    .navbar {
        overflow: hidden;
        background-color: #333;
        clear: both;
    }

    .navbar a {
        float: right;
        font-size: 16px;
        color: white;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
    }

    .dropdown {
        float: right;
        overflow: hidden;
    }

    .dropdown .dropbtn {
        font-size: 16px;
        border: none;
        outline: none;
        color: white;
        padding: 14px 16px;
        background-color: inherit;
        font-family: inherit;
        margin: 0;
    }

    .navbar a:hover, .dropdown:hover .dropbtn {
        background-color: red;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
    }

    .dropdown-content a {
        float: none;
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
        text-align: left;
    }

    .dropdown-content a:hover {
        background-color: #ddd;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }

</style>
</body>
</html>