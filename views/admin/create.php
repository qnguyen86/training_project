<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<?php include("index.php"); ?>
<body>
<h3 style="margin-left:340px;">Admin create</h3>
<form action="index.php?controller=admin&action=create" method="post">
 <table border="1" cellpadding="0" class="admin-create" cellspacing="0">
     <tr>
         <td class="col1">Avatar</td>
         <td><input type="file" name="avatar" value="File upload"></td>
     </tr>
     <tr>
         <td colspan="2">images</td>
     </tr>
     <tr>
         <td class="col1">Name</td>
         <td class="col2"><input type="text" name="name"></td>
     </tr>
     <tr>
         <td class="col1">Email</td>s
         <td><input type="text" name="email"></td>
     </tr>
     <tr>
         <td class="col1">Password</td>
         <td><input type="text" name="password"></td>
     </tr>
     <tr>
         <td class="col1">Password Verify</td>
         <td><input type="text" name="passvertify"></td>
     </tr>
 </table>
<div class="create-button">
    <input type="submit" id="reset" value="Reset">
    <input type="submit" style="float: right;" id="save" value="Save" >
</div>
</form>
 <style>
     .admin-create{
         width: 700px;
         height: 450px;
         margin: 0 auto;
         margin-top: 30px;

     }
     .col1{
         width: 100px;
         text-align: center;
     }
     td {
         border-style : hidden!important;
     }
     .create-button{
         width: 700px;
         margin-left:330px;
         margin-top: 10px;
     }
     #reset
     {
         background-color: pink;
     }
     #save
     {
         background-color: deepskyblue;
     }
 </style>
</body>
</html>