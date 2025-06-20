$(document).ready(function () {

   // Slick slider initializations
   $('#slick-slider').slick({
      arrows: false,
      dots: true
   });

   // Slide toggler for responsive behavior
   function slickToggler() {
      let $slider = $('#slide');
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
   $(window).resize(function () {
      slickToggler();
      toggleAward();
      lifeHereSlider();
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

// Menu functions
function extendSubMenu(el) {
   if ($(el).hasClass('active-list')) {
      $(el).removeClass('active-list');
      return;
   }
   $('.navbar-item').removeClass('active-list');
   $(el).addClass('active-list');
}

function extendKnowledgeSubMenu(el, event) {
   event.stopPropagation();
   $(el).toggleClass('active-knowledge');
}

function expand(el) {
   $(el).toggleClass('active');
}
