<?php
include('../includes/connect.php');
include('../functions/common_function.php');
@session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
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
        <h2 class="text-center mb-5">Admin Login</h2>
        <div class="row d-flex justify-content-center ">
            <div class="col-lg-6 col-xl-5">
                <img src="../images/login.jpg" alt="Admin Login" class="img-fluid">
            </div>
            <div class="col-lg-6 col-xl-4">
               <form action="" method="post">
                <div class="form-outline mb-4 mt-5">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" id="username" name="username" placeholder="Enter your username"
                    required="required" class="form-control">
                </div>
                <div class="form-outline mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password"
                    required="required" class="form-control">
                </div>
                <input type="submit" class="bg-info py-2 px-3 border-0" name="admin_login"
                value="Login">
                <p class="small fw-bold mt-2 pt-1">Don't have an account? <a href="admin_registration.php" 
                class="text-danger">Registration</a></p>
               </form>
            </div>
        </div>
    </div>
</body>
</html>


<?php
if(isset($_POST['admin_login'])){
    $user_username=$_POST['username'];
    $user_password=$_POST['password'];

    $select_query="Select * from `admin_table` where admin_name='$user_username'";
    $result=mysqli_query($conn,$select_query);
    $row_count=mysqli_num_rows($result);
    $row_data=mysqli_fetch_assoc($result);
    
    if($row_count>0){
        $_SESSION['username'] = $user_username;
        if(password_verify($user_password, $row_data['admin_password'])){
            echo "<script>alert('Login Successful')</script>";
           if($row_count==1){
            $_SESSION['username'] = $user_username;
             echo "<script>alert('Login Successful')</script>";
             echo  "<script>window.open('index.php','_self')</script>";
           }
           
        }else{
            echo "<script>alert('Failed')</script>";
        }
    }else{
        echo "<script>alert('Invalid Credentials')</script>";
    }
}


?>