$(document).ready(function () {

   // Slick slider initializations
   $('#slick-slider').slick({
      arrows: false,
      dots: true
   });

   // Slide toggler for responsive behavior
   function slickToggler() {
      let $slider = $('#slide');

      // Check if slider exists
      if ($slider.length === 0) {
         return;
      }

      // Count number of cards
      let cardCount = $slider.find('.each-card').length;

      // Destroy existing slick instance if already initialized
      if ($slider.hasClass('slick-initialized')) {
         $slider.slick('unslick');
      }

      // Determine how many slides to show based on screen width
      let slidesToShow = 4;
      let windowWidth = $(window).width();

      if (windowWidth < 576) {
         slidesToShow = 1;
      } else if (windowWidth < 768) {
         slidesToShow = 2;
      } else if (windowWidth < 1200) {
         slidesToShow = 3;
      }

      // Only initialize slick if we have more cards than slidesToShow
      // Otherwise, just display cards normally
      if (cardCount > slidesToShow) {
         $slider.slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            infinite: true,
            prevArrow: '<button class="slick-prev left-arrow"><img src="/front/assets/img/vector-left.png" alt="Left Arrow"></button>',
            nextArrow: '<button class="slick-next right-arrow"><img src="/front/assets/img/vector-right.png" alt="Right Arrow"></button>',
            responsive: [
               {
                  breakpoint: 1200,
                  settings: {
                     slidesToShow: 3,
                  }
               }, {
               breakpoint: 768,
               settings: {
                  slidesToShow: 2,
               }
            }, {
               breakpoint: 576,
               settings: {
                  slidesToShow: 1,
               }
            }]
         });
      }
   }

   // Employee slider
   $('.employee-slider').slick({
      slidesToShow: 2,
      slidesToScroll: 1,
      centerMode: false,
      infinite: true,
      arrows: true,
      prevArrow: '<button class="slick-prev left-arrow"><img src="/front/assets/img/vector-left.png" alt="Left Arrow"></button>',
      nextArrow: '<button class="slick-next right-arrow"><img src="/front/assets/img/vector-right.png" alt="Right Arrow"></button>',
      responsive: [{
         breakpoint: 576,
         settings: {
            slidesToShow: 1,
         }
      }]
   });

   // Award slider toggle for responsive behavior
   function toggleAward() {
      if ($(window).width() < 992) {
         if (!$('.award-slider').hasClass('slick-initialized')) {
            $('.award-slider').slick({
               slidesToShow: 2,
               slidesToScroll: 1,
               infinite: true,
               prevArrow: '<button class="slick-prev left-arrow"><img src="/front/assets/img/vector-left.png" alt="Left Arrow"></button>',
               nextArrow: '<button class="slick-next right-arrow"><img src="/front/assets/img/vector-right.png" alt="Right Arrow"></button>',
               responsive: [{
                  breakpoint: 576,
                  settings: {
                     slidesToShow: 1,
                  }
               }]
            });
         }
      } else {
         if ($('.award-slider').hasClass('slick-initialized')) {
            $('.award-slider').slick('unslick');
         }
      }
   }

   // Sync sliders
   $('.slider-for').slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: false,
      fade: true,
      asNavFor: '.slider-nav'
   });

   $('.slider-nav').slick({
      slidesToShow: 3,
      slidesToScroll: 1,
      asNavFor: '.slider-for',
      dots: false,
      centerMode: true,
      centerPadding: '40px',
      arrows: false,
      infinite: false,
      focusOnSelect: true
   });

   // Life here slider
   function lifeHereSlider() {
      if ($(window).width() < 992) {
         if (!$('.mobile-slide').hasClass('slick-initialized')) {
            $('.mobile-slide').slick({
               slidesToShow: 3,
               slidesToScroll: 1,
               infinite: true,
               prevArrow: '<button class="slick-prev left-arrow"><img src="/front/assets/img/vector-left.png" alt="Left Arrow"></button>',
               nextArrow: '<button class="slick-next right-arrow"><img src="/front/assets/img/vector-right.png" alt="Right Arrow"></button>',
               responsive: [{
                  breakpoint: 576,
                  settings: {
                     slidesToShow: 1,
                  }
               }]
            });
         }
      } else {
         if ($('.mobile-slide').hasClass('slick-initialized')) {
            $('.mobile-slide').slick('unslick');
         }
      }
   }

   // Intern slider
   $('.intern-slide').slick({
      slidesToShow: 2,
      slidesToScroll: 1,
      centerMode: false,
      infinite: true,
      arrows: true,
      prevArrow: '<button class="slick-prev left-arrow"><img src="/front/assets/img/vector-left.png" alt="Left Arrow"></button>',
      nextArrow: '<button class="slick-next right-arrow"><img src="/front/assets/img/vector-right.png" alt="Right Arrow"></button>',
      responsive: [{
         breakpoint: 1200,
         settings: {
            slidesToShow: 1,
         }
      }, {
         breakpoint: 991,
         settings: {
            slidesToShow: 2
         }
      }, {
         breakpoint: 768,
         settings: {
            slidesToShow: 1
         }
      }]
   });

   // Initialize responsive sliders
   slickToggler();
   toggleAward();
   lifeHereSlider();

   // Add window resize handlers
   let resizeTimer;
   $(window).resize(function () {
      clearTimeout(resizeTimer);
      resizeTimer = setTimeout(function() {
         slickToggler();
         toggleAward();
         lifeHereSlider();
      }, 250);
   });
});

// Tab change function
function changeTab(el) {
   $('.tab').removeClass('active-tab');
   $(el).addClass('active-tab');

   $('.content-main').removeClass('active');
   let tabId = $(el).data('tab');
   $(tabId).addClass('active');
}

function expand(el) {
   $(el).toggleClass('active');
}
