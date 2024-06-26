<?php
include 'connect.php';
session_start();
//$admin_id=$_SESSION['admin_name'];
//if (!isset($admin_id)){
  // header('location:login.php');
   // if(isset($_POST['logout'])){
        //session_destroy();
       // header('location:login.php');
   // }
//} 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Panel </title>

    <!--font awesome-->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />

    <!--css file-->
    <link rel="stylesheet" href="dashboard.css" />
  </head>
  <body>
    <section class="sidebar">
      <a href="#" class="logo">
        <i class="fab fa-slack"></i>
        <span class="text">Admin Panel</span>
      </a>

      <ul class="side-menu top">
        <li class="active">
          <a href="#" class="nav-link">
            <i class="fas fa-border-all"></i>
            <span class="text">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="allp.html" class="nav-link">
            <i class="fas fa-shopping-cart"></i>
            <span class="text">My Store</span>
          </a>
        </li>
        <li>
          <a href="#" class="nav-link">
            <i class="fas fa-chart-simple"></i>
            <span class="text">Analytics</span>
          </a>
        </li>
        <li>
          <a href="#" class="nav-link">
            <i class="fas fa-message"></i>
            <?php
            $select_messages = mysqli_query($conn, "SELECT * FROM `messages`") or die("Query failed");
            $num_of_messages = mysqli_num_rows($select_messages);
               ?>
           <h3> <?php echo $num_of_messages; ?> </h3>
             <p>New messages</p>
          </a>
        </li>
        <li>
          <a href="#" class="nav-link">
            <i class="fas fa-people-group"></i>
            <span class="text">Team</span>
          </a>
        </li>
      </ul>

      <ul class="side-menu">
        <li>
          <a href="#">
            <i class="fas fa-cog"></i>
            <span class="text">Settings</span>
          </a>
        </li>
        
            <li>
              <a href="add-product-form.php">
                <i class="fa-solid fa-upload"></i>
                <span class="text">Add products</span>
              </a>
            </li>
        <li>
          <a href="#" class="logout">
            <i class="fas fa-right-from-bracket"></i>
            <span class="text">Logout</span>
          </a>
        </li>
      </ul>
    </section>

    <section class="content">
      <nav>
        <i class="fas fa-bars menu-btn"></i>
        <a href="#" class="nav-link">Categories</a>
        <form action="#">
          <div class="form-input">
            <input type="search" placeholder="search..." />
            <button class="search-btn">
              <i class="fas fa-search search-icon"></i>
            </button>
          </div>
        </form>

        <input type="checkbox" hidden id="switch-mode" />
        <label for="switch-mode" class="switch-mode"></label>

        <a href="#" class="notification">
          <i class="fas fa-bell"></i>
          <span class="num">28</span>
        </a>

        <a href="#" class="profile">
          <img src="profile.png" alt="" />
        </a>
      </nav>

      <main>
        <div class="head-title">
          <div class="left">
            <h1>Dashboard</h1>
            <ul class="breadcrumb">
              <li>
                <a href="#">Dashboard</a>
              </li>
              <i class="fas fa-chevron-right"></i>
              <li>
                <a href="Index.php" class="active">Home</a>
              </li>
            </ul>
          </div>

          <a href="#" class="download-btn">
            <i class="fas fa-cloud-download-alt"></i>
            <span class="text">Download Report</span>
          </a>
        </div>

        <div class="box-info">
          <li>
            <i class="fas fa-calendar-check"></i>
            <span class="text">
            <?php
          $select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die("Query failed");
         $num_of_orders = mysqli_num_rows($select_orders);
         ?>
        <h3> <?php echo $num_of_orders; ?> </h3>
        <p>New orders</p>
            </span>
          </li>
          <li>
            <i class="fas fa-people-group"></i>
            <span class="text">
            <?php
              $select_all_users = mysqli_query($conn, "SELECT * FROM `users`") or die("Query failed");
              $num_of_all_users = mysqli_num_rows($select_all_users);
              ?>
             <h3> <?php echo $num_of_all_users; ?> </h3>
          <p>users</p>
            </span>
          </li>
          <li>
            <i class="fas fa-dollar-sign"></i>
            <span class="text">
            <?php
$total_completes = 0;
$select_completes = mysqli_query($conn, "SELECT * FROM `orders` WHERE payment_status='complete'") or die("Query failed");
while ($fetch_completes = mysqli_fetch_assoc($select_completes)) {
    $total_completes += $fetch_completes['total_price'];
}
?>
<h3>$ <?php echo $total_completes; ?>/-</h3>
<p>Total SALE</p>
            </span>
          </li>
        </div>

        <div class="table-data">
          <div class="order">
            <div class="head">
              <h3>Recent Orders</h3>
              <i class="fas fa-search"></i>
              <i class="fas fa-filter"></i>
            </div>

            <table>
              <thead>
                <tr>
                  <th>User</th>
                  <th>Order Date</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <img src="images/ab4.jpg" alt="" />
                    <p>User Name</p>
                  </td>
                  <td>07-05-2023</td>
                  <td><span class="status pending">Pending</span></td>
                </tr>
                <tr>
                  <td>
                    <img src="images/ab3.png" alt="" />
                    <p>User Name</p>
                  </td>
                  <td>07-05-2023</td>
                  <td><span class="status pending">Pending</span></td>
                </tr>
                <tr>
                  <td>
                    <img src="profile.png" alt="" />
                    <p>User Name</p>
                  </td>
                  <td>07-05-2023</td>
                  <td><span class="status process">Process</span></td>
                </tr>
                <tr>
                  <td>
                    <img src="profile.png" alt="" />
                    <p>User Name</p>
                  </td>
                  <td>07-05-2023</td>
                  <td><span class="status process">Process</span></td>
                </tr>
                <tr>
                  <td>
                    <img src="profile.png" alt="" />
                    <p>User Name</p>
                  </td>
                  <td>07-05-2023</td>
                  <td><span class="status complete">Complete</span></td>
                </tr>
              </tbody>
            </table>
          </div>

          <div class="todo">
            <div class="head">
              <h3>Todos</h3>
              <i class="fas fa-plus"></i>
              <i class="fas fa-filter"></i>
            </div>

            <ul class="todo-list">
              <li class="not-completed">
                <p>Todo List</p>
                <i class="fas fa-ellipsis-vertical"></i>
              </li>
              <li class="not-completed">
                <p>Todo List</p>
                <i class="fas fa-ellipsis-vertical"></i>
              </li>
              <li class="completed">
                <p>Todo List</p>
                <i class="fas fa-ellipsis-vertical"></i>
              </li>
              <li class="completed">
                <p>Todo List</p>
                <i class="fas fa-ellipsis-vertical"></i>
              </li>
              <li class="completed">
                <p>Todo List</p>
                <i class="fas fa-ellipsis-vertical"></i>
              </li>
            </ul>
          </div>
        </div>
      </main>
    </section>

    <script src="dashboard.js"></script>
  </body>
</html>