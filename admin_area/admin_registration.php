<?php
include('../includes/connect.php');
include('../functions/common_function.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>
    <!---bootstrap css link--->
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
    crossorigin="anonymous">
         
    <!--font awesome link--->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" 
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
   <style>
    body{
        overflow: hidden;
    }
    </style>
</head>
<body>
    <div class="container-fluid m-3">
        <h2 class="text-center mb-5">Admin Registration</h2>
        <div class="row d-flex justify-content-center ">
            <div class="col-lg-6 col-xl-5">
                <img src="../images/register.jpg" alt="Admin Registration" class="img-fluid">
            </div>
            <div class="col-lg-6 col-xl-4">
               <form action="" method="post">
                <div class="form-outline mb-4">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" id="username" name="admin_username" placeholder="Enter your username"
                    required="required" class="form-control">
                </div>
                <div class="form-outline mb-4">
                    <label for="email" class="form-label">Email</label>
                    <input type="emial" id="email" name="admin_email" placeholder="Enter your email"
                    required="required" class="form-control">
                </div>
                <div class="form-outline mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="admin_password" placeholder="Enter your password"
                    required="required" class="form-control">
                </div>
                <div class="form-outline mb-4">
                    <label for="confirm_password" class="form-label">Confirm Password</label>
                    <input type="password" id="confirm_password" name="conf_admin_password" 
                    placeholder="Enter your confirm password"
                    required="required" class="form-control">
                </div>
                <input type="submit" class="bg-info py-2 px-3 border-0" name="admin_registration"
                value="Register">
                <p class="small fw-bold mt-2 pt-1">Already have an account? <a href="admin_login.php" 
                class="text-danger">Login</a></p>
               </form>
            </div>
        </div>
    </div>
</body>
</html>


<!--php code-->

<?php
if(isset($_POST['admin_registration'])){
    $admin_username=$_POST['admin_username'];
    $admin_email=$_POST['admin_email'];
    $admin_password=$_POST['admin_password'];
    $hash_password=password_hash($admin_password,PASSWORD_DEFAULT);
    $conf_admin_password=$_POST['conf_admin_password'];

//select query
$select_query="Select * from `admin_table` where admin_name='$admin_username' or admin_email='$admin_email'";
$result=mysqli_query($conn,$select_query);
$rows_count=mysqli_num_rows($result);
if($rows_count> 0){
    echo "<script>alert('Username and Email is already exist.')</script>";
}
else if($admin_password!=$conf_admin_password){
    echo "<script>alert('Password do not match.')</script>";
}
else{
    
    //insert_query

$insert_query="insert into `admin_table` (admin_name,admin_email,admin_password) values 
('$admin_username','$admin_email','$hash_password')";
$sql_execute=mysqli_query($conn,$insert_query);
}
}
?>