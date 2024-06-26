<?php
include 'connect.php';
session_start();

if (!isset($admin_id)){
  // header('location:login.php');
    if(isset($_POST['logout'])){
        session_destroy();
       // header('location:login.php');
    }
} 
//adding product
if(isset($_POST['add_product'])) {
    $product_name= mysqli_real_escape_string($conn,$_POST['name']);
    $product_price= mysqli_real_escape_string($conn,$_POST['price']);
    $product_detail= mysqli_real_escape_string($conn,$_POST['detail']);
    $image=$_FILES['image']['name'];
    $image_size=$_FILES['image']['size'];
    $image_tmp_name=$_FILES['image']['tmp_name'];
    $image_folder='uploads/'.$image;

    $select_product_name=mysqli_query($conn,"SELECT name FROM products WHERE name='$product_name'" )or die('query failed');
    if(mysqli_num_rows($select_product_name)>0){
        $message[]='product name is already exist';
    }else{
        $insert_product=mysqli_query($conn,"INSERT INTO products (name,price,product_details,image)VALUE('$product_name','$product_price','$product_detail','$image')")or die('query is failed');
        if($insert_product){
            if($image_size>2000000){
              $message[]='image size is too large';  
            }else{
                move_uploaded_file($image_tmp_name,$image_folder);
                $message[]='product added successfully';
            }
        } 
    }
}
//delete product from database
if(isset($_GET['delete'])){
    $delete_id=$_GET['delete'];
    $selec_delete_image = mysqli_query($conn,"SELECT image FROM  products WHERE id='$delete_id'")or die('failed');
    $fetch_delete_image=mysqli_fetch_assoc($selec_delete_image);
    unlink('upload/'.$fetch_delete_image['image']);
    mysqli_query($conn,"DELETE FROM products where id ='$delete_id'")or die('The  query is failed');
    mysqli_query($conn,"DELETE FROM cart where id ='$delete_id'")or die('The  query is failed');
    mysqli_query($conn,"DELETE FROM wishlist where id ='$delete_id'")or die('The  query is failed');

    header('location:admin_product.php');
}
//update product
if(isset($_POST['update_product'])){
    $update_id=$_POST['update_id'];
    $update_name=$_POST['update_name'];
    $update_price=$_POST['update_price'];
    $update_detail=$_POST['update_detail'];
    $update_image=$_FILES['udate_image']['name'];
    $update_image_tmp_name=$_FILES['update_image']['tmp_name'];
    $update_image_folder= 'upload/'.$update_image;

    $udate_query=mysqli_query($conn,"UPDATE products SET 'id'='$update_id',
    'name'='$update_name','price'='$update_price','update_detail'='$update_detail',
    'image'='$update_image' WHERE id='$update_id'") or die('update query failed');
    if($updat_query){
        move_uploaded_file($update_image_tmp_name,$update_image_folder);
        header('location:admin_product.php');
    }
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin pannel</title>
    <lind rel="stylesheet" href="dupstyle.css">
</head>
<body>

    <!--div class="" style="height:100vh;"></div-->
    <div class="line4"></div>
    <?php
    if (isset($message)) {
        foreach ($message as $msg) {
            echo '<div class="message">
            <span>'.$msg.'</span>
            <i class="bi bi-x-circle" onclick="this.parentElement.remove()"></i>
            </div>
            ';
        }
    }
    ?>
    <div class="line2"></div>
    <section class="add-products form-container">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="input-field">
            <label>product name </label>
            <input type="text" name="name" require>
        </div> <div class="input-field">
            <label>product price </label>
            <input type="text" name="price" require>
        </div>
        <div class="input-field">
            <label>product detail </label>
            <textarea name="detail" require></textarea>
        </div>
        <div class="input-field">
            <label>product image </label>
            <input type="file" name="image" accept="image/jpg,image/jpeg,image/png,image/webp" require>
        </div>
        <input type="submit" name="add_product" value="add product" class="btn">
    </form>
    </section>
    <div class="line3"></div>
    <div class="line4"></div>
    <section class="show-products">
        <div class='box-container'>
            <?php
            $select_products=mysqli_query($conn,"SELECT * FROM products")or die('query are failed');
            if(mysqli_num_rows($select_products)>0){
                while($fetch_products= mysqli_fetch_assoc($select_products)){
                    ?>
                    <div class="box">
                    <img src="uploads/<?php echo $fetch_products['image'];?>">
                    <h4>price : $<?php echo $fetch_products['price'];?></h4>
                    <h5><?php echo $fetch_products['name'];?></h5>
                    <details><?php echo $fetch_products['product_details'];?></details>
                  <a href="admin_product.php? edit=<?php echo $fetch_products['id'];?>"class="edit">edit</a>    
                  <a href="admin_product.php? delete=<?php echo $fetch_products['id'];?>"class="delete" onclick="return confirm('you want to delete this product');">delete</a>
                </div>
                    <?php
                       }
                }else{
                echo'
                <div class="empty">
                <p> no products added yet!</p>
                </div>
                ';
                }
            ?>
            
    </section>
    <div class="line"></div>
    <section class="update-container">
        <?php
        if(isset($_GET['edit'])){
            $edit_id=$_GET['edit'];
            $edit_query=mysqli_query($conn,"SELECT *FROM products WHERE id='$edit_id'")or die("query failed");
            if(mysqli_num_rows($edit_query)>0){
                while($fetch_edit=mysqli_fetch_assoc($edit_query)){
                ?>
                <form action="" method="post" enctype="multipart/form-data">
                    <img src="upload/ <?php echo $fetch_edit['image'];?>">
                    <input type="hidden" name="update_id" value="<?php echo $fetch_edit['id'];?>">
                    <input type="text" name="name" value="<?php echo $fetch_edit['name'];?>">
                    <input type="number" name="price" min="0" value="<?php echo $fetch_edit['price'];?>">
                    <textarea> <?php echo $fetch_edit['product_detail'];?></textarea>
                    <input type="file" name="image" accept="image/jpg,image/jpeg,image/png,image/webp">
                <input type="submit" name="update_product" value="update" class="edit">
                <input type="reset" name="" value="cancel" class="option-btn btn" id="close-form">
                </form>
                <?php
                }
            }
            echo "<script> document.querySelector('.update-container').style.dispaly='block'</script>";
        }
        ?>
    </section>
    <script type="text/javascript" src="javascript.js"></script>
</body>
</html>