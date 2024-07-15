<?php
  session_start();
  include('../../utils/connections.php');
  if (
    isset($_SESSION['user_credentials.username']) &&
    isset($_SESSION['user_credentials.type'])
  ) {
    if ($_SESSION['user_credentials.type'] != "customer") {
      header('Location: ../../admin/');
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>ICYLICIOUS&trade;</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    >
    <link href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap5.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/global.css" />
    <link rel="stylesheet" href="./css/orders.css" />
  </head>
  <body>
    <nav class="navbar navbar-expand-lg fixed-top bg-dark">
      <div class="container">
        <a class="navbar-brand sans-600 color-white" href="./">ICYLICIOUS&trade;</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fa-solid fa-bars color-white"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link sans-regular size-11" aria-current="page" href="../../">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link sans-regular size-11" aria-current="page" href="../products/">Menu</a>
            </li>
            <li class="nav-item">
              <a class="nav-link sans-regular size-11" aria-current="page" href="../../index.php#reviews">Reviews</a>
            </li>
            <li class="nav-item">
              <a class="nav-link sans-regular size-11" aria-current="page" href="#contact-us">Contact Us</a>
            </li>
          </ul>
          <form class="d-flex">
            <?php
              if (isset($_SESSION['user_credentials.type'])) {
                $credentials = $_SESSION['user_credentials.type'];
                $cart_quantity = "";
                if (isset($_SESSION['user_info.email'])) {
                  $fetch_query = "SELECT * FROM cart WHERE user_email = '".$_SESSION['user_info.email']."'";
                  $result = $conn->query($fetch_query);
                  if ($result->num_rows > 0) {
                    $order_quantity = 0;
                    while ($cart_row = $result->fetch_assoc()) {
                      $order_quantity += intval($cart_row['order_quantity']);
                    }
                    $cart_quantity = " (". strval($order_quantity) . ") ";
                  }
                }
                if ($credentials === "customer") {
                  echo '
                    <button
                      id="btn-profile"
                      class="btn btn-sm btn-primary sans-500"
                      type="button">
                      <i class="fas fa-user-circle"></i>&nbsp;&nbsp;Account
                    </button>&nbsp;&nbsp;
                    <button
                      id="btn-shopping-cart"
                      class="btn btn-sm btn-outline-primary sans-500"
                      type="button">
                      <i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;Shopping Cart'.$cart_quantity.'
                    </button>
                  ';
                } else {
                  echo '
                    <button
                      data-bs-toggle="modal"
                      data-bs-target="#staticLogin"
                      class="btn btn-sm btn-primary sans-500"
                      type="button">
                      Login
                    </button>&nbsp;&nbsp;
                    <button
                      data-bs-toggle="modal"
                      data-bs-target="#staticSignUp"
                      class="btn btn-sm btn-outline-primary sans-500"
                      type="button">
                      Sign Up
                    </button>
                  ';
                }
              } else {
                echo '
                  <button
                    data-bs-toggle="modal"
                    data-bs-target="#staticLogin"
                    class="btn btn-sm btn-primary sans-500"
                    type="button">
                    Login
                  </button>&nbsp;&nbsp;
                  <button
                    data-bs-toggle="modal"
                    data-bs-target="#staticSignUp"
                    class="btn btn-sm btn-outline-primary sans-500"
                    type="button">
                    Sign Up
                  </button>
                ';
              }
            ?>
          </form>
        </div>
      </div>
    </nav>
    <div class="content-wrapper">
      <div class="row">
        <div class="col-lg-1"></div>
        <div class="col-lg-10 col-md-12 col-sm-12">
          <div class="div-account-container">
            <div class="row">
              <div class="col-lg-3 col-md-4 col-sm-12">
                <div class="div-account-left">
                  <!-- <i class="fas fa-user-circle" style="font-size: 20pt;"></i> -->
                  <button id="btn-update-profile" class="btn btn-outline-primary sans-600 btn-profile-actions">
                    <i class="fas fa-user-circle"></i>&nbsp;&nbsp;Edit Profile
                  </button>
                  <button id="btn-my-orders" class="btn btn-primary sans-600 btn-profile-actions">
                    <i class="fa-solid fa-chart-line"></i>&nbsp;&nbsp;My Orders
                  </button>
                  <button id="btn-logout" class="btn btn-outline-primary sans-600 btn-profile-actions">
                    <i class="fa-solid fa-right-from-bracket"></i>&nbsp;&nbsp;Logout
                  </button>
                </div>
              </div>
              <div class="col-lg-9 col-md-8 col-sm-12">
                <div id="div-edit-profile">
                  <h3 class="sans-600 color-dark-grey">My Orders</h3>
                  <p class="sans-regular">Keep track of your orders.</p>
                  <table id="data" class="table table-striped" style="width:100%">
                    <thead>
                      <tr>
                      <th class="sans-bold">Order</th>
                      <th class="sans-bold">Date Time</th>
                      <th class="sans-bold">Price</th>
                      <th class="sans-bold">Status</th>
                      <th class="sans-bold">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        if (isset($_SESSION['user_info.email'])) {
                          $fetch_query = "SELECT * FROM orders WHERE user_email = '".$_SESSION['user_info.email']."' ORDER BY id DESC";
                          $result = $conn->query($fetch_query);
                          if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                              $order_id = $row['id'];
                              $product_id = $row['product_id'];
                              $variant_id = $row['variant_id'];
                              $variant_type = $row['variant_type'];
                              $variant_name = $row['variant_name'];
                              $order_date = $row['order_date'];
                              $order_time = $row['order_time'];
                              $order_quantity = $row['order_quantity'];
                              $order_status = $row['order_status'];
                              $order_total = floatval($row['order_total']);

                              $row_product_name = $row['product_name'];
                              $row_product_price = number_format($order_total);
                              $row_variant = '
                                <div style="padding-top: 5px; display: flex; flex-direction: row; sans-regular size-10 color-light-grey">
                                  '.$variant_type.':&nbsp;&nbsp;
                                  <span class="badge-size color-light-grey sans-regular size-10">
                                    '.$variant_name.'
                                  </span>
                                </div>
                              ';
                              $row_status_type = "";
                              $row_status_name = "";
                              $row_action_status = "";

                              if ($order_status == 'PROCESSING') {
                                $row_status_type = "badge-processing";
                                $row_status_name = $order_status;
                              } else if ($order_status == 'SERVING') {
                                $row_status_type = "badge-serving";
                                $row_status_name = $order_status;
                                $row_action_status = "disabled";
                              } else if ($order_status == 'CANCELLED') {
                                $row_status_type = "badge-cancelled";
                                $row_status_name = $order_status;
                                $row_action_status = "disabled";
                              } else if ($order_status == 'FULFILLED') {
                                $row_status_type = "badge-fulfilled";
                                $row_status_name = $order_status;
                                $row_action_status = "disabled";
                              }

                              echo '
                                <tr>
                                  <td class="sans-600">
                                    ('.$order_quantity.') '.$row_product_name.'
                                    <div style="padding-top: 5px; display: flex; flex-direction: row; sans-regular size-10 color-light-grey">
                                      '.$variant_type.':&nbsp;&nbsp;
                                      <span class="badge-size color-light-grey sans-regular size-10">
                                        '.$variant_name.'
                                      </span>
                                    </div>
                                    <div style="height: 20px;"></div>
                                  </td>
                                  <td class="sans-regular">
                                    '.$order_date.'<br/>'.$order_time.'
                                  </td>
                                  <td class="sans-600">
                                    ₱'.$row_product_price.'
                                  </td>
                                  <td class="sans-regular" style="font-size: 9pt;">
                                    <span class="'.$row_status_type.'">'.$row_status_name.'</span>
                                  </td>
                                  <td>
                                    <form action="../actions/update_orders.php" method="POST">
                                      <input type="hidden" name="order_id" value="'.$order_id.'" />
                                      <button
                                        '.$row_action_status.'
                                        class="btn btn-outline-danger btn-sm sans-400" type="submit">
                                        <i class="fa-solid fa-circle-xmark"></i>&nbsp;&nbsp;Cancel
                                      </button>
                                    </form>
                                  </td>
                                </tr>
                              ';
                            }
                          }
                        }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-1"></div>
      </div>
      <div class="container">
      </div>
      <div id="contact-us" class="div-contact-us">
        <div class="container">
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
              <h3 class="sans-600 color-dark-grey">Contact Us</h3>
              <form action="../actions/contact_us.php" method="POST">
                <div style="display: flex; gap: 10px; margin-top: 20px;">
                  <div style="flex: 1">
                    <input
                      type="text"
                      placeholder="First Name"
                      name="first_name"
                      required
                      class="form-control sans-regular"
                    />
                  </div>
                  <div style="flex: 1">
                    <input
                      type="text"
                      placeholder="Last Name"
                      name="last_name"
                      required
                      class="form-control sans-regular"
                    />
                  </div>
                </div>
                <input
                  type="email"
                  placeholder="Email Address (eg. myemail@gmail.com)"
                  name="email"
                  required
                  class="form-control sans-regular"
                  style="margin-top: 10px;"
                />
                <input
                  type="number"
                  placeholder="Mobile No. (eg. +639__)"
                  name="phone"
                  required
                  class="form-control sans-regular"
                  style="margin-top: 10px;"
                />
                <input
                  type="text"
                  placeholder="Subject"
                  name="subject"
                  required
                  class="form-control sans-regular"
                  style="margin-top: 10px;"
                />
                <label for="description" class="sans-600" style="margin-top: 10px;">Description (Intent)</label>
                <textarea
                  name="description" 
                  class="form-control sans-regular" 
                  rows="5" 
                  required 
                  style="margin-top: 7px;"></textarea>
                <button
                  class="btn btn-lg btn-primary sans-600"
                  type="submit"
                  style="margin-top: 30px;">
                  Submit
                </button>
                &nbsp;
                <button
                  class="btn btn-lg btn-outline-primary btn-reset sans-600"
                  type="reset"
                  style="margin-top: 30px;">
                  Reset
                </button>
              </form>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
              <img src="../../assets/images/about_us_logo.png" class="img-about-us" />
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="div-sub-footer">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-4 col-sm-12">
            <h4 class="color-white sans-600 size-14">About Us</h4>
            <p class="color-light-white sans-regular size-11">
              Satisfying your palates since 2019. From Maranon St., San Narciso, Philippines, we offer in-store
              pickup. Experience the ultimate taste of ICY.<br/>
              Follow us on <a class="color-yellow" href="https://web.facebook.com/icyliciousph">Facebook</a>
              for more exclusive updates.
            </p>
          </div>
          <div class="col-lg-1"></div>
          <div class="col-lg-2 col-md-4 col-sm-12">
            <h4 class="color-white sans-600 size-14">Page Links</h4>
            <ul class="navbar-nav">
              <li class="nav-item" style="padding-left: 0px !important;">
                <a class="nav-link sans-regular size-11 footer-nav-link" aria-current="page" href="../../">Home (Homepage)</a>
              </li>
              <li class="nav-item" style="padding-left: 0px !important;">
                <a class="nav-link sans-regular size-11 footer-nav-link" aria-current="page" href="../products/">Menu (Products)</a>
              </li>
              <li class="nav-item" style="padding-left: 0px !important;">
                <a class="nav-link sans-regular size-11 footer-nav-link" aria-current="page" href="../../index.php#reviews">Reviews (Testimonials)</a>
              </li>
              <li class="nav-item" style="padding-left: 0px !important;">
                <a class="nav-link sans-regular size-11 footer-nav-link" aria-current="page" href="#contact-us">Contact Us (Reach out!)</a>
              </li>
            </ul>
          </div>
          <div class="col-lg-1"></div>
          <div class="col-lg-2 col-md-4 col-sm-12">
            <h4 class="color-white sans-600 size-14">Social Links</h4>
            <ul class="navbar-nav">
              <li class="nav-item" style="padding-left: 0px !important;">
                <a class="nav-link sans-regular size-11 footer-nav-link" aria-current="page" href="./">Facebook</a>
              </li>
              <li class="nav-item" style="padding-left: 0px !important;">
                <a class="nav-link sans-regular size-11 footer-nav-link" aria-current="page" href="./">Instagram</a>
              </li>
              <li class="nav-item" style="padding-left: 0px !important;">
                <a class="nav-link sans-regular size-11 footer-nav-link" aria-current="page" href="./">Twitter (X)</a>
              </li>
              <li class="nav-item" style="padding-left: 0px !important;">
                <a class="nav-link sans-regular size-11 footer-nav-link" aria-current="page" href="-./">Google E-mail</a>
              </li>
            </ul>
          </div>
          <div class="col-lg-3 col-md-4 col-sm-12 div-account-buttons">
            <button
              data-bs-toggle="modal"
              data-bs-target="#staticLogin"
              class="btn btn-lg btn-primary sans-500"
              type="button">
              Login
            </button>
            <button
              data-bs-toggle="modal"
              data-bs-target="#staticSignUp"
              class="btn btn-lg btn-outline-primary sans-500"
              type="button">
              Sign Up
            </button>
          </div>
        </div>
      </div>
    </div>
    <div class="div-footer">
      <h6 class="sans-regular" style="padding-top: 7px;">&#169; 2024 All rights reserved.</h6>
    </div>
  </body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://kit.fontawesome.com/b2e03e5a6f.js" crossorigin="anonymous"></script>
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous">
  </script>
  <script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
  <script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap5.js"></script>
  <script type="text/javascript">
    $('#data').dataTable({
      'bLengthChange': false,
      'searching': false
    });
  </script>
  <script type="text/javascript">
    $(document).ready(() => {
      $('#btn-profile').click(() => {
        window.location.href = "../account";
      });
      $('#btn-shopping-cart').click(() => {
        window.location.href = "../cart";
      });
      $('#btn-logout').click(() => {
        window.location.href = "../actions/logout.php";
      });
      $('#btn-my-orders').click(() => {
        window.location.href = "./";
      });
      $('#btn-update-profile').click(() => {
        window.location.href = "../account";
      });
    });
  </script>
  <script type="text/javascript">
    const alertMessage = (message) => {
      window.alert(message);
    };
    <?php
      if (
        isset($_SESSION['errors.type']) &&
        isset($_SESSION['errors.title']) &&
        isset($_SESSION['errors.message'])
      ) {
        echo '
          window.onload = () => {
            setTimeout(() => {
              alertMessage("'.$_SESSION['errors.message'].'");
            }, 500);
          };
        ';
        unset($_SESSION['errors.type']);
        unset($_SESSION['errors.title']);
        unset($_SESSION['errors.message']);
      }
      if (isset($_SESSION['cart.message'])) {
        echo '
          window.onload = () => {
            setTimeout(() => {
              alertMessage("'.$_SESSION['cart.message'].'");
            }, 500);
          };
        ';
        unset($_SESSION['cart.message']);
      }
      if (isset($_SESSION['update_orders'])) {
        echo '
          window.onload = () => {
            setTimeout(() => {
              alertMessage("'.$_SESSION['update_orders'].'");
            }, 500);
          };
        ';
        unset($_SESSION['update_orders']);
      }
    ?>
  </script>
</html>
