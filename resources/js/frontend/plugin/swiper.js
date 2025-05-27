import Swiper from 'swiper';
import { Navigation, Pagination, EffectFade, Autoplay, EffectCreative } from 'swiper/modules';

import 'swiper/css/bundle';

const HomeBanner = new Swiper('.home-banner-swiper', {
    modules: [Navigation, EffectFade, Autoplay],
    loop: true,
      autoplay: {
        delay: 4000,
        disableOnInteraction: false,
      },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    speed: 1000,
    effect: 'fade',
    fadeEffect: {
        crossFade: true,
    }
});

const Testimonial = new Swiper('.testimonial-swiper', {
    modules: [Navigation, Pagination, Autoplay, EffectCreative],
    loop: true,
    autoHeight: true,
    autoplay: {
        delay: 6000,
        disableOnInteraction: false,
    },
    effect: "creative",
    creativeEffect: {
        prev: {
          shadow: false,
          opacity: 0,
          translate: ["-120%", 0, -500],
        },
        next: {
          shadow: false,
          opacity: 0,
          translate: ["120%", 0, -500],
        },
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
});

const priceSwiper = new Swiper('.price-swiper', {
    modules: [Navigation, Pagination, Autoplay],
    slidesPerView: "auto",
    spaceBetween: 10,
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
});

