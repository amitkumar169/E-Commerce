
<?php

// if(isset($_GET['delete_product'])){
//     $delete_id=$_GET['delete_product'];

//     $delete_product="Delete form `products` where product_id=$delete_id";
//     $result_product=mysqli_query($conn,$delete_product);
//     if($result_product){
//         echo "<script>alert('Product deleted successfully')</script>";
//         echo "<script>window.open('./index.php','_self')</script>";
//     }
// }


if (isset($_GET['delete_product'])) {
    $delete_id = $_GET['delete_product'];

    // Prepare the delete query to prevent SQL injection
    $delete_product = "DELETE FROM `products` WHERE product_id =  $delete_id";
    $stmt = mysqli_prepare($conn, $delete_product);
    
    
    // Execute the statement
    $result_product = mysqli_stmt_execute($stmt);
    
    if ($result_product) {
        echo "<script>alert('Product deleted successfully')</script>";
        echo "<script>window.open('./index.php', '_self')</script>";
    } else {
        echo "<script>alert('Product deletion failed')</script>";
    }

    // Close the statement
    mysqli_stmt_close($stmt);
}



?>