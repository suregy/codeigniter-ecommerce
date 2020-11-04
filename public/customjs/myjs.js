function imgPrev(){
    const file = document.querySelector('#errFile');
    const label = document.querySelector('.custom-file-label');
    const prev = document.querySelector('.img-prev');
    
    label.textContent = file.files[0].name;

    const prevImg = new FileReader();
    prevImg.readAsDataURL(file.files[0]);

    prevImg.onload = function(e){
        prev.src = e.target.result;
    }

}