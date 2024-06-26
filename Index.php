<?php
include 'connect.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="Viewport" content="width=device-width,initial-scale=1.0">
        <title>Electronic Shop</title>
        <link rel="stylesheet" href="e shop.css">
        <link rel="stylesheet" href="add_p.css">
        <link rel="stylesheet" href="https://cdjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
        <!--bootstrap links-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <!--bootstrap links-->
        <!--fonts links-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather+Sans:ital@1&display=swap" rel="stylesheet">
<!--fonts links end-->
<!-- Boxiocns CDN Link -->
<link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
<!--navbar-->
<nav class="navbar navbar-expand-lg" id="navbar">
    <div class="container-fluid">
      <a class="navbar-brand" href="Index.php" id="logo"><span id="span1">E</span>Lectronic<span id="spane2">Shop</span></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span><i class="fa-solid fa-bars" ></i></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="Index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="allp.html">Product</a>
          </li> 
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Category
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="background-color: rgb(45,45,48);">
              <li><a class="dropdown-item" href="#">Smart Phone</a></li>
              <li><a class="dropdown-item" href="#">Cell Phone</a></li>
              <li><a class="dropdown-item" href="#">Laptop</a></li>
              <li><a class="dropdown-item" href="#">Cameras</a></li>
              <li><a class="dropdown-item" href="#">Smart Watch</a></li>
              <li><a class="dropdown-item" href="#">Headphone</a></li>
              <li><a class="dropdown-item" href="#">PC Monitor</a></li>
              <li><a class="dropdown-item" href="#">AC</a></li>
              <li><a class="dropdown-item" href="#">Fridge</a></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.html">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contact.html">Contact</a>
          </li>
        </ul>
        <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
          <button class="btn btn-outline-success" type="submit"><i class="fa fa-shopping-cart" aria-hidden="true"></i></button>
        </form>
      </div>
    </div>
  </nav>
  <div class="top-navbar">
    <div class="icons">
       <button><a href="loginform.php">Login</a></button> 
       <button><a href="registeration.php">Register</a></button>
    </div>
</div>
<!--navbar-->

<!--Home content-->
<section Class="Home">
    <div class="content">
        <h1> <span>Electronic Products</span>
            <br>
            UP TO <span id="span2">30%</span>OFF
        </h1>
        <h4>
        <p>Score big on tech deals! Enjoy up to 30% OFF in our Electronic Gadget Sale.
            <br>Upgrade your devices without breaking the bank. Limited time, incredible savings – shop now!"
        </p>
        </h4>
        <div Class="btn"><button>Shop Now</button></div>
    </div>
</section>

  <!-- bootstrap code -->
<div class="botstrap">
  <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel"> 
   <div class="carousel-inner">
     <div class="carousel-item active">
       <img src="Images/Gadget2.jpg" class="d-block w-100" alt="...">
     </div>
     <div class="carousel-item">
       <img src="Images/Gadget3.jpg" class="d-block w-100" alt="...">
     </div>
     <div class="carousel-item">
       <img src="Images/Gadget4.jpg" class="d-block w-100" alt="...">
     </div>
   </div>
 </div>
</div>

<!-- bootstrap code -->
<!--Home content-->


<!--Product cards start-->

<div class="container1">
<div class="container" id="product-cards">
  <h1 class="text-center">PRODUCTS</h1>
   <div class="row" style="margin-top: 30px;">
    <div class="col-md-3 py-3 py-md-0">
      
    </div>
    <!-- ===========================For products================================ -->
<section id="product1" class="section1">
          
          <div class="pro-container">
         
   <?php
   $select_products = mysqli_query($conn, "SELECT * FROM products") or die(mysqli_error($conn));
   if (mysqli_num_rows($select_products) > 0) {
      while ($fetch_products = mysqli_fetch_assoc($select_products)) {
   ?>
           
            <div class="pro">
            <img src="uploads/<?php echo $fetch_products['image']; ?>">
            <h4>Price: $<?php echo $fetch_products['price']; ?></h4>
            <h5><?php echo $fetch_products['name']; ?></h5>
            <details><?php echo $fetch_products['product_details']; ?></details>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star"></span>
            <a href="#"><i class="fa-solid fa-cart-shopping cort"></i></a>
         </div>
   <?php
      }
   } else {
      echo '
         <div class="empty">
            <p>No products added yet!</p>
         </div>
      ';
   }
   ?>
