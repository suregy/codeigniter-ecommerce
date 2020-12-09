$(document).ready(function () {
  const brand = $('.brands');
  var href = window.location.href;
  var patt1 = /[?]/g;
  $('.sort').change(function () {
    $('select option:selected').each(function (e) {
      let sort1 = $(this).attr('value');
      let concat = '';
      if (href.match(patt1)) {
        concat = href + '&' + sort1;
      } else {
        concat = href + '?' + dtbrand;
      }
      window.location.href = concat;
    });
  });

  for (let i = 0; i < brand.length; i++) {
    brand[i].addEventListener('click', function (e) {
      let dtbrand = $(this).attr('data-type');
      let concat1 = '';
      if (href.match(patt1)) {
        concat1 = href + '&' + dtbrand;
      } else {
        concat1 = href + '?' + dtbrand;
      }
      window.location.href = concat1;
    });
  }
});
