<?php
include 'connect.php';

// Adding product
if (isset($_POST['submit-btn'])) {
    // Check if the required fields are set
    if (isset($_POST['name'], $_POST['price'], $_POST['detail'], $_FILES['image'], $_POST['keywords'])) {
        $product_name = mysqli_real_escape_string($conn, $_POST['name']);
        $product_price = mysqli_real_escape_string($conn, $_POST['price']);
        $product_detail = mysqli_real_escape_string($conn, $_POST['detail']);
        $product_keywords = mysqli_real_escape_string($conn, $_POST['keywords']);
        $product_category = mysqli_real_escape_string($conn, $_POST['category']);
        $image = $_FILES['image']['name'];
        $image_size = $_FILES['image']['size'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = 'uploads/' . $image;

        // Use prepared statement to prevent SQL injection
        $insert_product = mysqli_prepare($conn, "INSERT INTO products (name, price, product_details, category_id, keywords, image) VALUES (?, ?, ?, ?, ?, ?)");

        // Check if the prepared statement was created successfully
        if ($insert_product) {
            mysqli_stmt_bind_param($insert_product, "ssssss", $product_name, $product_price, $product_detail, $product_category, $product_keywords, $image);

            if (mysqli_stmt_execute($insert_product)) {
                if ($image_size > 2000000) {
                    $message[] = 'Image size is too large';
                } else {
                    move_uploaded_file($image_tmp_name, $image_folder);
                    $message[] = 'Product added successfully';
                    header('location:index.php');
                }
            } else {
                $message[] = 'Query execution failed';
            }

            mysqli_stmt_close($insert_product);
        } else {
            $message[] = 'Prepared statement creation failed';
        }
    } else {
        $message[] = 'Required fields are not set';
       
    }
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Adding product</title>
	<link rel="stylesheet" type="text/css" href="add-product-form.css">
</head>
<body>
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
	  <nav>
        <a href="index.html"><img src="images/E_logo-removebg-preview (1).png" alt="logo"></a>
    </nav>
    <div class="form-wrapper">
        <h2>Add product</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-control">
                <input type="text" name="name" required>
                <label>Product name</label>
            </div>
            <div class="form-control">
                <input type="number" name="price" required>
                <label>Product price</label>
            </div>
              <div class="form-control">
                <textarea type="textarea" name="detail" required></textarea>
                <label>Product details</label>
            </div>
            <div class="form-control">
                <input type="text" name="keywords" required>
                <label>keywords</label>
            </div>
            <div class="form-control">
            	<label></label>
                <input type="file" id="fileUpload" name="image">
            </div>
            
            <div class="form-control">
                <label class="category-01" for="category">category</label>
                     <select name="category" id="category">
                            <option value="1">Smart phone</option>
                            <option value="2">Laptop</option>
                            <option value="3">Cameras</option>
                            <option value="4">Smart watch</option>
                            <option value="3">Head phone</option>
                            <option value="3">Pc computer</option>
                            <option value="3">Others</option>
                     </select>
            </div>
            <button type="submit" name="submit-btn">Submit</button>
            <div class="form-help"> 
                <div class="remember-me">
                    <input type="checkbox" id="remember-me">
                    <label for="remember-me">Remember me</label>
                </div>
                <a href="#">Need help?</a>
            </div>
        </form>
        <p>Back to   <a href="dashboard.html">Dashboard</a></p>
    </div>
</body>
</html>