</div> 
</section>
   
<!--Product cards-->


<!--banner-->
<section Class="banner">
  <div class="content">
      <h1> <span>Electronic Gadget</span>
          <br>
          UP TO <span id="span2">50%</span>OFF
      </h1>
      <h5>
      <p>
        "Upgrade your gadgets for less! Our Electronic Gadget Sale offers up to 50% OFF. <br>
         Get the latest and coolest tech without breaking the bank. From phones to smart home gear,<br> shop now 
         for amazing deals. Don't miss out – it's time to save big on the tech you love!"
      </p>
      </h5>
      <div Class="btn"><button>Shop Now</button></div>
      <div class="imge">
         <a href="#" id="imge"> <img src="./images/mac20231.webp" alt="#"></a>
      </div>
  </div>
</section>
<!--banner-->
<!--product cards-->

<!--other cards-->
<div class="container" id="other">
  <div class="row">
    <div class="col-md-4 py-3 py-md-0">
      <div class="card">
        <img src="./images/all.webp" alt="">
        <div class="card-img-overlay">
          <h3>Home Gadget</h3>
          <p>Latest Collection Up To 50% Off</p>
        </div>
      </div>
    </div>
    <div class="col-md-4 py-3 py-md-0">
      <div class="card">
        <img src="./images/images (5).jpeg" alt="">
        <div class="card-img-overlay">
          <h3>Home Gadget</h3>
          <p>Latest Collection Up To 50% Off</p>
        </div>
      </div>
    </div>
    <div class="col-md-4 py-3 py-md-0">
      <div class="card">
        <img src="./images/Newstock.webp" alt="">
        <div class="card-img-overlay">
          <h3>Home Gadget</h3>
          <p>Latest Collection Up To 50% Off</p>
        </div>
      </div>
    </div>
  </div>
</div>
<!--product cards-->
<div class="Advertisement">
  <a href="#">
    <img src="images/Electronics Shop Facebook Ad Template.PNG" alt="">
  </a>
</div>

<!--offer-->
<div class="container" id="offer">
  <div class="row">
    <div class="col-md-3 py-3 py-md-0">
      <i class="fa-solid fa-truck-fast"></i>
      <h3>Free Shipping</h3>
      <p>On Order over $1000</p>
    </div>
    <div class="col-md-3 py-3 py-md-0">
      <i class="fa-solid fa-arrow-right-arrow-left"></i>
      <h3>Free Returns</h3>
      <p>Within 30 days</p>
    </div>
    <div class="col-md-3 py-3 py-md-0">
      <i class="fa-solid fa-truck"></i>
      <h3>Fast Delivery</h3>
      <p>World Wide</p>
    </div>
    <div class="col-md-3 py-3 py-md-0">
      <i class="fa-solid fa-cart-shopping"></i>
      <h3>Big Choice</h3>
      <p>Of Products</p>
    </div>
  </div>
</div>
<!--offer-->


<!--newslater-->
<div class="container" id="newslater">
  <h3 class="text-center">Subscribe To The Electronic Shop For Latest upload.</h3>
  <div class="input text-center">
    <input type="text" placeholder="Enter Your Email..">
    <button id="Subscribe">SUBSCRIBE</button>
  </div>
</div>
<!--newslater-->


