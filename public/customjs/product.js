/*
fungsi tampil data
*/

function tampilData(isC1, isC2, isC3) {
  $.ajax({
    url: 'products/getData',
    dataType: 'json',
    data: {
      c1: isC1,
      c2: isC2,
      c3: isC3,
    },
    success: function (response) {
      $('.viewcard').html(response.data);
    },
    error: function (xhr, ajaxOptions, thrownError) {
      alert(xhr.status + '\n' + xhr.responseText + '\n' + thrownError);
    },
  });
}

$(document).ready(function () {
  tampilData();

  $('.inputDetail').click(function (e) {
    e.preventDefault();
    let checkbox = [];
    $("input[name='product']:checked").each(function () {
      checkbox.push($(this).val());
    });
    let length = $("input[name='product']:checked").length;
    let dataCheck = checkbox.join(',');
    if (length === 0 || length > 1) {
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'harus pilih satu data',
      });
    } else {
      $.ajax({
        type: 'post',
        url: 'Detprod/form',
        dataType: 'json',
        data: {
          id: dataCheck,
        },
        beforeSend: function () {
          $('.viewcard').html('<i class="fas fa-spin fa-spinner"></i>');
        },
        success: function (response) {
          $('.viewcard').html(response.data).show(); //show digunakan karena display none
          let refid = response.refid;
          $('#refid').val(dataCheck);
        },
        error: function (xhr, ajaxOptions, thrownError) {
          alert(xhr.status + '\n' + xhr.responseText + '\n' + thrownError);
        },
      });
    }
  });

  $('.tambahData').click(function (e) {
    e.preventDefault();
    $.ajax({
      url: 'products/formTambah',
      dataType: 'json',
      beforeSend: function () {
        $('.viewcard').html('<i class="fas fa-spin fa-spinner"></i>');
      },
      success: function (response) {
        $('.viewcard').html(response.data).show();
        var data = response.c1;
        var option;
        option += '<option selected value="0">-- Pilih Category --</option>';
        $.each(data, function (i, item) {
          option +=
            '<option value="' +
            item.c1 +
            '">' +
            item.namacategory +
            '</option>';
        });
        $('#cmbcat1').html(option);
        let brands = response.brands;
        let op;
        op += '<option selected value="0">-- Pilih Brands --</option>';
        $.each(brands, function (j, brand) {
          op +=
            '<option value="' +
            brand.id +
            '">' +
            brand.namabrands +
            '</option>';
        });
        $('#cmbbrands').html(op);
        let tags = response.tags;
        $('#tags').html('');
        $.each(tags, function (k, tag) {
          $('#tags').append(
            '<input type=checkbox name=tags[] value ="' +
              tag.id +
              '" />' +
              tag.nama
          );
        });
      },
      error: function (xhr, ajaxOptions, thrownError) {
        alert(xhr.status + '\n' + xhr.responseText + '\n' + thrownError);
      },
    });
    return false;
  });

  /**untuk cmb c1 */
  $('#cmbc1').change(function (e) {
    e.preventDefault();
    var c1 = $('#cmbc1 option:selected').val();
    $.ajax({
      type: 'post',
      url: 'products/getC2',
      dataType: 'json',
      data: { c1: c1 },
      success: function (response) {
        var data = response.c2;
        var option;
        option += '<option selected value="0">-- Pilih Category 2 --</option>';
        $.each(data, function (i, item) {
          option +=
            '<option value="' +
            item.c2 +
            '">' +
            item.namacategory +
            '</option>';
        });
        $('#cmbc2').html(option);
      },
      error: function (xhr, ajaxOptions, thrownError) {
        alert(xhr.status + '\n' + xhr.responseText + '\n' + thrownError);
      },
    });
  });
  /**untuk cmb c1 */
  $('#cmbc2').change(function (e) {
    e.preventDefault();
    var c1 = $('#cmbc1 option:selected').val();
    var c2 = $('#cmbc2 option:selected').val();
    $.ajax({
      type: 'post',
      url: 'products/getC3',
      dataType: 'json',
      data: {
        c1: c1,
        c2: c2,
      },
      success: function (response) {
        var data = response.c3;
        var option;
        option += '<option selected value="0">-- Pilih Category 3 --</option>';
        $.each(data, function (i, item) {
          option +=
            '<option value="' +
            item.c3 +
            '">' +
            item.namacategory +
            '</option>';
        });
        $('#cmbc3').html(option);
      },
      error: function (xhr, ajaxOptions, thrownError) {
        alert(xhr.status + '\n' + xhr.responseText + '\n' + thrownError);
      },
    });
  });
});

$(document).on('change', '#cmbc1', function () {
  var c1 = $(this).val();
  $('#dataproduct').DataTable().destroy();
  if (c1 != '') {
    tampilData(c1);
  } else {
    tampilData();
  }
});

$(document).on('change', '#cmbc2', function () {
  var c1 = $('#cmbc1 option:selected').val();
  var c2 = $(this).val();
  $('#dataproduct').DataTable().destroy();
  if (c2 != '') {
    tampilData(c1, c2);
  } else {
    tampilData();
  }
});

$(document).on('change', '#cmbc3', function () {
  var c1 = $('#cmbc1 option:selected').val();
  var c2 = $('#cmbc2 option:selected').val();
  var c3 = $(this).val();
  $('#dataproduct').DataTable().destroy();
  if (c2 != '') {
    tampilData(c1, c2, c3);
  } else {
    tampilData();
  }
});
