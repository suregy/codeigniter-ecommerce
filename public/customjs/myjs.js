function imgPrev() {
  const file = document.querySelector('#errFile');
  const label = document.querySelector('.custom-file-label');
  const prev = document.querySelector('.img-prev');

  label.textContent = file.files[0].name;

  const prevImg = new FileReader();
  prevImg.readAsDataURL(file.files[0]);

  prevImg.onload = function (e) {
    prev.src = e.target.result;
  };
}

function prevMulti() {
  const file = document.querySelector('#fileMulti').files.length;
  for (let i = 0; i < file; i++) {
    $('#preview').append(
      "<span class='fict d-block text-center'><img class='img-thumbnail prevsize' src='" +
        URL.createObjectURL(event.target.files[i]) +
        "'><span class='img-del mt-3'>remove</span></span>"
    );
  }
  const del = document.querySelectorAll('.img-del');
  for (let i = 0; i < del.length; i++) {
    del[i].addEventListener('click', function (e) {
      e.currentTarget.parentNode.remove();
    });
  }
}
