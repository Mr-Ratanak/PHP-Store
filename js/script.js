var swiper = new Swiper(".home", {
    slidesPerView: 1,
    spaceBetween: 30,
    loop: true,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
  });
  
  var swiper = new Swiper(".main-slide", {
    slidesPerView: 1,
    spaceBetween: 10,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    breakpoints: {
      450: {
        slidesPerView: 2,
        spaceBetween: 20,
      },
      730: {
        slidesPerView: 3,
        spaceBetween: 40,
      },
      1024: {
        slidesPerView: 5,
        spaceBetween: 50,
      },
    },
  });

  var swiper = new Swiper(".main-box", {
    slidesPerView: 1,
    spaceBetween: 10,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    breakpoints: {
      350: {
        slidesPerView: 1,
        spaceBetween: 20,
      },
      450: {
        slidesPerView: 2,
        spaceBetween: 20,
      },
      730: {
        slidesPerView: 3,
        spaceBetween: 40,
      },
      970: {
        slidesPerView: 3,
        spaceBetween: 20,
      },
    },
  });

  var swiper = new Swiper(".myReview", {
    slidesPerView: 1,
    spaceBetween: 10,
    loop: true,
    grabCursor: true,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    breakpoints: {
      640: {
        slidesPerView: 2,
        spaceBetween: 20,
      },
      768: {
        slidesPerView: 3,
        spaceBetween: 40,
      },
      1024: {
        slidesPerView: 3,
        spaceBetween: 40,
      },
    },
  });

  var menuBtn = document.querySelector('.navbar .list #bar');
  var menu = document.querySelector('.navbar nav');
    menuBtn.addEventListener('click',function(){
      menu.classList.toggle('active');
  });

window.onscroll = ()=>{
    userPopUp.classList.remove('active');
    menu.classList.remove('active');
}

var user = document.querySelector('.navbar .profile');
var userPopUp = document.querySelector('.navbar .user-link');
user.addEventListener('click',function(){
    userPopUp.classList.toggle('active');
});

let mainImage = document.querySelector('.main-view .view-image .m-img');
let subImage = document.querySelectorAll('.main-view .view-image .sub-image .s-img');

subImage.forEach(images =>{
  images.onclick = ()=>{
    src = images.getAttribute('src');
    mainImage.src = src;
  }
});



