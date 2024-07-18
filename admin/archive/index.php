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
    <title>Admin / Product Management</title>
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
    <link rel="stylesheet" href="./css/archive.css" />
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
          <i class="fa-solid fa-file-zipper"></i><span style="padding-left: 19px">Product Management</span>
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
          <i class="fa-solid fa-cart-shopping"></i><span style="padding-left: 16px">Orders</span>
        </button>
        <button
          id="btn-pos"
          class="btn btn-outline-success btn-sm
            sans-regular 
            background-color-super-light-grey 
            border-color-super-light-grey 
            color-white 
            btn-menu 
            btn-menu-unselected"
          type="button">
          <i class="fa-solid fa-money-bill-trend-up"></i><span style="padding-left: 19px">POS Panel</span>
        </button>
        <button 
          id="btn-logs" 
          class="btn btn-outline-success btn-sm
            sans-regular 
            background-color-super-light-grey 
            border-color-super-light-grey 
            color-white 
            btn-menu 
            btn-menu-unselected"
          type="button">
          <i class="fa-solid fa-chart-line"></i><span style="padding-left: 19px">Activity Logs</span>
        </button>
        <button 
          id="btn-archives" 
          class="btn btn-outline-success btn-sm
            sans-700 
            background-color-yellow 
            border-color-yellow 
            color-dark-grey 
            btn-menu 
            btn-menu-selected"
          type="button">
          <i class="fa-solid fa-file-zipper"></i><span style="padding-left: 23px">Archive</span>
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
            &nbsp;Archive
          </a>
        </div>
      </nav>
      <div>
        <div class="content-wrapper">
          <div class="div-content-title">
            <div class="div-content-title-labels">
              <h4 class="color-dark-grey sans-600" style="font-size: 13pt;">
                Archived products
              </h4>
              <p class="color-super-light-grey sans-regular" style="font-size: 10pt;">
                Products being archived will be displayed here. You can keep or permanently removed products and associated information.
              </p>
            </div>
            <div class="div-content-title-actions">
            </div>
          </div>
          <div style="margin-top: 20px;">
            <table id="data" class="table table-striped" style="width:100%">
              <thead>
                <tr>
                  <th class="sans-bold">(Name)</th>
                  <th class="sans-bold">(Description)</th>
                  <th class="sans-bold">(Category)</th>
                  <th class="sans-bold">(Variants)</th>
                  <th class="sans-bold">(Actions)</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $fetch_query = "SELECT * FROM products_info WHERE product_status = 'ARCHIVED' ORDER BY id DESC";
                  $result = $conn->query($fetch_query);
                  if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                      $product_id = $row['id'];
                      $product_name = $row['product_name'];
                      $product_description = $row['product_description'];
                      $product_category = "";
                      $product_category_id = 0;
                      $product_variant = "";
                      $product_variant_id = 0;
                      $product_variant_price = 0;
                      $promotional_price = 0;
                      $is_buy_x_take_x = -1;
                      $buy_x_of = 0;
                      $take_x_of = 0;
                      $product_images = array();
                      // fetch categories
                      $fetch_query = "SELECT PC.category_id, CTG.category_name, CTG.category_description, CTG.id 
                        FROM products_categories AS PC 
                        INNER JOIN categories AS CTG ON
                        PC.category_id = CTG.id 
                        WHERE PC.product_id = ".$product_id."";
                      $cat_result = $conn->query($fetch_query);
                      if ($cat_result->num_rows > 0) {
                        $cat_row = $cat_result->fetch_assoc();
                        $product_category = $cat_row['category_name'];
                        $product_category_id = $cat_row['id'];
                      }
                      // fetch variants and prices
                      $fetch_query = "SELECT PP.variant_id, PP.variant_price, VT.variant_name, VT.variant_description, VT.id 
                        FROM products_prices AS PP 
                        INNER JOIN variants AS VT ON
                        PP.variant_id = VT.id 
                        WHERE PP.product_id = ".$product_id."";
                      $var_result = $conn->query($fetch_query);
                      if ($var_result->num_rows > 0) {
                        $var_row = $var_result->fetch_assoc();
                        $product_variant_id = $var_row['id'];
                        $product_variant_price = $var_row['variant_price'];
                        $product_variant = $var_row['variant_name'];
                      }
                      // fetch promotions
                      $fetch_query = "SELECT PM.product_id, PM.promotional_price, PM.is_buy_x_take_x, PM.buy_x_of, PM.take_x_of 
                        FROM PROMOTIONS AS PM 
                        WHERE PM.product_id = ".$product_id."";
                      $prom_result = $conn->query($fetch_query);
                      if ($prom_result->num_rows > 0) {
                        $prom_row = $prom_result->fetch_assoc();
                        $promotional_price = $prom_row['promotional_price'];
                        $is_buy_x_take_x = $prom_row['is_buy_x_take_x'];
                        $buy_x_of = $prom_row['buy_x_of'];
                        $take_x_of = $prom_row['take_x_of'];
                      }
                      // fetch product images
                      $fetch_query = "SELECT product_image FROM products_images WHERE product_id = ".$product_id."";
                      $img_result = $conn->query($fetch_query);
                      if ($img_result->num_rows > 0) {
                        while ($img_row = $img_result->fetch_assoc()) {
                          $image = $img_row['product_image'];
                          array_push($product_images, $image);
                        }
                      }
                      $final_prod_images = implode(',', $product_images);
                      echo '
                        <tr>
                          <td class="sans-600">
                            '.$product_name.'
                          </td>
                          <td class="sans-regular">
                            '.$product_description.'
                          </td>
                          <td class="sans-700">
                            '.$product_category.'
                          </td>
                          <td class="sans-regular">
                            '.$product_variant.'
                          </td>
                          <td>
                            <button
                              onclick="onRemoveFromArchive(
                                '."'".$product_id."'".'
                              )"
                              class="btn btn-outline-primary btn-sm 
                                sans-400 
                                color-white"
                              type="button">
                              <i class="fa-regular fa-file-zipper"></i>
                            </button>
                            <button
                              onclick="onDeleteProduct(
                                '."'".$product_id."'".'
                              )"
                              class="btn btn-outline-primary btn-sm 
                                sans-400 
                                color-white"
                              type="button">
                              <i class="fa-solid fa-trash"></i>
                            </button>
                          </td>
                        </tr>
                      ';
                    }
                  }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div
      class="modal fade" 
      id="staticArchiveProduct" 
      data-bs-backdrop="static" 
      data-bs-keyboard="false" 
      tabindex="-1" 
      aria-labelledby="staticBackdropLabel" 
      aria-hidden="true">
      <div class="modal-dialog modal-md modal-dialog-centered">
        <form action="../actions/archive.php" method="POST">
          <input id="archive-pid" type="hidden" name="product_id" />
          <input type="hidden" name="archive_status" value="ACTIVE" />
          <input type="hidden" name="redirection" value="archive" />
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5 sans-600" id="staticBackdropLabel">Unarchive This Product?</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <p class="sans-regular size-14">Are you sure you want to remove this product from archive?. This will make the product's status to <b>ACTIVE</b>.</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary sans-600" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary sans-600">Unarchive Product</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <div
      class="modal fade" 
      id="staticDeleteProduct" 
      data-bs-backdrop="static" 
      data-bs-keyboard="false" 
      tabindex="-1" 
      aria-labelledby="staticBackdropLabel" 
      aria-hidden="true">
      <div class="modal-dialog modal-md modal-dialog-centered">
        <form action="../actions/delete_product.php" method="POST">
          <input id="delete-pid" type="hidden" name="product_id" />
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5 sans-600" id="staticBackdropLabel">Delete This Product?</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <p class="sans-regular size-14">Are you sure you want to delete this product?. It cannot be undone.</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary sans-600" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary sans-600">Delete Product</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <div id="div-overlay-content" class="overlay-content"></div>
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
        window.location.href = "../pos";
      });
      $('#btn-logs').click(() => {
        window.location.href = "../logs";
      });
      $('#btn-archives').click(() => {
        window.location.href = "./";
      });
      $('#btn-settings').click(() => {
        window.location.href = "../settings";
      });
      $('.btn-logout').click(() => {
        window.location.href = "../actions/logout.php";
      });
      $('#data').dataTable({
        'bLengthChange': true,
        'searching': true
      });
    });
  </script>
  <script type="text/javascript" src="./js/add_products.js"></script>
  <script type="text/javascript" src="./js/edit_products.js"></script>
  <script type="text/javascript">
    const onDeleteProduct = (product_id) => {
      $('#staticDeleteProduct').modal('show');
      $('#delete-pid').val(product_id);
    }
    const onRemoveFromArchive = (product_id) => {
      $('#staticArchiveProduct').modal('show');
      $('#archive-pid').val(product_id);
    }
  </script>
  <script type="text/javascript">
    $(document).ready(() => {
      $('#btn-archive').click(() => {
        const product_id = $('#ed-product_id').val();
        window.location.href = `../actions/archive.php?product_id=${product_id}`;
      });
    });
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
