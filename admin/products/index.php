<?php
  session_start();
  include('../../utils/connections.php');
  if (
    !isset($_SESSION['user_credentials.username']) &&
    !isset($_SESSION['user_credentials.type'])
  ) {
    header('Location: ../');
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
    <link rel="stylesheet" href="./css/products.css" />
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
            sans-700 
            background-color-yellow 
            border-color-yellow 
            color-dark-grey 
            btn-menu 
            btn-menu-selected"
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
          <i class="fa-solid fa-cart-shopping"></i><span style="padding-left: 16px">Orders</span>
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
            &nbsp;Product Management
          </a>
        </div>
      </nav>
      <div>
        <div class="content-wrapper">
          <div class="div-content-title">
            <div class="div-content-title-labels">
              <h4 class="color-dark-grey sans-600" style="font-size: 13pt;">
                Manage products
              </h4>
              <p class="color-super-light-grey sans-regular" style="font-size: 10pt;">
                Add, update, remove, and view products' information.
              </p>
            </div>
            <div class="div-content-title-actions">
              <button
                data-bs-toggle="modal"
                data-bs-target="#staticAddNewProduct"
                class="btn btn-outline-primary btn-sm sans-400"
                type="button">
                <i class="fa-solid fa-circle-plus"></i>&nbsp;&nbsp;Add New Product
              </button>
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
                  $fetch_query = "SELECT * FROM products_info ORDER BY id DESC";
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
                              onclick="onEditProduct(
                                '."'".$product_id."',".'
                                '."'".$product_name."',".'
                                '."'".$product_description."',".'
                                '."'".$product_category_id."',".'
                                '."'".$product_variant_id."',".'
                                '."'".$product_variant_price."',".'
                                '."'".$promotional_price."',".'
                                '."'".$is_buy_x_take_x."',".'
                                '."'".$buy_x_of."',".'
                                '."'".$take_x_of."',".'
                                '."'".$final_prod_images."'".'
                              )"
                              class="btn btn-outline-primary btn-sm 
                                sans-400 
                                color-white"
                              type="button">
                              <i class="fa-solid fa-pen-to-square"></i>
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
    <div
      class="modal fade" 
      id="staticAddNewProduct" 
      data-bs-backdrop="static" 
      data-bs-keyboard="false" 
      tabindex="-1" 
      aria-labelledby="staticBackdropLabel" 
      aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-xl">
        <form action="../actions/add_product.php" method="POST" enctype="multipart/form-data">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5 sans-600" id="staticBackdropLabel">Add New Product</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <p class="sans-regular">Fill up all the fields in this form to add a new Product.</p>
              <div class="row">
                <div class="col-lg-4">
                  <input id="an-fpi" type="hidden" name="first_product_image" />
                  <input id="an-spi" type="hidden" name="second_product_image" />
                  <input id="an-tpi" type="hidden" name="third_product_image" />
                  <input type="file" id="addImage1" accept="image/*" name="product_image_1" style="display: none;" />
                  <input type="file" id="addImage2" accept="image/*" name="product_image_2" style="display: none;" />
                  <input type="file" id="addImage3" accept="image/*" name="product_image_3" style="display: none;" />
                  <div class="div-img-placeholder">
                    <img id="img-placeholder" src="../../assets/images/initial_logo.jpg" class="img-placeholder" style="display: none;" />
                  </div>
                  <div class="row" style="margin-top: 15px;">
                    <div class="col-lg-4">
                      <div id="div-add-image-1" class="div-img-selections sans-regular color-super-light-grey size-10">
                        <img id="img-selection-1" src="../../assets/images/initial_logo.jpg" class="img-selection-placeholder" style="display: none;" />
                        <i id="i-add-image-1" class="fas fa-plus-circle size-15"></i>
                        <b id="b-add-image-1">Add Image</b>
                      </div>
                      <p id="p-remove-image-1" class="b-remove-image color-super-light-grey size-10">Remove</p>
                    </div>
                    <div class="col-lg-4">
                      <div id="div-add-image-2" class="div-img-selections sans-regular color-super-light-grey size-10">
                        <img id="img-selection-2" src="../../assets/images/initial_logo.jpg" class="img-selection-placeholder" style="display: none;" />
                        <i id="i-add-image-2" class="fas fa-plus-circle size-15"></i>
                        <b id="b-add-image-2">Add Image</b>
                      </div>
                      <p id="p-remove-image-2" class="b-remove-image color-super-light-grey size-10">Remove</p>
                    </div>
                    <div class="col-lg-4">
                      <div id="div-add-image-3" class="div-img-selections sans-regular color-super-light-grey size-10">
                        <img id="img-selection-3" src="../../assets/images/initial_logo.jpg" class="img-selection-placeholder" style="display: none;" />
                        <i id="i-add-image-3" class="fas fa-plus-circle size-15"></i>
                        <b id="b-add-image-3">Add Image</b>
                      </div>
                      <p id="p-remove-image-3" class="b-remove-image color-super-light-grey size-10">Remove</p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-8">
                  <div class="row">
                    <div class="col-lg-6">
                      <label for="product_name" class="sans-600">Product (Name)</label>
                      <input 
                        id="product_name" 
                        type="text" 
                        placeholder="(eg. Iced Caramel Macchiato)" 
                        name="product_name" 
                        required 
                        class="sans-regular"
                        style="margin-top: 7px;"
                      >
                      <label for="product_description" class="sans-600" style="margin-top: 10px;">Product (Description)</label>
                      <textarea name="product_description" class="sans-regular" rows="8" required style="margin-top: 7px;"></textarea>
                      <label for="product_category" class="sans-600" style="margin-top: 10px;">Product (Category)</label>
                      <select class="form-select category-select" id="product_category" name="product_category" required style="margin-top: 7px;">
                        <?php
                          $fetch_query = "SELECT * FROM categories ORDER BY id ASC";
                          $result = $conn->query($fetch_query);
                          if ($result->num_rows > 0) {
                            $counter = 1;
                            while ($row = $result->fetch_assoc()) {
                              $category_id = $row['id'];
                              $category_name = $row['category_name'];
                              if ($counter == 1) {
                                echo '<option selected value="'.$category_id.'">'.$category_name.'</option>';
                              } else {
                                echo '<option value="'.$category_id.'">'.$category_name.'</option>';
                              }
                              $counter += 1;
                            }
                          }
                        ?>
                      </select>
                    </div>
                    <div class="col-lg-6">
                      <label for="product_variants" class="sans-600">Product (Variant)</label>
                      <select class="form-select category-select" id="product_variants" name="product_variants" required style="margin-top: 7px;">
                        <?php
                          $fetch_query = "SELECT * FROM variants WHERE is_enabled = 1 ORDER BY variant_type ASC";
                          $result = $conn->query($fetch_query);
                          if ($result->num_rows > 0) {
                            $counter = 1;
                            while ($row = $result->fetch_assoc()) {
                              $variant_id = $row['id'];
                              $variant_name = $row['variant_name'];
                              if ($counter == 1) {
                                echo '<option selected value="'.$variant_id.'">'.$variant_name.'</option>';
                              } else {
                                echo '<option value="'.$variant_id.'">'.$variant_name.'</option>';
                              }
                              $counter += 1;
                            }
                          }
                        ?>
                      </select>
                      <label for="product_price" class="sans-600" style="margin-top: 10px;">Product (Price)</label>
                      <input 
                        id="product_price" 
                        type="number" 
                        placeholder="(eg. ₱249.00)"
                        name="product_price" 
                        required 
                        class="sans-regular"
                        style="margin-top: 7px;"
                      >
                      <label for="product_price" class="sans-600" style="margin-top: 12px;">Promotions</label>
                      <div class="form-check" style="margin-top: 10px;">
                        <input class="form-check-input" type="radio" name="promotion" value="discounted" id="discountedRadio">
                        <label class="form-check-label sans-regular" for="discountedRadio" style="padding-left: 10px; padding-top: 5px;">
                          Discounted?
                        </label>
                      </div>
                      <div id="div-promotion-price" style="display: none;">
                        <input 
                          id="promotion_price" 
                          type="number" 
                          placeholder="(Your new price, eg. ₱199.00)"
                          name="promotion_price" 
                          class="sans-regular"
                          style="margin-top: 10px;"
                        >
                      </div>
                      <div class="form-check" style="margin-top: 10px;">
                        <input class="form-check-input" type="radio" name="promotion" value="buy_x_take_x" id="buyXtakeXRadio">
                        <label class="form-check-label sans-regular" for="buyXtakeXRadio" style="padding-left: 10px; padding-top: 5px;">
                          Buy (x) Take (x)?
                        </label>
                      </div>
                      <div id="div-buy-x-take-x" style="display: none; gap: 6px;">
                        <div style="flex: 1;">
                          <input 
                            id="buy_x" 
                            type="number" 
                            placeholder="(eg. Buy 1)"
                            name="buy_x" 
                            class="sans-regular"
                            style="margin-top: 10px;"
                          >
                        </div>
                        <div style="flex: 1;">
                          <input 
                            id="take_x" 
                            type="number" 
                            placeholder="(eg. Take 1)"
                            name="take_x" 
                            class="sans-regular"
                            style="margin-top: 10px;"
                          >
                        </div>
                      </div>
                      <div class="form-check" style="margin-top: 10px;">
                        <input class="form-check-input" type="radio" name="promotion" value="none" id="nonRadio" checked>
                        <label class="form-check-label sans-regular" for="nonRadio" style="padding-left: 10px; padding-top: 5px;">
                          None
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary sans-600" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary sans-600">Add Product</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <div
      class="modal fade" 
      id="staticEditProduct" 
      data-bs-backdrop="static" 
      data-bs-keyboard="false" 
      tabindex="-1" 
      aria-labelledby="staticBackdropLabel" 
      aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-xl">
        <form action="../actions/update_product.php" method="POST" enctype="multipart/form-data">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5 sans-600" id="staticBackdropLabel">Edit Product</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <input id="ed-product_id" type="hidden" name="ed-product_id" />
              <p class="sans-regular">Fill up all the fields in this form to update this Product.</p>
              <div class="row">
                <div class="col-lg-4">
                  <input id="ed-an-fpi" type="hidden" name="first_product_image" />
                  <input id="ed-an-spi" type="hidden" name="second_product_image" />
                  <input id="ed-an-tpi" type="hidden" name="third_product_image" />
                  <input type="file" id="ed-addImage1" accept="image/*" name="ed-product_image_1" style="display: none;" />
                  <input type="file" id="ed-addImage2" accept="image/*" name="ed-product_image_2" style="display: none;" />
                  <input type="file" id="ed-addImage3" accept="image/*" name="ed-product_image_3" style="display: none;" />
                  <div class="div-img-placeholder">
                    <img id="ed-img-placeholder" src="../../assets/images/initial_logo.jpg" class="img-placeholder" style="display: none;" />
                  </div>
                  <div class="row" style="margin-top: 15px;">
                    <div class="col-lg-4">
                      <div id="ed-div-add-image-1" class="div-img-selections sans-regular color-super-light-grey size-10">
                        <img id="ed-img-selection-1" src="../../assets/images/initial_logo.jpg" class="img-selection-placeholder" style="display: none;" />
                        <i id="ed-i-add-image-1" class="fas fa-plus-circle size-15"></i>
                        <b id="ed-b-add-image-1">Add Image</b>
                      </div>
                      <p id="ed-p-remove-image-1" class="b-remove-image color-super-light-grey size-10">Remove</p>
                    </div>
                    <div class="col-lg-4">
                      <div id="ed-div-add-image-2" class="div-img-selections sans-regular color-super-light-grey size-10">
                        <img id="ed-img-selection-2" src="../../assets/images/initial_logo.jpg" class="img-selection-placeholder" style="display: none;" />
                        <i id="ed-i-add-image-2" class="fas fa-plus-circle size-15"></i>
                        <b id="ed-b-add-image-2">Add Image</b>
                      </div>
                      <p id="ed-p-remove-image-2" class="b-remove-image color-super-light-grey size-10">Remove</p>
                    </div>
                    <div class="col-lg-4">
                      <div id="ed-div-add-image-3" class="div-img-selections sans-regular color-super-light-grey size-10">
                        <img id="ed-img-selection-3" src="../../assets/images/initial_logo.jpg" class="img-selection-placeholder" style="display: none;" />
                        <i id="ed-i-add-image-3" class="fas fa-plus-circle size-15"></i>
                        <b id="ed-b-add-image-3">Add Image</b>
                      </div>
                      <p id="ed-p-remove-image-3" class="b-remove-image color-super-light-grey size-10">Remove</p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-8">
                  <div class="row">
                    <div class="col-lg-6">
                      <label for="ed-product_name" class="sans-600">Product (Name)</label>
                      <input 
                        id="ed-product_name" 
                        type="text" 
                        placeholder="(eg. Iced Caramel Macchiato)" 
                        name="ed-product_name" 
                        required 
                        class="sans-regular"
                        style="margin-top: 7px;"
                      >
                      <label for="ed-product_description" class="sans-600" style="margin-top: 10px;">Product (Description)</label>
                      <textarea
                        id="ed-product_description"
                        name="ed-product_description" 
                        class="sans-regular" 
                        rows="8" 
                        required 
                        style="margin-top: 7px;"></textarea>
                      <label for="ed-product_category" class="sans-600" style="margin-top: 10px;">Product (Category)</label>
                      <select class="form-select category-select" id="ed-product_category" name="ed-product_category" required style="margin-top: 7px;">
                        <?php
                          $fetch_query = "SELECT * FROM categories ORDER BY id ASC";
                          $result = $conn->query($fetch_query);
                          if ($result->num_rows > 0) {
                            $counter = 1;
                            while ($row = $result->fetch_assoc()) {
                              $category_id = $row['id'];
                              $category_name = $row['category_name'];
                              if ($counter == 1) {
                                echo '<option selected value="'.$category_id.'">'.$category_name.'</option>';
                              } else {
                                echo '<option value="'.$category_id.'">'.$category_name.'</option>';
                              }
                              $counter += 1;
                            }
                          }
                        ?>
                      </select>
                    </div>
                    <div class="col-lg-6">
                      <label for="ed-product_variants" class="sans-600">Product (Variant)</label>
                      <select class="form-select category-select" id="ed-product_variants" name="ed-product_variants" required style="margin-top: 7px;">
                        <?php
                          $fetch_query = "SELECT * FROM variants WHERE is_enabled = 1 ORDER BY variant_type ASC";
                          $result = $conn->query($fetch_query);
                          if ($result->num_rows > 0) {
                            $counter = 1;
                            while ($row = $result->fetch_assoc()) {
                              $variant_id = $row['id'];
                              $variant_name = $row['variant_name'];
                              if ($counter == 1) {
                                echo '<option selected value="'.$variant_id.'">'.$variant_name.'</option>';
                              } else {
                                echo '<option value="'.$variant_id.'">'.$variant_name.'</option>';
                              }
                              $counter += 1;
                            }
                          }
                        ?>
                      </select>
                      <label for="ed-product_price" class="sans-600" style="margin-top: 10px;">Product (Price)</label>
                      <input 
                        id="ed-product_price" 
                        type="number" 
                        placeholder="(eg. ₱249.00)"
                        name="ed-product_price" 
                        required 
                        class="sans-regular"
                        style="margin-top: 7px;"
                      >
                      <label for="ed-promotion" class="sans-600" style="margin-top: 12px;">Promotions</label>
                      <div class="form-check" style="margin-top: 10px;">
                        <input class="form-check-input" type="radio" name="ed-promotion" value="discounted" id="ed-discountedRadio">
                        <label class="form-check-label sans-regular" for="ed-discountedRadio" style="padding-left: 10px; padding-top: 5px;">
                          Discounted?
                        </label>
                      </div>
                      <div id="ed-div-promotion-price" style="display: none;">
                        <input 
                          id="ed-promotion_price" 
                          type="number" 
                          placeholder="(Your new price, eg. ₱199.00)"
                          name="ed-promotion_price" 
                          class="sans-regular"
                          style="margin-top: 10px;"
                        >
                      </div>
                      <div class="form-check" style="margin-top: 10px;">
                        <input class="form-check-input" type="radio" name="ed-promotion" value="buy_x_take_x" id="ed-buyXtakeXRadio">
                        <label class="form-check-label sans-regular" for="ed-buyXtakeXRadio" style="padding-left: 10px; padding-top: 5px;">
                          Buy (x) Take (x)?
                        </label>
                      </div>
                      <div id="ed-div-buy-x-take-x" style="display: none; gap: 6px;">
                        <div style="flex: 1;">
                          <input 
                            id="ed-buy_x" 
                            type="number" 
                            placeholder="(eg. Buy 1)"
                            name="ed-buy_x" 
                            class="sans-regular"
                            style="margin-top: 10px;"
                          >
                        </div>
                        <div style="flex: 1;">
                          <input 
                            id="ed-take_x" 
                            type="number" 
                            placeholder="(eg. Take 1)"
                            name="ed-take_x" 
                            class="sans-regular"
                            style="margin-top: 10px;"
                          >
                        </div>
                      </div>
                      <div class="form-check" style="margin-top: 10px;">
                        <input class="form-check-input" type="radio" name="ed-promotion" value="none" id="ed-nonRadio" checked>
                        <label class="form-check-label sans-regular" for="ed-nonRadio" style="padding-left: 10px; padding-top: 5px;">
                          None
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary sans-600" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary sans-600">Update Product</button>
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
        window.location.href = "./";
      });
      $('#btn-variants').click(() => {
        window.location.href = "../variants";
      });
      $('#btn-orders').click(() => {
        window.location.href = "../orders";
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
    const onEditProduct = (
      product_id,
      product_name,
      product_description,
      product_category_id,
      product_variant_id,
      product_price,
      promotional_price,
      is_buy_x_take_x,
      buy_x_of,
      take_x_of,
      product_images
    ) => {
      const prod_images = product_images.split(',');
      const first_image = prod_images?.[0];
      const second_image = prod_images?.[1];
      const third_image = prod_images?.[2];
      $('#staticEditProduct').modal('show');
      $('#ed-product_id').val(product_id);
      $('#ed-product_name').val(product_name);
      $('#ed-product_description').val(product_description);
      $('#ed-product_category').val(product_category_id).change();
      $('#ed-product_variants').val(product_variant_id).change();
      $('#ed-product_price').val(product_price);
      if (is_buy_x_take_x === "1") {
        $('#ed-buyXtakeXRadio').prop('checked', true);
        $('#ed-discountedRadio').prop('checked', false);
        $('#ed-nonRadio').prop('checked', false);
        $('#ed-promotion_price').val('');
        $('#ed-buy_x').val(buy_x_of);
        $('#ed-take_x').val(take_x_of);
        $('#ed-div-promotion-price').css('display', 'none');
        $('#ed-div-buy-x-take-x').css('display', 'flex');
        $('#ed-promotion_price').removeAttr('required');
        $('#ed-buy_x').attr('required', 'required');
        $('#ed-take_x').attr('required', 'required');
      } else if (is_buy_x_take_x === "0") {
        $('#ed-buyXtakeXRadio').prop('checked', false);
        $('#ed-discountedRadio').prop('checked', true);
        $('#ed-nonRadio').prop('checked', false);
        $('#ed-promotion_price').val(promotional_price);
        $('#ed-buy_x').val('');
        $('#ed-take_x').val('');
        $('#ed-div-promotion-price').css('display', 'block');
        $('#ed-div-buy-x-take-x').css('display', 'none');
        $('#ed-promotion_price').attr('required', 'required');
        $('#ed-buy_x').removeAttr('required');
        $('#ed-take_x').removeAttr('required');
      } else {
        $('#ed-buyXtakeXRadio').prop('checked', false);
        $('#ed-discountedRadio').prop('checked', false);
        $('#ed-nonRadio').prop('checked', true);
        $('#ed-promotion_price').val('');
        $('#ed-buy_x').val('');
        $('#ed-take_x').val('');
        $('#ed-div-promotion-price').css('display', 'none');
        $('#ed-div-buy-x-take-x').css('display', 'none');
        $('#ed-promotion_price').removeAttr('required');
        $('#ed-buy_x').removeAttr('required');
        $('#ed-take_x').removeAttr('required');
      }
      // display first image
      if (first_image !== undefined && first_image !== "") {
        // display image in large placeholder
        $('#ed-img-placeholder').attr('src', first_image);
        $('#ed-img-placeholder').css('display', 'block');
        // display image in small placeholder
        $('#ed-img-selection-1').attr('src', first_image);
        $('#ed-img-selection-1').css('display', 'block');
        // remove plus and "Add Image" label
        $('#ed-i-add-image-1').css('display', 'none');
        $('#ed-b-add-image-1').css('display', 'none');
        // store to input field for API call
        $('#ed-an-fpi').val(first_image);
        // display remove image label
        $('#ed-p-remove-image-1').css('display', 'block');
      } else {
        // remove image in large placeholder
        $('#ed-img-placeholder').attr('src', '');
        $('#ed-img-placeholder').css('display', 'none');
        // remove image in small placeholder
        $('#ed-img-selection-1').attr('src', '');
        $('#ed-img-selection-1').css('display', 'none');
        // display plus and "Add Image" label
        $('#ed-i-add-image-1').css('display', 'block');
        $('#ed-b-add-image-1').css('display', 'block');
        // remove stored input field
        $('#ed-an-fpi').val('');
        // hide remove image label
        $('#ed-p-remove-image-1').css('display', 'none');
      }
      // display second image
      if (second_image !== undefined && second_image !== "") {
        // display image in large placeholder
        $('#ed-img-placeholder').attr('src', second_image);
        $('#ed-img-placeholder').css('display', 'block');
        // display image in small placeholder
        $('#ed-img-selection-2').attr('src', second_image);
        $('#ed-img-selection-2').css('display', 'block');
        // remove plus and "Add Image" label
        $('#ed-i-add-image-2').css('display', 'none');
        $('#ed-b-add-image-2').css('display', 'none');
        // store to input field for API call
        $('#ed-an-spi').val(second_image);
        // display remove image label
        $('#ed-p-remove-image-2').css('display', 'block');
      } else {
        // remove image in large placeholder
        $('#ed-img-placeholder').attr('src', '');
        $('#ed-img-placeholder').css('display', 'none');
        // remove image in small placeholder
        $('#ed-img-selection-2').attr('src', '');
        $('#ed-img-selection-2').css('display', 'none');
        // display plus and "Add Image" label
        $('#ed-i-add-image-2').css('display', 'block');
        $('#ed-b-add-image-2').css('display', 'block');
        // remove stored input field
        $('#ed-an-spi').val('');
        // hide remove image label
        $('#ed-p-remove-image-2').css('display', 'none');
      }
      // display third image
      if (third_image !== undefined && third_image !== "") {
        // display image in large placeholder
        $('#ed-img-placeholder').attr('src', third_image);
        $('#ed-img-placeholder').css('display', 'block');
        // display image in small placeholder
        $('#ed-img-selection-3').attr('src', third_image);
        $('#ed-img-selection-3').css('display', 'block');
        // remove plus and "Add Image" label
        $('#ed-i-add-image-3').css('display', 'none');
        $('#ed-b-add-image-3').css('display', 'none');
        // store to input field for API call
        $('#ed-an-tpi').val(third_image);
        // display remove image label
        $('#ed-p-remove-image-3').css('display', 'block');
      } else {
        // remove image in large placeholder
        $('#ed-img-placeholder').attr('src', '');
        $('#ed-img-placeholder').css('display', 'none');
        // remove image in small placeholder
        $('#ed-img-selection-3').attr('src', '');
        $('#ed-img-selection-3').css('display', 'none');
        // display plus and "Add Image" label
        $('#ed-i-add-image-3').css('display', 'block');
        $('#ed-b-add-image-3').css('display', 'block');
        // remove stored input field
        $('#ed-an-tpi').val('');
        // hide remove image label
        $('#ed-p-remove-image-3').css('display', 'none');
      }
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
