<?php
  session_start();
  include('../../utils/connections.php');
  if (
    !isset($_SESSION['user_credentials.username']) &&
    !isset($_SESSION['user_credentials.type'])
  ) {
    header('Location: ../');
  } else if (isset($_SESSION['user_credentials.type'])) {
    if ($_SESSION['user_credentials.type'] != "admin") {
      header('Location: ../');
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Admin / Product Variants</title>
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
    <link rel="stylesheet" href="./css/pos.css" />
  </head>
  <body>
    <div id="nav-sidebar" class="sidebar-container slide-expanded">
      <div class="div-tm-title background-color-light-grey">
        <h4 class="h4-tm-title sans-700 color-dark-grey background-color-yellow">ICYLICIOUS&trade;</h4>
      </div>
      <div class="div-sidebar-logo">
        <i class="fa-solid fa-circle-user color-white" style="font-size: 30pt; margin-top: -8px"></i>
        <div>
          <h4 class="color-white sans-700 h6-title-name">
            <?php
              echo $_SESSION['user_info.first_name']." ".$_SESSION['user_info.last_name'];
            ?>
          </h4>
          <p class="color-yellow sans-regular p-title-email">
            <?php
              echo $_SESSION['user_info.email'];
            ?>
          </p>
        </div>
      </div>
      <div class="div-siderbar-menu-links">
        <button
          id="btn-dashboard"
          class="btn btn-outline-success btn-sm
            sans-regular 
            background-color-super-light-grey 
            border-color-super-light-grey 
            color-white 
            btn-menu 
            btn-menu-unselected"
          type="button">
          <i class="fa-solid fa-gauge-high"></i><span style="padding-left: 16px">Dashboard</span>
        </button>
        <button
          id="btn-user-management"
          class="btn btn-outline-success btn-sm
            sans-regular 
            background-color-super-light-grey 
            border-color-super-light-grey 
            color-white 
            btn-menu 
            btn-menu-unselected"
          type="button">
          <i class="fa-solid fa-users"></i><span style="padding-left: 13px">User Management</span>
        </button>
        <button 
          id="btn-categories"
          class="btn btn-outline-success btn-sm
            sans-regular 
            background-color-super-light-grey 
            border-color-super-light-grey 
            color-white 
            btn-menu 
            btn-menu-unselected"
          type="button">
          <i class="fa-solid fa-layer-group"></i><span style="padding-left: 16px">Product Categories</span>
        </button>
        <button 
          id="btn-products" 
          class="btn btn-outline-success btn-sm
            sans-regular 
            background-color-super-light-grey 
            border-color-super-light-grey 
            color-white 
            btn-menu 
            btn-menu-unselected"
          type="button">
          <i class="fa-solid fa-gifts"></i><span style="padding-left: 15px">Product Management</span>
        </button>
        <button
          id="btn-variants"
          class="btn btn-outline-success btn-sm
            sans-regular 
            background-color-super-light-grey 
            border-color-super-light-grey 
            color-white 
            btn-menu 
            btn-menu-unselected"
          type="button">
          <i class="fa-solid fa-tags"></i><span style="padding-left: 19px">Product Variants</span>
        </button>
        <button
          id="btn-orders"
          class="btn btn-outline-success btn-sm
            sans-regular 
            background-color-super-light-grey 
            border-color-super-light-grey 
            color-white 
            btn-menu 
            btn-menu-unselected"
          type="button">
          <i class="fa-solid fa-tags"></i><span style="padding-left: 19px">Orders</span>
        </button>
        <button 
          id="btn-pos" 
          class="btn btn-outline-success btn-sm
            sans-700 
            background-color-yellow 
            border-color-yellow 
            color-dark-grey 
            btn-menu 
            btn-menu-selected"
          type="button">
          <i class="fa-solid fa-money-bill-trend-up"></i><span style="padding-left: 16px">POS Panel</span>
        </button>
        <button 
          id="btn-settings" 
          class="btn btn-outline-success btn-sm
            sans-regular 
            background-color-super-light-grey 
            border-color-super-light-grey 
            color-white 
            btn-menu 
            btn-menu-unselected"
          type="button">
          <i class="fa-solid fa-gear"></i><span style="padding-left: 19px">Settings</span>
        </button>
      </div>
      <div class="div-siderbar-profile-links">
        <button
          class="btn btn-outline-success btn-sm
            sans-regular 
            color-white 
            btn-menu 
            btn-menu-unselected
            btn-logout"
          style="border: 0px"
          type="button">
          <i class="fa-solid fa-right-from-bracket"></i><span style="padding-left: 19px">Logout</span>
        </button>
      </div>
    </div>
    <div id="content-body" class="content content-slide-expanded">
      <nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary">
        <div class="container-fluid">
          <a class="navbar-brand sans-regular color-dark-grey a-navbar-path" href="#" style="cursor: default;">
            &nbsp;&nbsp;&nbsp;<i id="navbar-control" class="fa-solid fa-bars" style="cursor: pointer"></i>
            &nbsp;&nbsp;&nbsp;&nbsp;<b>Admin</b>&nbsp;
            <i class="fa-solid fa-chevron-right"></i>
            &nbsp;POS Panel
          </a>
        </div>
      </nav>
      <div>
        <div class="content-wrapper">
          <div class="div-content-title">
            <div class="div-content-title-labels">
              <h4 class="color-dark-grey sans-600" style="font-size: 13pt;">
                POS Panel
              </h4>
              <p class="color-super-light-grey sans-regular" style="font-size: 10pt;">
                Process orders and transactions quickly.
              </p>
            </div>
          </div>
          <div style="margin-top: 5px;">
            <nav class="nav">
              <?php
                $selected_category_name = 'All';
                if (isset($_GET['category_name'])) {
                  $selected_category_name = $_GET['category_name'];
                  if ($selected_category_name == 'All') {
                    echo '<a class="nav-link active color-yellow sans-bold" aria-current="page" href="./">All</a>';
                  } else {
                    echo '<a class="nav-link color-light-grey sans-500" aria-current="page" href="./">All</a>';
                  }
                } else {
                  echo '<a class="nav-link active color-yellow sans-bold" aria-current="page" href="./">All</a>';
                }
                $fetch_query = "SELECT * FROM categories ORDER BY id ASC";
                $result = $conn->query($fetch_query);
                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    $category_id = $row['id'];
                    $category_name = $row['category_name'];
                    $category_description = $row['category_description'];
                    $active_status = '';
                    if ($selected_category_name == $category_name) {
                      $active_status = 'nav-link color-yellow sans-bold active';
                    } else {
                      $active_status = 'nav-link color-light-grey sans-500';
                    }
                    echo '
                      <a
                        class="'.$active_status.'"
                        aria-current="page"
                        href="./?id='.$category_id.'&category_name='.$category_name.'&category_description='.$category_description.'">
                        '.$category_name.'
                      </a>
                    ';
                  }
                }
              ?>
            </nav>
            <div class="row">
              <div class="col-lg-8 col-md-8 col-sm-12">
                <div style="padding-top: 0px;">
                  <div class="row">
                    <?php
                      if (isset($_GET['id'])) {
                        $category_id = intval($_GET['id']);
                        $fetch_query = "SELECT * FROM products_categories WHERE category_id = ".$category_id."";
                        $category_result = $conn->query($fetch_query);
                        if ($category_result->num_rows > 0) {
                          while ($category_row = $category_result->fetch_assoc()) {
                            $product_id = $category_row['product_id'];
                            $fetch_query = "SELECT * FROM products_info WHERE id = ".$product_id." LIMIT 1";
                            $product_result = $conn->query($fetch_query);
                            if ($product_result->num_rows > 0) {
                              while ($product_row = $product_result->fetch_assoc()) {
                                $product_id = $product_row['id'];
                                $product_name = $product_row['product_name'];
                                $product_image = "";
                                $product_price = 0.00;
      
                                $fetch_query = "SELECT * FROM products_images WHERE product_id = ".$product_id." LIMIT 1";
                                $image_result = $conn->query($fetch_query);
                                if ($image_result->num_rows > 0) {
                                  $image_row = $image_result->fetch_assoc();
                                  $product_image = $image_row['product_image'];
                                }
      
                                $fetch_query = "SELECT * FROM products_prices WHERE product_id = ".$product_id." LIMIT 1";
                                $price_result = $conn->query($fetch_query);
                                if ($price_result->num_rows > 0) {
                                  $price_row = $price_result->fetch_assoc();
                                  $variant_price = $price_row['variant_price'];
                                  $product_price = floatval($variant_price);
                                  $fetch_query = "SELECT * FROM promotions WHERE product_id = ".$product_id." LIMIT 1";
                                  $promotions_result = $conn->query($fetch_query);
                                  if ($promotions_result->num_rows > 0) {
                                    $promotions_row = $promotions_result->fetch_assoc();
                                    $promotional_price = $promotions_row['promotional_price'];
                                    if ($promotional_price != "") {
                                      if ($promotional_price != 0) {
                                        $product_price = floatval($promotional_price);
                                      }
                                    }
                                  }
                                }
      
                                echo '
                                  <div
                                    onclick="onAddQuantity('."'".$product_id."'".')"
                                    class="col-lg-3 col-md-4 col-sm-6 div-pos-product-col">
                                    <div class="div-pos-product-container">
                                      <img
                                        src="../../admin/uploads/'.$product_image.'"
                                        class="img-product"
                                      />
                                      <h5 class="sans-600 size-09" style="margin-bottom: 0px !important; padding-inline: 7px;">
                                        '.$product_name.'
                                      </h5>
                                      <h3 class="color-dark-grey sans-bold size-12" style="flex: 1;">
                                        ₱'.number_format($product_price).'
                                      </h3>
                                    </div>
                                  </div>
                                ';
                              }
                            }
                          }
                        }
                      } else {
                        $fetch_query = "SELECT * FROM products_info";
                        $product_result = $conn->query($fetch_query);
                        if ($product_result->num_rows > 0) {
                          while ($product_row = $product_result->fetch_assoc()) {
                            $product_id = $product_row['id'];
                            $product_name = $product_row['product_name'];
                            $product_image = "";
                            $product_price = 0.00;
  
                            $fetch_query = "SELECT * FROM products_images WHERE product_id = ".$product_id." LIMIT 1";
                            $image_result = $conn->query($fetch_query);
                            if ($image_result->num_rows > 0) {
                              $image_row = $image_result->fetch_assoc();
                              $product_image = $image_row['product_image'];
                            }
  
                            $fetch_query = "SELECT * FROM products_prices WHERE product_id = ".$product_id." LIMIT 1";
                            $price_result = $conn->query($fetch_query);
                            if ($price_result->num_rows > 0) {
                              $price_row = $price_result->fetch_assoc();
                              $variant_price = $price_row['variant_price'];
                              $product_price = floatval($variant_price);
                              $fetch_query = "SELECT * FROM promotions WHERE product_id = ".$product_id." LIMIT 1";
                              $promotions_result = $conn->query($fetch_query);
                              if ($promotions_result->num_rows > 0) {
                                $promotions_row = $promotions_result->fetch_assoc();
                                $promotional_price = $promotions_row['promotional_price'];
                                if ($promotional_price != "") {
                                  if ($promotional_price != 0) {
                                    $product_price = floatval($promotional_price);
                                  }
                                }
                              }
                            }
  
                            echo '
                              <div
                                onclick="onAddQuantity('."'".$product_id."'".')"
                                class="col-lg-3 col-md-4 col-sm-6 div-pos-product-col">
                                <div class="div-pos-product-container">
                                  <img
                                    src="../../admin/uploads/'.$product_image.'"
                                    class="img-product"
                                  />
                                  <h5 class="sans-600 size-09" style="margin-bottom: 0px !important; padding-inline: 7px;">
                                    '.$product_name.'
                                  </h5>
                                  <h3 class="color-dark-grey sans-bold size-12">
                                    ₱'.number_format($product_price).'
                                  </h3>
                                </div>
                              </div>
                            ';
                          }
                        }
                      }
                    ?>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="div-checkout-container-form">
                  <form action="../actions/checkout.php" method="POST">
                    <h3 class="sans-600 size-15 h3-cart-item-title">
                      <i class="fa-solid fa-cart-shopping"></i>&nbsp;&nbsp;Cart Items
                    </h3>
                    <div class="div-cart-item-container-pos">
                      <div class="div-cart-item-pos">
                        <div class="div-cart-item-content-pos">
                          <span style="cursor: pointer;">
                            <i class="fa-solid fa-circle-xmark"></i>
                          </span>
                          <div>
                            <h4 class="sans-600 size-10" style="margin-bottom: 0px !important;">
                              (4) ORIGINAL CORN AND CREAM SMOOTHIE
                            </h4>
                            <p class="size-10" style="margin-bottom: 0px !important;">
                              <b>Size</b>: REGULAR
                            </p>
                          </div>
                        </div>
                        <h4 class="sans-600 size-10">₱255.00</h4>
                      </div>
                      <div class="div-cart-item-pos">
                        <div class="div-cart-item-content-pos">
                          <span style="cursor: pointer;">
                            <i class="fa-solid fa-circle-xmark"></i>
                          </span>
                          <div>
                            <h4 class="sans-600 size-10" style="margin-bottom: 0px !important;">
                              (4) ORIGINAL CORN AND CREAM SMOOTHIE
                            </h4>
                            <p class="size-10" style="margin-bottom: 0px !important;">
                              <b>Size</b>: REGULAR
                            </p>
                          </div>
                        </div>
                        <h4 class="sans-600 size-10">₱255.00</h4>
                      </div>
                      <div class="div-cart-item-pos">
                        <div class="div-cart-item-content-pos">
                          <span style="cursor: pointer;">
                            <i class="fa-solid fa-circle-xmark"></i>
                          </span>
                          <div>
                            <h4 class="sans-600 size-10" style="margin-bottom: 0px !important;">
                              (4) ORIGINAL CORN AND CREAM SMOOTHIE
                            </h4>
                            <p class="size-10" style="margin-bottom: 0px !important;">
                              <b>Size</b>: REGULAR
                            </p>
                          </div>
                        </div>
                        <h4 class="sans-600 size-10">₱255.00</h4>
                      </div>
                    </div>
                    <div class="div-cart-total-container-pos">
                      <div class="div-cart-total-container-item-pos">
                        <h4 class="sans-600 size-10" style="flex: 1; margin-bottom: 0px !important;">Subtotal</h4>
                        <h4 class="sans-600 size-10" style="margin-bottom: 0px !important;">₱255.00</h4>
                      </div>
                      <div class="div-cart-total-container-item-pos">
                        <h4 class="sans-600 size-10" style="flex: 1; margin-bottom: 0px !important;">VAT</h4>
                        <h4 class="sans-600 size-10" style="margin-bottom: 0px !important;">₱0.00</h4>
                      </div>
                      <div class="div-cart-total-container-item-pos">
                        <h4 class="sans-600 size-13" style="flex: 1; margin-bottom: 0px !important;">Total</h4>
                        <h4 class="sans-600 size-13" style="margin-bottom: 0px !important;">₱255.00</h4>
                      </div>
                    </div>
                    <div style="display: flex; flex-direction: row; gap: 12px; margin-top: 15px;">
                      <button class="btn btn-danger btn-reset-order sans-600" style="flex: 1;">
                        <i class="fa-solid fa-circle-xmark"></i>&nbsp;&nbsp;Reset
                      </button>
                      <button class="btn btn-primary btn-checkout-order sans-600" style="flex: 1;">
                        <i class="fa-regular fa-credit-card"></i>&nbsp;&nbsp;Checkout
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            <div>
          </div>
        </div>
      </div>
    </div>
    <div id="div-overlay-content" class="overlay-content"></div>
    <div
      class="modal fade" 
      id="staticCancelOrder" 
      data-bs-backdrop="static" 
      data-bs-keyboard="false" 
      tabindex="-1" 
      aria-labelledby="staticBackdropLabel" 
      aria-hidden="true">
      <div class="modal-dialog modal-md modal-dialog-centered">
        <form action="../actions/cancel_order.php" method="POST">
          <input id="cancel_order" type="hidden" name="order_id" />
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5 sans-600" id="staticBackdropLabel">Cancel This Order?</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <p class="sans-regular size-14">Are you sure you want to cancel this order?. It cannot be undone.</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary sans-600" data-bs-dismiss="modal">Dismiss</button>
              <button type="submit" class="btn btn-primary sans-600">Cancel Order</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <div
      class="modal fade" 
      id="staticAddQuantity" 
      data-bs-backdrop="static" 
      data-bs-keyboard="false" 
      tabindex="-1" 
      aria-labelledby="staticBackdropLabel" 
      aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <form action="../actions/add_order.php" method="POST">
          <input id="product_id" type="hidden" name="product_id" />
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5 sans-600" id="staticBackdropLabel">Add Quantity</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div style="width: 400px;">
                <label for="product_quantity" class="sans-600">Product Quantity</label>
                <input
                  type="number"
                  name="product_quantity"
                  placeholder="Quantity (eg. 1)"
                  class="form-control sans-600"
                  required
                  value="1"
                />
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary sans-600" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary sans-600">Add To Cart</button>
            </div>
          </div>
        </form>
      </div>
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
    $(document).ready(() => {
      $('#btn-dashboard').click(() => {
        window.location.href = "../dashboard";
      });
      $('#btn-user-management').click(() => {
        window.location.href = "../users";
      });
      $('#btn-categories').click(() => {
        window.location.href = "../categories";
      });
      $('#btn-products').click(() => {
        window.location.href = "../products";
      });
      $('#btn-variants').click(() => {
        window.location.href = "../variants";
      });
      $('#btn-orders').click(() => {
        window.location.href = "../orders";
      });
      $('#btn-pos').click(() => {
        window.location.href = "./";
      });
      $('#btn-settings').click(() => {
        window.location.href = "../settings";
      });
      $('.btn-logout').click(() => {
        window.location.href = "../actions/logout.php";
      });
      $('#data').dataTable({
        'bLengthChange': false,
        'searching': false
      });
    });
  </script>
  <script type="text/javascript">
    const onAddQuantity = (product_id) => {
      $('#staticAddQuantity').modal('show');
      $('#product_id').val(product_id);
    };
  </script>
  <script type="text/javascript">
    const onViewOrder = (
      order_id,
      first_name,
      last_name,
      email,
      phone,
      address,
      order_date,
      order_time,
      order_quantity,
      product_name,
      product_variant_type,
      product_variant_name,
      price,
      shipping_name,
      shipping_number,
      shipping_address,
      payment_type,
      order_status,
    ) => {
      $('#order_id').val(order_id);
      $('#order_fn').val(first_name);
      $('#order_ln').val(last_name);
      $('#order_email').val(email);
      $('#order_phone').val(phone);
      $('#order_address').val(address);
      $('#order_details').val(
        'Order Details\n' +
        '- Date Time: ' + order_date + ' ' + order_time + '\n' +
        '- ( ' + order_quantity + ' ) ' + product_name + ', ' + product_variant_name + '\n' +
        '- Total price: ₱' + price + '\n\n' +
        'Shipping Details: \n' +
        '- ' + shipping_name + '\n' +
        '- ' + shipping_number + '\n' +
        '- ' + shipping_address + '\n' +
        '- Payment type: ' + payment_type
      );
      $('#order_total').text('₱' + price);
    }
    const onCancelOrder = (order_id) => {
      $('#staticCancelOrder').modal('show');
      $('#cancel_order').val(order_id);
    }
  </script>
  <script type="text/javascript">
    let isCollapsed = false;
    $('#navbar-control').click(() => {
      if (isCollapsed) {
        $('#content-body').removeClass('content-slide-collapsed');
        $('#nav-sidebar').removeClass('slide-collapsed');
        $('#content-body').addClass('content-slide-expanded');
        $('#nav-sidebar').addClass('slide-expanded');
        $('#div-overlay-content').removeClass('overlay-content-collapsed');
        $('#div-overlay-content').addClass('overlay-content-expand');
        isCollapsed = false;
      } else {
        $('#content-body').removeClass('content-slide-expanded');
        $('#nav-sidebar').removeClass('slide-expanded');
        $('#content-body').addClass('content-slide-collapsed');
        $('#nav-sidebar').addClass('slide-collapsed');
        $('#div-overlay-content').removeClass('overlay-content-expand');
        $('#div-overlay-content').addClass('overlay-content-collapsed');
        isCollapsed = true;
      }
    });
    $('#div-overlay-content').click(() => {
      $('#content-body').removeClass('content-slide-expanded');
      $('#nav-sidebar').removeClass('slide-expanded');
      $('#content-body').addClass('content-slide-collapsed');
      $('#nav-sidebar').addClass('slide-collapsed');
      $('#div-overlay-content').removeClass('overlay-content-expand');
      $('#div-overlay-content').addClass('overlay-content-collapsed');
      isCollapsed = true;
    });
  </script>
</html>
