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
    <link rel="stylesheet" href="./css/variants.css" />
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
            sans-700 
            background-color-yellow 
            border-color-yellow 
            color-dark-grey 
            btn-menu 
            btn-menu-selected"
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
            &nbsp;Product Variants
          </a>
        </div>
      </nav>
      <div>
        <div class="content-wrapper">
          <div class="div-content-title">
            <div class="div-content-title-labels">
              <h4 class="color-dark-grey sans-600" style="font-size: 13pt;">
                Manage Product Variants
              </h4>
              <p class="color-super-light-grey sans-regular" style="font-size: 10pt;">
                Add, update, or remove products' variants
              </p>
            </div>
            <div class="div-content-title-actions">
              <button
                data-bs-toggle="modal"
                data-bs-target="#staticAddNewVariant"
                class="btn btn-outline-primary btn-sm sans-400"
                type="button">
                <i class="fa-solid fa-circle-plus"></i>&nbsp;&nbsp;Add New Variant
              </button>
            </div>
          </div>
          <div style="margin-top: 20px;">
            <table id="data" class="table table-striped" style="width:100%">
              <thead>
                <tr>
                  <th class="sans-bold">Variant (Type)</th>
                  <th class="sans-bold">Variant (Name)</th>
                  <th class="sans-bold">Variant (Description)</th>
                  <th class="sans-bold">Variant (Status)</th>
                  <th class="sans-bold">Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $fetch_query = "SELECT * FROM variants";
                  $result = $conn->query($fetch_query);
                  if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                      $variant_id = $row['id'];
                      $type = $row['variant_type'];
                      $name = $row['variant_name'];
                      $description = $row['variant_description'];
                      $is_enabled = $row['is_enabled'];
                      $status = 'Disabled';
                      $status_class = "badge-disabled";
                      if ($is_enabled == 1) {
                        $status = 'Enabled';
                        $status_class = "badge-enabled";
                      }
                      echo '
                        <tr>
                          <td class="sans-600">
                            '.$type.'
                          </td>
                          <td class="sans-regular">
                            '.$name.'
                          </td>
                          <td class="sans-regular">
                            '.$description.'
                          </td>
                          <td class="sans-regular">
                            <span class="'.$status_class.'">'.$status.'</span>
                          </td>
                          <td>
                            <button
                              data-bs-toggle="modal"
                              data-bs-target="#staticEditVariant"
                              onclick="onEditVariant(
                                '."'".$variant_id."',".'
                                '."'".$type."',".'
                                '."'".$name."',".'
                                '."'".$description."',".'
                                '."'".$is_enabled."'".'
                              )"
                              class="btn btn-outline-primary btn-sm 
                                sans-400 
                                color-white"
                              type="button">
                              <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                            <button
                              onclick="onDeleteVariant('."'".$variant_id."'".')"
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
      id="staticDeleteVariant" 
      data-bs-backdrop="static" 
      data-bs-keyboard="false" 
      tabindex="-1" 
      aria-labelledby="staticBackdropLabel" 
      aria-hidden="true">
      <div class="modal-dialog modal-md modal-dialog-centered">
        <form action="../actions/delete_variant.php" method="POST">
          <input id="delete-vi" type="hidden" name="variant_id" />
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5 sans-600" id="staticBackdropLabel">Delete This Variant?</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <p class="sans-regular size-14">Are you sure you want to delete this variant?. It cannot be undone.</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary sans-600" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary sans-600">Delete Variant</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <div
      class="modal fade" 
      id="staticAddNewVariant" 
      data-bs-backdrop="static" 
      data-bs-keyboard="false" 
      tabindex="-1" 
      aria-labelledby="staticBackdropLabel" 
      aria-hidden="true">
      <div class="modal-dialog modal-md modal-dialog-centered">
        <form action="../actions/add_variant.php" method="POST">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5 sans-600" id="staticBackdropLabel">Add New Variant</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <input type="text" placeholder="Type (eg. Sizes, Flavors)" name="type" required class="sans-600">
              <input type="text" placeholder="Name (eg. Extra Large, Large, Spicy Flavor)" name="variant" required class="sans-regular">
              <input type="text" placeholder="Description (eg. For spicy flavoured categories)" name="description" required class="sans-regular">
              <div class="form-check" style="margin-top: 10px;">
                <input class="form-check-input" type="checkbox" name="status" id="flexCheckChecked" checked>
                <label class="form-check-label sans-regular" for="flexCheckChecked" style="padding-left: 10px; padding-top: 5px;">
                  Enable this variant?
                </label>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary sans-600" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary sans-600">Add Variant</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <div
      class="modal fade" 
      id="staticEditVariant" 
      data-bs-backdrop="static" 
      data-bs-keyboard="false" 
      tabindex="-1" 
      aria-labelledby="staticBackdropLabel" 
      aria-hidden="true">
      <div class="modal-dialog modal-md modal-dialog-centered">
        <form action="../actions/update_variant.php" method="POST">
          <input id="edit-vi" type="hidden" name="variant_id" />
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5 sans-600" id="staticBackdropLabel">Edit Variant</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <input id="edit-vt" type="text" placeholder="Type (eg. Sizes, Flavors)" name="type" required class="sans-600">
              <input id="edit-vn" type="text" placeholder="Name (eg. Extra Large, Large, Spicy Flavor)" name="variant" required class="sans-regular">
              <input id="edit-vd" type="text" placeholder="Description (eg. For spicy flavoured categories)" name="description" required class="sans-regular">
              <div class="form-check" style="margin-top: 10px;">
                <input id="edit-vs" class="form-check-input" type="checkbox" name="status" checked>
                <label class="form-check-label sans-regular" for="edit-vs" style="padding-left: 10px; padding-top: 5px;">
                  Enable this variant?
                </label>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary sans-600" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary sans-600">Update Variant</button>
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
        window.location.href = "./";
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
        'bLengthChange': false,
        'searching': false
      });
    });
  </script>
  <script type="text/javascript">
    const onDeleteVariant = (variant_id) => {
      $('#staticDeleteVariant').modal('show');
      $('#delete-vi').val(variant_id);
    }
    const onEditVariant = (
      variant_id,
      variant_type,
      variant_name,
      variant_description,
      variant_status
    ) => {
      $('#staticEditVariant').modal('show');
      $('#edit-vi').val(variant_id);
      $('#edit-vt').val(variant_type);
      $('#edit-vn').val(variant_name);
      $('#edit-vd').val(variant_description);
      if (variant_status == 1) {
        $('#edit-vs').prop('checked', true);
      } else {
        $('#edit-vs').prop('checked', false);
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
