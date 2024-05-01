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
    <div class="sidebar-container">
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
    <div class="content">
      <nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary">
        <div class="container-fluid">
          <a class="navbar-brand sans-regular color-dark-grey a-navbar-path" href="#" style="cursor: default;">
            &nbsp;&nbsp;&nbsp;<i class="fa-solid fa-bars" style="cursor: pointer"></i>
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
                      $product_variant = "";
                      // fetch categories
                      $fetch_query = "SELECT PC.category_id, CTG.category_name, CTG.category_description 
                        FROM products_categories AS PC 
                        INNER JOIN categories AS CTG ON
                        PC.category_id = CTG.id 
                        WHERE PC.product_id = ".$product_id."";
                      $cat_result = $conn->query($fetch_query);
                      if ($cat_result->num_rows > 0) {
                        $cat_row = $cat_result->fetch_assoc();
                        $product_category = $cat_row['category_name'];
                      }
                      // fetch variants and prices
                      $fetch_query = "SELECT PP.variant_id, PP.variant_price, VT.variant_name, VT.variant_description 
                        FROM products_prices AS PP 
                        INNER JOIN variants AS VT ON
                        PP.variant_id = VT.id 
                        WHERE PP.product_id = ".$product_id."";
                      $var_result = $conn->query($fetch_query);
                      if ($var_result->num_rows > 0) {
                        $var_row = $var_result->fetch_assoc();
                        $product_variant = $var_row['variant_name'];
                      }
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
                              data-bs-toggle="modal"
                              data-bs-target="#staticEditProduct"
                              class="btn btn-outline-primary btn-sm 
                                sans-400 
                                color-white"
                              type="button">
                              <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                            <button
                              onclick="onDeleteProduct(
                                '."'".$product_id."',".'
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
              <p class="sans-regular">Fill up all the fields in this form to update this Product.</p>
              <div class="row">
                <div class="col-lg-4">
                  <input id="ed-fpi" type="hidden" name="first_product_image" />
                  <input id="ed-spi" type="hidden" name="second_product_image" />
                  <input id="ed-tpi" type="hidden" name="third_product_image" />
                  <input type="file" id="addImage1" accept="image/*" name="product_image_1" style="display: none;" />
                  <input type="file" id="addImage2" accept="image/*" name="product_image_2" style="display: none;" />
                  <input type="file" id="addImage3" accept="image/*" name="product_image_3" style="display: none;" />
                  <div class="div-img-placeholder">
                    <img id="ed-mg-placeholder" src="../../assets/images/initial_logo.jpg" class="img-placeholder" style="display: none;" />
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
                      <label for="product_name" class="sans-600">Product (Name)</label>
                      <input 
                        id="ed-product_name" 
                        type="text" 
                        placeholder="(eg. Iced Caramel Macchiato)" 
                        name="product_name" 
                        required 
                        class="sans-regular"
                        style="margin-top: 7px;"
                      >
                      <label for="product_description" class="sans-600" style="margin-top: 10px;">Product (Description)</label>
                      <textarea
                        id="ed-product_description"
                        name="product_description" 
                        class="sans-regular" 
                        rows="8" 
                        required 
                        style="margin-top: 7px;">
                      </textarea>
                      <label for="product_category" class="sans-600" style="margin-top: 10px;">Product (Category)</label>
                      <select class="form-select category-select" id="ed-product_category" name="product_category" required style="margin-top: 7px;">
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
                      <select class="form-select category-select" id="ed-product_variants" name="product_variants" required style="margin-top: 7px;">
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
                        id="ed-product_price" 
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
                      <div id="ed-div-promotion-price" style="display: none;">
                        <input 
                          id="ed-promotion_price" 
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
                      <div id="ed-div-buy-x-take-x" style="display: none; gap: 6px;">
                        <div style="flex: 1;">
                          <input 
                            id="ed-buy_x" 
                            type="number" 
                            placeholder="(eg. Buy 1)"
                            name="buy_x" 
                            class="sans-regular"
                            style="margin-top: 10px;"
                          >
                        </div>
                        <div style="flex: 1;">
                          <input 
                            id="ed-take_x" 
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
              <button type="submit" class="btn btn-primary sans-600">Update Product</button>
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
  <script type="text/javascript">
    $('input[type=radio][name=promotion]').change(function() {
      if (this.value === 'discounted') {
        $('#div-promotion-price').css('display', 'block');
        $('#div-buy-x-take-x').css('display', 'none');
        $('#promotion_price').attr('required', 'required');
        $('#buy_x').removeAttr('required');
        $('#take_x').removeAttr('required');
      } else if (this.value === 'buy_x_take_x') {
        $('#div-promotion-price').css('display', 'none');
        $('#div-buy-x-take-x').css('display', 'flex');
        $('#promotion_price').removeAttr('required');
        $('#buy_x').attr('required', 'required');
        $('#take_x').attr('required', 'required');
      } else {
        $('#div-promotion-price').css('display', 'none');
        $('#div-buy-x-take-x').css('display', 'none');
        $('#promotion_price').removeAttr('required');
        $('#buy_x').removeAttr('required');
        $('#take_x').removeAttr('required');
      }
    });
    $('input[type=file][name=product_image_1]').change(function(event) {
      if (this.files.length > 0) {
        const form_data = new FormData();                  
        form_data.append('product_image_1', this.files[0]);                       
        $.ajax({
          url: '../actions/add_product_image.php',
          cache: false,
          contentType: false,
          processData: false,
          data: form_data,
          method: 'post',
          type: 'post',
          success: (response) => {
            if (response.status === 201) {
              // display image in large placeholder
              $('#img-placeholder').attr('src', response.file);
              $('#img-placeholder').css('display', 'block');
              // display image in small placeholder
              $('#img-selection-1').attr('src', response.file);
              $('#img-selection-1').css('display', 'block');
              // remove plus and "Add Image" label
              $('#i-add-image-1').css('display', 'none');
              $('#b-add-image-1').css('display', 'none');
              // store to input field for API call
              $('#an-fpi').val(response.file);
              // display remove image label
              $('#p-remove-image-1').css('display', 'block');
            } else {
              // remove image in large placeholder
              $('#img-placeholder').attr('src', '');
              $('#img-placeholder').css('display', 'none');
              // remove image in small placeholder
              $('#img-selection-1').attr('src', '');
              $('#img-selection-1').css('display', 'none');
              // display plus and "Add Image" label
              $('#i-add-image-1').css('display', 'block');
              $('#b-add-image-1').css('display', 'block');
              // remove stored input field
              $('#an-fpi').val('');
              // hide remove image label
              $('#p-remove-image-1').css('display', 'none');
            }
          },
          error: (error) => {
            // remove image in large placeholder
            $('#img-placeholder').attr('src', '');
            $('#img-placeholder').css('display', 'none');
            // remove image in small placeholder
            $('#img-selection-1').attr('src', '');
            $('#img-selection-1').css('display', 'none');
            // display plus and "Add Image" label
            $('#i-add-image-1').css('display', 'block');
            $('#b-add-image-1').css('display', 'block');
            // remove stored input field
            $('#an-fpi').val('');
            // hide remove image label
            $('#p-remove-image-1').css('display', 'none');
          }
        });
      }
    });
    $('input[type=file][name=product_image_2]').change(function() {
      if (this.files.length > 0) {
        const form_data = new FormData();                  
        form_data.append('product_image_2', this.files[0]);                       
        $.ajax({
          url: '../actions/add_product_image.php',
          cache: false,
          contentType: false,
          processData: false,
          data: form_data,
          method: 'post',
          type: 'post',
          success: (response) => {
            if (response.status === 201) {
              // display image in large placeholder
              $('#img-placeholder').attr('src', response.file);
              $('#img-placeholder').css('display', 'block');
              // display image in small placeholder
              $('#img-selection-2').attr('src', response.file);
              $('#img-selection-2').css('display', 'block');
              // remove plus and "Add Image" label
              $('#i-add-image-2').css('display', 'none');
              $('#b-add-image-2').css('display', 'none');
              // store to input field for API call
              $('#an-spi').val(response.file);
              // display remove image label
              $('#p-remove-image-2').css('display', 'block');
            } else {
              // remove image in large placeholder
              $('#img-placeholder').attr('src', '');
              $('#img-placeholder').css('display', 'none');
              // remove image in small placeholder
              $('#img-selection-2').attr('src', '');
              $('#img-selection-2').css('display', 'none');
              // display plus and "Add Image" label
              $('#i-add-image-2').css('display', 'block');
              $('#b-add-image-2').css('display', 'block');
              // remove stored input field
              $('#an-spi').val('');
              // hide remove image label
              $('#p-remove-image-2').css('display', 'none');
            }
          },
          error: (error) => {
            // remove image in large placeholder
            $('#img-placeholder').attr('src', '');
            $('#img-placeholder').css('display', 'none');
            // remove image in small placeholder
            $('#img-selection-2').attr('src', '');
            $('#img-selection-2').css('display', 'none');
            // display plus and "Add Image" label
            $('#i-add-image-2').css('display', 'block');
            $('#b-add-image-2').css('display', 'block');
            // remove stored input field
            $('#an-spi').val('');
            // hide remove image label
            $('#p-remove-image-2').css('display', 'none');
          }
        });
      }
    });
    $('input[type=file][name=product_image_3]').change(function() {
      if (this.files.length > 0) {
        const form_data = new FormData();                  
        form_data.append('product_image_3', this.files[0]);                       
        $.ajax({
          url: '../actions/add_product_image.php',
          cache: false,
          contentType: false,
          processData: false,
          data: form_data,
          method: 'post',
          type: 'post',
          success: (response) => {
            if (response.status === 201) {
              // display image in large placeholder
              $('#img-placeholder').attr('src', response.file);
              $('#img-placeholder').css('display', 'block');
              // display image in small placeholder
              $('#img-selection-3').attr('src', response.file);
              $('#img-selection-3').css('display', 'block');
              // remove plus and "Add Image" label
              $('#i-add-image-3').css('display', 'none');
              $('#b-add-image-3').css('display', 'none');
              // store to input field for API call
              $('#an-tpi').val(response.file);
              // display remove image label
              $('#p-remove-image-3').css('display', 'block');
            } else {
              // remove image in large placeholder
              $('#img-placeholder').attr('src', '');
              $('#img-placeholder').css('display', 'none');
              // remove image in small placeholder
              $('#img-selection-3').attr('src', '');
              $('#img-selection-3').css('display', 'none');
              // display plus and "Add Image" label
              $('#i-add-image-3').css('display', 'block');
              $('#b-add-image-3').css('display', 'block');
              // remove stored input field
              $('#an-tpi').val('');
              // hide remove image label
              $('#p-remove-image-3').css('display', 'none');
            }
          },
          error: (error) => {
            // remove image in large placeholder
            $('#img-placeholder').attr('src', '');
            $('#img-placeholder').css('display', 'none');
            // remove image in small placeholder
            $('#img-selection-3').attr('src', '');
            $('#img-selection-3').css('display', 'none');
            // display plus and "Add Image" label
            $('#i-add-image-3').css('display', 'block');
            $('#b-add-image-3').css('display', 'block');
            // remove stored input field
            $('#an-tpi').val('');
            // hide remove image label
            $('#p-remove-image-3').css('display', 'none');
          }
        });
      }
    });
    $('#div-add-image-1').click(() => { $('#addImage1').trigger('click'); });
    $('#div-add-image-2').click(() => { $('#addImage2').trigger('click'); });
    $('#div-add-image-3').click(() => { $('#addImage3').trigger('click'); });
    $('#p-remove-image-1').click(() => {
      // remove image in small placeholder
      $('#img-selection-1').attr('src', '');
      $('#img-selection-1').css('display', 'none');
      // display plus and "Add Image" label
      $('#i-add-image-1').css('display', 'block');
      $('#b-add-image-1').css('display', 'block');
      // remove stored input field
      $('#an-fpi').val('');
      // hide remove image label
      $('#p-remove-image-1').css('display', 'none');
      const fpi = $('#an-fpi').val();
      const spi = $('#an-spi').val();
      const tpi = $('#an-tpi').val();
      if (fpi === '' && spi === '' && tpi === '') {
        // remove image in large placeholder
        $('#img-placeholder').attr('src', '');
        $('#img-placeholder').css('display', 'none');
      }
    });
    $('#p-remove-image-2').click(() => {
      // remove image in small placeholder
      $('#img-selection-2').attr('src', '');
      $('#img-selection-2').css('display', 'none');
      // display plus and "Add Image" label
      $('#i-add-image-2').css('display', 'block');
      $('#b-add-image-2').css('display', 'block');
      // remove stored input field
      $('#an-spi').val('');
      // hide remove image label
      $('#p-remove-image-2').css('display', 'none');
      const fpi = $('#an-fpi').val();
      const spi = $('#an-spi').val();
      const tpi = $('#an-tpi').val();
      if (fpi === '' && spi === '' && tpi === '') {
        // remove image in large placeholder
        $('#img-placeholder').attr('src', '');
        $('#img-placeholder').css('display', 'none');
      }
    });
    $('#p-remove-image-3').click(() => {
      // remove image in small placeholder
      $('#img-selection-3').attr('src', '');
      $('#img-selection-3').css('display', 'none');
      // display plus and "Add Image" label
      $('#i-add-image-3').css('display', 'block');
      $('#b-add-image-3').css('display', 'block');
      // remove stored input field
      $('#an-tpi').val('');
      // hide remove image label
      $('#p-remove-image-3').css('display', 'none');
      const fpi = $('#an-fpi').val();
      const spi = $('#an-spi').val();
      const tpi = $('#an-tpi').val();
      if (fpi === '' && spi === '' && tpi === '') {
        // remove image in large placeholder
        $('#img-placeholder').attr('src', '');
        $('#img-placeholder').css('display', 'none');
      }
    });
  </script>
  <script type="text/javascript">
    const onDeleteProduct = (product_id) => {
      $('#staticDeleteProduct').modal('show');
      $('#delete-pid').val(product_id);
    }
    const onEditUser = (
      user_id,
      first_name,
      last_name,
      email,
      phone,
      address,
      gender,
      birth_date
    ) => {
      $('#edit-ui').val(user_id);
      $('#edit-ue').val(email);
      $('#edit-fn').val(first_name);
      $('#edit-ln').val(last_name);
      $('#edit-ea').val(email);
      $('#edit-pn').val(phone);
      $('#edit-ad').val(address);
      $('#edit-gd').val(gender);
      $('#edit-bd').val(birth_date);
    }
  </script>    
</html>
