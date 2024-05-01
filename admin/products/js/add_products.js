$(document).ready(() => {
  // for add products promotions
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
  // for add new product image selections
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
});
