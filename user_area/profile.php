<!--connect files-->
<?php
    include('../includes/connect.php');
    include('../functions/common_function.php');
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome <?php echo $_SESSION['username'] ?></title>
    <!---bootstrap css link--->
    <!-- <link rel="stylesheet" href="style.css" > -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <!--font awesome link--->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" 
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
      .logo{
      width: 7%;
      height: 7%;
      
    }
    .profile_img{
        height: 100%;
        width: 50%;
        display: block;
        margin: auto;
        object-fit: contain;
        border-radius: 70%;
}
    </style>
      
      </head>
    <body>
        <!--navbar-->
        <div class="container-fluid p-0">

        <nav class="navbar navbar-expand-lg  bg-info">
        <div class="container-fluid">
        <img src="../images/logo.png" class="logo">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../display_all.php">Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="profile.php">My Account</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../cart.php"><i class="fa-solid fa-cart-shopping"></i><sup><?php  cart_item(); ?></sup></sup></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Total price: <?php total_cart_price();  ?>/-</a>
        </li> 
      </ul>
      <form class="d-flex" role="search" action="../search_product.php" method="get">
        <input class="form-control me-2" type="search" placeholder="Search" 
        name="search_data" aria-label="Search">
         <input type="submit" value="Search" class="btn btn-outline-light" name="search_data_product">
      </form>
    </div>
  </div>
</nav>

    </div>
    <!--calling cart function-->
    <?php
    cart();
    
    ?>
    <!--second child-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">

    <ul class="navbar-nav me-auto">
        <?php
          if(!isset($_SESSION['username'])){
            echo "<li class='nav-item'>
          <a class='nav-link text-light' href='#'>Welcome Guest</a>
        </li>";
           }else{
             echo " <li class='nav-item'>
             <a class='nav-link text-light' href='#'>Welcome ".$_SESSION['username']."</a>
           </li>";
           }

      if(!isset($_SESSION['username'])){
       echo " <li class='nav-item'>
          <a class='nav-link text-light' href='./user_area/user_login.php'>Login</a>
        </li>";
      }else{
        echo " <li class='nav-item'>
        <a class='nav-link text-light' href='./user_area/logout.php'>Logout</a>
      </li>";
      }

        ?>
    </ul>
    </nav>

    <!--third child-->

    <div class="bg-light">
        <h3 class="text-center p-1">Hidden Store</h3>
        <p class="text-center">Communication is at th heart of e-commerce and community</p>
    </div>

      <!--fourth child-->
      <div class="row">
        <div class="col-md-2">
        <ul class="navbar-nav bg-secondary text-center">
        <li class="nav-item bg-info">
          <a class="nav-link text-light" href="#"><h4>Your Profile</h4></a>
        </li>

        <?php
            $username=$_SESSION['username'];
            $user_image="Select * from `user_table` where username='$username'";
            $result_image=mysqli_query($conn,$user_image);
            $row_image=mysqli_fetch_array($result_image);
            $user_image=$row_image['user_image'];
            echo "<li class='nav-item'>
          <img src='./user_images/$user_image' class='profile_img my-4' >
        </li>";

        ?>


        
        <li class="nav-item ">
          <a class="nav-link text-light" href="profile.php">Pending orders</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link text-light" href="profile.php?edit_account">Edit account</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link text-light" href="profile.php?my_orders">My orders</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link text-light" href="profile.php?delete_account">Delete account</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link text-light" href="logout.php">Logout</a>
        </li>
        </ul>
        </div>
        <div class="col-md-10 text-center">
            <?php
                get_user_order_details();
                if(isset($_GET['edit_account'])){
                    include('edit_account.php');
                }
                if(isset($_GET['my_orders'])){
                  include('user_orders.php');
              }
              if(isset($_GET['delete_account'])){
                include('delete_account.php');
            }
            ?>
        </div>
      </div>


       

<!---Footer--->

    <div class="bg-info p-3 text-center mt-3">
        <p>All rights reserved Design By Amit Kumar</p>
    </div>


    
 <!--Bootstrap js link--->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>