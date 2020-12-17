$(document).ready(function () {
  const brand = $('.brands');
  const surt = $('.surt');
  const cat = $('.category');

  $('select#sort').change(function (e) {
    $('select option:selected').each(function () {
      let data = $(this).attr('data-type');
      addOrUpdateUrlParam('sort', data);
    });
  });

  for (let i = 0; i < cat.length; i++) {
    cat[i].addEventListener('click', function (e) {
      let dtcat = $(this).attr('data-type');
      addOrUpdateUrlParam('cat', dtcat);
    });
  }

  for (let i = 0; i < brand.length; i++) {
    brand[i].addEventListener('click', function (e) {
      let dtbrand = $(this).attr('data-type');
      addOrUpdateUrlParam('brand', dtbrand);
    });
  }
});

function addOrUpdateUrlParam(name, value) {
  var href = window.location.href;
  var regex = new RegExp('[&\\?]' + name + '=');
  if (regex.test(href)) {
    regex = new RegExp('([&\\?])' + name + '=\\d+');
    window.location.href = href.replace(regex, '$1' + name + '=' + value);
  } else {
    if (href.indexOf('?') > -1)
      window.location.href = href + '&' + name + '=' + value;
    else window.location.href = href + '?' + name + '=' + value;
  }
}
