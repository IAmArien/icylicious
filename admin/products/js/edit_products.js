$(document).ready(() => {
  // for edit products promotions
  $('input[type=radio][name=ed-promotion]').change(function() {
    if (this.value === 'discounted') {
      $('#ed-div-promotion-price').css('display', 'block');
      $('#ed-div-buy-x-take-x').css('display', 'none');
      $('#ed-promotion_price').attr('required', 'required');
      $('#ed-buy_x').removeAttr('required');
      $('#ed-take_x').removeAttr('required');
    } else if (this.value === 'buy_x_take_x') {
      $('#ed-div-promotion-price').css('display', 'none');
      $('#ed-div-buy-x-take-x').css('display', 'flex');
      $('#ed-promotion_price').removeAttr('required');
      $('#ed-buy_x').attr('required', 'required');
      $('#ed-take_x').attr('required', 'required');
    } else {
      $('#ed-div-promotion-price').css('display', 'none');
      $('#ed-div-buy-x-take-x').css('display', 'none');
      $('#ed-promotion_price').removeAttr('required');
      $('#ed-buy_x').removeAttr('required');
      $('#ed-take_x').removeAttr('required');
    }
  });
  // for add new product image selections
  $('input[type=file][name=ed-product_image_1]').change(function(event) {
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
            $('#ed-img-placeholder').attr('src', response.file);
            $('#ed-img-placeholder').css('display', 'block');
            // display image in small placeholder
            $('#ed-img-selection-1').attr('src', response.file);
            $('#ed-img-selection-1').css('display', 'block');
            // remove plus and "Add Image" label
            $('#ed-i-add-image-1').css('display', 'none');
            $('#ed-b-add-image-1').css('display', 'none');
            // store to input field for API call
            $('#ed-an-fpi').val(response.file);
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
        },
        error: () => {
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
      });
    }
  });
  $('input[type=file][name=ed-product_image_2]').change(function() {
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
            $('#ed-img-placeholder').attr('src', response.file);
            $('#ed-img-placeholder').css('display', 'block');
            // display image in small placeholder
            $('#ed-img-selection-2').attr('src', response.file);
            $('#ed-img-selection-2').css('display', 'block');
            // remove plus and "Add Image" label
            $('#ed-i-add-image-2').css('display', 'none');
            $('#ed-b-add-image-2').css('display', 'none');
            // store to input field for API call
            $('#ed-an-fpi').val(response.file);
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
            $('#ed-an-fpi').val('');
            // hide remove image label
            $('#ed-p-remove-image-2').css('display', 'none');
          }
        },
        error: () => {
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
          $('#ed-an-fpi').val('');
          // hide remove image label
          $('#ed-p-remove-image-2').css('display', 'none');
        }
      });
    }
  });
  $('input[type=file][name=ed-product_image_3]').change(function() {
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
            $('#ed-img-placeholder').attr('src', response.file);
            $('#ed-img-placeholder').css('display', 'block');
            // display image in small placeholder
            $('#ed-img-selection-3').attr('src', response.file);
            $('#ed-img-selection-3').css('display', 'block');
            // remove plus and "Add Image" label
            $('#ed-i-add-image-3').css('display', 'none');
            $('#ed-b-add-image-3').css('display', 'none');
            // store to input field for API call
            $('#ed-an-fpi').val(response.file);
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
            $('#ed-an-fpi').val('');
            // hide remove image label
            $('#ed-p-remove-image-3').css('display', 'none');
          }
        },
        error: () => {
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
          $('#ed-an-fpi').val('');
          // hide remove image label
          $('#ed-p-remove-image-3').css('display', 'none');
        }
      });
    }
  });
  $('#ed-div-add-image-1').click(() => { $('#ed-addImage1').trigger('click'); });
  $('#ed-div-add-image-2').click(() => { $('#ed-addImage2').trigger('click'); });
  $('#ed-div-add-image-3').click(() => { $('#ed-addImage3').trigger('click'); });
  $('#ed-p-remove-image-1').click(() => {
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
    const fpi = $('#ed-an-fpi').val();
    const spi = $('#ed-an-spi').val();
    const tpi = $('#ed-an-tpi').val();
    if (fpi === '' && spi === '' && tpi === '') {
      // remove image in large placeholder
      $('#ed-img-placeholder').attr('src', '');
      $('#ed-img-placeholder').css('display', 'none');
    }
  });
  $('#ed-p-remove-image-2').click(() => {
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
    const fpi = $('#ed-an-fpi').val();
    const spi = $('#ed-an-spi').val();
    const tpi = $('#ed-an-tpi').val();
    if (fpi === '' && spi === '' && tpi === '') {
      // remove image in large placeholder
      $('#ed-img-placeholder').attr('src', '');
      $('#ed-img-placeholder').css('display', 'none');
    }
  });
  $('#ed-p-remove-image-3').click(() => {
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
    const fpi = $('#ed-an-fpi').val();
    const spi = $('#ed-an-spi').val();
    const tpi = $('#ed-an-tpi').val();
    if (fpi === '' && spi === '' && tpi === '') {
      // remove image in large placeholder
      $('#ed-img-placeholder').attr('src', '');
      $('#ed-img-placeholder').css('display', 'none');
    }
  });
});
