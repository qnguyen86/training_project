<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        
        <meta name="author" content="" />
        <title>Static Navigation - SB Admin</title>
        <link href="assets/admin/css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <script type="text/javascript" src="../assets/ckeditor/ckeditor.js"></script>
         <link href="assets/admin/css/nav.css" rel="stylesheet" />
    </head>
    <body>
    <div class="navbar1">
     <a href="index.php?controller=admin&action=index">Home</a>
    <div class="dropdown1">
        <button class="dropbtn1"><a href="index.php?controller=admin">Admin management</a>
            <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content1">
            <a href="index.php?controller=search">Search</a>
            <a href="index.php?controller=admin&action=create">Create</a>
        </div>
    </div>
    <a href="index.php?controller=login&action=logout">Logout</a>
    <div class="dropdown1">
        <button class="dropbtn1">User management
            <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content1">
            <a href="">Search</a>
            <a href="#">Create</a>

        </div>
    </div>
    </div>
                  
                            
            <div id="layoutSidenav_content">
                <main>
                    <?php echo $this->view; ?>
                </main>
                
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