<!-- footer -->
<footer id="footer">
  <div class="footer-top">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-6 footer-contact">
          <h3>Electronic Shop</h3>
          <p>
            Islamabad, i8 markaz,<br>
            peshawar main sadar, Pakistan<br>
          </p>
          <strong>Phone:</strong> +000000000000 <br>
          <strong>Email:</strong> electronicshop1@gamil.com <br>
        </div>
        
        <div class="col-lg-3 col-md-6 footer-links">
          <h3>Usefull Links</h3>
          <ul>
            <li><a href="Index.php">Home</a></li>
            <li><a href="About.html">About Us</a></li>
            <li><a href="Services.html">Services</a></li>
            <li><a href="Terms & Conditions.html">Terms & Conditions</a></li>
            <li><a href="privacy.html">Privacy policey</a></li>
          </ul>
        </div>
    
        <div class="col-lg-3 col-md-6 footer-links">
          <h3>Our Services</h3>

         <ul>
          <li><a href="#">PS 5</a></li>
          <li><a href="#">Computer</a></li>
          <li><a href="#">Gaming Laptop</a></li>
          <li><a href="#">Mobile Phone</a></li>
          <li><a href="#">Gaming Gadget</a></li>
         </ul>
        </div>

        <div class="col-lg-3 col-md-6 footer-links">
          <h3>Our Social Networks</h3>
          <p>Follow us in our social media platforms.</p>

          <div class="Social-links mt-3">
            <!-- Add icon library -->
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

          <!-- Add font awesome icons -->
          <h3>
          <a href="https://www.facebook.com/" class="fa fa-facebook"></a>
          <a href="https://m.twitter.com/" class="fa fa-twitter"></a>
          <a href="https://www.instagram.com/" class="fa fa-instagram"></a>
          <a href="https://www.google.com/" class="fa fa-google"></a>
          <a href="https://web.skype.com/" class="fa fa-skype"></a>
          ...
           </h3>
          </div>
        </div>
      </div>
    </div>
  </div>
  <hr>
  <div class="container py-4">
    <div class="copyright">
      &COPY; Copyright <strong><span>Electronic Shop</span></strong>.All Rights Reserved
    </div>
    <div class="credits">
      Designed by <a href="#">Abd Ullah</a>
    </div>
  </div>
</footer>
<!-- footer -->

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<!-- cookies Notice -->
  <div class="Cookies-container2">
          <h3 class="cookiess-top2">Cookies Notice</h3>
      
      <p class="cookiese-p">
          At Electronic Shop, we use cookies to improve your shopping experience and to personalize the
           content and ads you see. Cookies are small text files that are stored on your computer or mobile
           device when you visit a website. They allow us to remember your preferences and settings, so you 
           don't have to enter them each time you visit our site.
      </p>
      
      <b class="b-h">Types of cookies we use:</b>
      <br><br>
      <p class="cookies-li2">
      <li> <b>Essential cookies:</b> These cookies are necessary for the operation of our website and cannot be turned off.
           They allow you to navigate our site and use its features, such as the shopping cart.
      </li>
      <li><b>Performance cookies:</b> These cookies collect information about how you use our website, such as the 
          pages you visit and the links you click. We use this information to improve the performance and
          usability of our site.
      </li>
      <li><b>Functional cookies:</b> These cookies allow us to remember your preferences and settings, such 
          as your language and currency preferences. This helps us to personalize your shopping experience 
          and make it more convenient for you.
      </li>
      <li><b>Targeting cookies:</b> These cookies track your browsing activity across different websites
           and collect information about your interests. We use this information to show you personalized
            ads that are more likely to be of interest to you.
      </li>
      </p>
      <b class="b-h">More information:</b>
      <p>For more information about cookies, please visit the website of the Information Commissioner's Office (ICO):
           <a href="https://ico.org.uk/"> https://ico.org.uk/</a>
      </p>
      <a href="Cookies.html"><b>More....</b></a>
    </p>
      <br>
      <div class="bttn">
      <button id="acceptButton">Accept</button>
      <button id="rejectButton">Reject</button>
     </div>
  </div>
  <script>
      const cookiesContainer = document.querySelector('.Cookies-container2');
      const acceptButton = document.getElementById('acceptButton');
  const rejectButton = document.getElementById('rejectButton');
  
  acceptButton.addEventListener('click', () => {
    // Hide the cookies container on accept
    cookiesContainer.style.display = 'none';
  
    // Set a cookie to store user's acceptance
    document.cookie = 'cookiesAccepted=true; max-age=31536000; path=/';
  });
  
  rejectButton.addEventListener('click', () => {
    // Hide the cookies container on reject
    cookiesContainer.style.display = 'none';
  
    // Set a cookie to store user's rejection
    document.cookie = 'cookiesRejected=true; max-age=31536000; path=/';
  });
  const cookiesAccepted = document.cookie.includes('cookiesAccepted=true');
  const cookiesRejected = document.cookie.includes('cookiesRejected=true');
  
  if (cookiesAccepted || cookiesRejected) {
    cookiesContainer.style.display = 'none';
  }
  </script>
  
    </body>
</html>